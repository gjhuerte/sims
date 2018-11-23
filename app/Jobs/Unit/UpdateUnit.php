<?php

namespace App\Jobs\Unit;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateUnit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $unit;
    protected $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($unit, $id)
    {
        $this->unit = $unit;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $unit = $this->unit;

        // Update the instance of the unit based 
        // on the information given by the user
        Unit::findOrFail($this->id)->update([
            'name' => isset($unit['name']) ? $unit['name'] : '',
            'abbreviation' => isset($unit['abbreviation']) ? $unit['abbreviation'] : '',
            'description' => isset($unit['description']) ? $unit['description'] : '',
        ]);
        
        // Triggers an alert that task has executed
        Alert::success(__('tasks.successfully_executed'));
    }
}
