<?php

namespace App\Console;

use App\Console\Commands\TrackerNotificationCommand;
use App\Console\Commands\AttendanceCheckCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        TrackerNotificationCommand::class,
        AttendanceCheckCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('attendance:check')->dailyAt('22:00');
        // $schedule->command('attendance:check')->everyMinute();
        // Schedule attendance check to run daily at 8:00 PM
        //$schedule->command('attendance:check')->dailyAt('20:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
