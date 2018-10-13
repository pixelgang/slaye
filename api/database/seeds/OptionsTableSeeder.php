<?php
/**
 * Company : Bsetec
 * Product: Instasocial
 * Database : Seeder
 * Email : support@bsetec.com
 * Copyright © 2018 BSEtec. All rights reserved.
 */
use Illuminate\Database\Seeder;
/**
 * File : OptionsTableSeeder
 * Use : Seed the default Options table data's
 * Functionality :
 *  >>> When we run the artisan seed commands Options default values updated to the table
 */
class OptionsTableSeeder extends Seeder {
	public function run() {
		DB::table('options')->delete();
		$insert_datas = [
			['code' => 'Application Name', 'option_key' => 'app_name', 'option' => 'Instasocial'],
			['code' => 'Email System', 'option_key' => 'email', 'option' => 'instasocial@gmail.com'],
			['code' => 'Frontend Logo', 'option_key' => 'front_logo', 'option' => 'logo.png'],
			['code' => 'Favi Icon', 'option_key' => 'fav_icon', 'option' => 'fav_icon.png'],
			['code' => 'Notification Flush', 'option_key' => 'notification_flush', 'option' => '21'],
			['code' => 'SMTP Host', 'option_key' => 'smtp_host', 'option' => ''],
			['code' => 'Smtp Port', 'option_key' => 'smtp_port', 'option' => ''],
			['code' => 'Smtp Username', 'option_key' => 'smtp_username', 'option' => ''],
			['code' => 'Smtp Password', 'option_key' => 'smtp_password', 'option' => ''],
			['code' => 'Smtp Secure', 'option_key' => 'smtp_secure', 'option' => ''],
			['code' => 'One Signal Settings', 'option_key' => 'onesignal_appid', 'option' => ''],
			['code' => 'One Signal Settings', 'option_key' => 'onesignal_appkey', 'option' => ''],
		];
		DB::table('options')->insert($insert_datas);
	}
}