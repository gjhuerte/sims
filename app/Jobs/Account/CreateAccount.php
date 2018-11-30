<?php

namespace App\Jobs\Account;

use Alert;
use App\Models\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateAccount implements ShouldQueue
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

        User::create([
            'lastname' => $request['lastname'],
            'firstname' => $request['firstname'],
            'middlename' => $request['middlename'],
            'username' => $request['username'],
            'email' => $request['email'],
            'office' => $request['office'],
            'position' => $request['position'],
            'access' => $request['access'],
            'password' => User::encryptPassword($request['password']),
            'status' => User::ACTIVATED_STATUS,
        ]);

        Alert::success(__('tasks.successfully_executed'));
    }
}
