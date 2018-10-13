<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'\App\Console\Commands\UserNotifications',
		'\App\Console\Commands\CronJob',
		'\App\Console\Commands\FlushNotifications'
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule) {
		$schedule->command('UserNotifications:notifications')->everyMinute()->sendOutputTo("nlog.txt");
		$schedule->command('CronJob:cronjob')->everyMinute()->sendOutputTo("log.txt");
		$schedule->command('FlushNotifications:old')->daily()->sendOutputTo("flog.txt");
	}

	protected function commands() {
		require base_path('routes/console.php');
	}
}
