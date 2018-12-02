<?php

namespace App\Jobs\Request;

use Alert;
use Carbon\Carbon;
use App\Models\Request\RSMI;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Models\Inventory\Supply\Ledger;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ApplyToLedger implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $rsmi = RSMI::with('stockcards.supply')->findOrFail($this->id);
        
        DB::beginTransaction();

        foreach($rsmi->stockcards as $stockcard) {
            
            $date = $stockcard->date;
            $stocknumber = $stockcard->supply->stocknumber;
            $reference = $stockcard->reference; 
            $unitcost = $stockcard->pivot->unitcost; 
            $issued_quantity = $stockcard->issued_quantity; 
            $daystoconsume = $stockcard->daystoconsume; 

            $transaction = new Ledger;
            $transaction->date = Carbon::parse($date);
            $transaction->stocknumber = $stocknumber;
            $transaction->reference = $reference;
            $transaction->received_quantity = 0;
            $transaction->issued_quantity = $issued_quantity;
            $transaction->issued_unitcost = $transaction->received_unitcost = $unitcost;
            $transaction->daystoconsume = $daystoconsume;
            $transaction->created_by = Auth::user()->id;
            $transaction->issue();
        }

        DB::commit();

        // sets the status of the report to
        // to applied in which the report has
        // been applied to the ledger card
        $rsmi->setAsApplied();

        Alert::success(__('tasks.successfully_executed'));
    }
}
