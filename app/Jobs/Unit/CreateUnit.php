<?php

namespace App\Jobs\Unit;

use Alert;
use Illuminate\Bus\Queueable;
use App\Models\Inventory\Unit;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateUnit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $unit;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($unit)
    {
        $this->unit = $unit;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $unit = $this->unit;

        // Create a unit from the information given
        Unit::create([
            'name' => isset($unit['name']) ? $unit['name'] : '',
            'abbreviation' => isset($unit['abbreviation']) ? $unit['abbreviation'] : '',
            'description' => isset($unit['description']) ? $unit['description'] : '',
        ]);
        
        // Create an alert for the user to trigger
        // That a unit has been successfully created
        Alert::success(__('tasks.successfully_executed'));
    }
}
