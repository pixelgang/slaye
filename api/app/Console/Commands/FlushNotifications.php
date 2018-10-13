<?php
/**
 * Company : Bsetec
 * Product: Instasocial
 * Cron : FlushNotifications
 * Email : support@bsetec.com
 * Copyright © 2018 BSEtec. All rights reserved.
 */
namespace App\Console\Commands;

use Illuminate\Console\Command;

class FlushNotifications extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'FlushNotifications:old';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Flush Old Notifications';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		$oData = \DB::table('options')->where('option_key', 'notification_flush')->first();
		$flushDay = $oData->option;
		$expired = (int) $flushDay;
		if($expired > 0){
			\DB::table('notification')
			->where('status', 1)
			->where('created_at', '<', \DB::raw('DATE_ADD(CURDATE(),INTERVAL -'.$expired.' DAY)'))
			->delete();
			$this->info('Flushed '.$expired.' days Older Records at '.date("Y-m-d H:i:s"));
		}
	}
}