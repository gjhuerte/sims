<?php

namespace App\Jobs\Request;

use Alert;
use Carbon\Carbon;
use App\Models\Request\RSMI;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Models\Inventory\Supply\Stock;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GenerateNewReport implements ShouldQueue
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
        $month = $request['month'];
        $parsedMonth = Carbon::parse($month);
        $stockID = Stock::issued()
                        ->filterByRIS($parsedMonth)
                        ->select('id')
                        ->pluck('id');

        DB::beginTransaction();

        $rsmi = RSMI::generatePendingReport($parsedMonth)
                    ->stockcards()
                    ->sync($stockID);

        DB::commit();

        Alert::success(__('tasks.successfully_executed'));
    }
}
