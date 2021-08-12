<?php

namespace App\Console;

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
        Commands\SendBirthdaySms::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->exec('php artisan queue:work --daemon --stop-when-empty')->everyMinute()->appendOutputTo('SMS_Log.txt');
        // $schedule->exec('php artisan send:birthday_sms')->everyMinute()->appendOutputTo('Command_Log.txt');
        // $schedule->exec('php artisan send:birthday_sms')->dailyAt('08:00')->appendOutputTo('Command_Log.txt');
    }

    /**
     * Register the commands for the application.
     *
     * @return voiduse App\Console\Commands\SendEmailsCommand;
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
