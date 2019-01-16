<?php

namespace App\Jobs\Office;

use App\Models\Office\OFfice;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateOffice implements ShouldQueue
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
        $office = $this->request;

        $office = Office::create([
            'name' => isset($office['name']) ? $office['name'] : null,
            'code' => isset($office['code']) ? $office['code'] : null,
            'head' => isset($office['head']) ? $office['head'] : null,
            'head_title' => isset($office['head_title']) ? $office['head_title'] : null,
            'description' => isset($office['description']) ? $office['description'] : null,
        ]);
        
        Alert::success(__('tasks.successfully_executed'));
    }
}
