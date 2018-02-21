<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App;
use Auth;
use Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
       $schedule->command('backup:clean')->daily()->at('07:00');
       $schedule->command('backup:run')->daily()->at('7:30');

        $schedule->call(function () {
            DB::table('requests')->where('approved_at', '<=', Carbon\Carbon::now()->subDays(5)->toDateTimeString())
                ->where('status', '=', 'approved')
                ->update([
                    'status' => 'cancelled',
                    'cancelled_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'cancelled_by' => Auth::user()->id
                ]);

            $title = 'Request Cancellation';
            $details = "Unclaimed requests before " . Carbon\Carbon::now()->toDateTimeString() . " has been cancelled" ;

            App\Announcement::notify($title, $details, $access = 1, null);
        })->daily();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
