<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\RequestApproval' => [
            'App\Listeners\UpdateNotificationList',
        ],    

        'App\Events\TriggerRequest' => [
            'App\Listeners\UpdateNotificationList',
        ],    

        'App\Events\GenerateRequest' => [
            'App\Listeners\UpdateNotificationList'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
