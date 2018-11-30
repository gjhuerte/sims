<?php

namespace App\Jobs\Inventory\Supply\Adjustment;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ReturnSupply implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $request = $this->request;
        
		DB::beginTransaction();

		$adjustment = Adjustment::create([
			'created_by' => Auth::user()->full_name,
			'details' => $request['details'],
			'status' => null
		]);

		foreach($request['stocknumber'] as $stocknumber) {
            
			$supply = Supply::stockNumber($stocknumber)->first();

			$supplies[] = [
			    'supply_id' => $supply->id,
			    'quantity' => $request['quantity']["$stocknumber"],
                'unitcost' => $request['unitcost']["$stocknumber"],
            ];
            
            Stock::create([
                'date' => Carbon::now(),
                'stocknumber' => $supply->stocknumber,
                'reference' => "Adjustment#$adjustment->code",
			    'received_quantity' => $request['quantity']["$stocknumber"],
                'user_id' => Auth::user()->id,
                'receipt' => null,
                'organization' => null,
                'daystoconsume' => null,
            ]);
		}

		$adjustment->supplies()->sync($supplies);
		DB::commit();
    }
}
