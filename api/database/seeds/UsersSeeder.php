<?php
/**
 * Company : Bsetec
 * Product: Instasocial
 * Database : Seeder
 * Email : support@bsetec.com
 * Copyright © 2018 BSEtec. All rights reserved.
 */
use Carbon\Carbon;
use Illuminate\Database\Seeder;
/**
 * File : UsersSeeder
 * Use : Seed the default Users table data's
 * Functionality :
 *  >>> When we run the artisan seed commands, Users default values updated to the table
 *  >>> Default we update the admin user details here.
 */
class UsersSeeder extends Seeder {

	public function run() {
		DB::table('users')->delete();
		$password = app('hash')->make('admin123');
		$insert_datas = [
			[
				'username' => 'admin',
				'email' => 'admin@bsetec.com',
				'password' => $password,
				'first_name' => 'admin',
				'last_name' => 'bsetec',
				'role' => '1',
				'state' => '',
				'country' => '',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
		];
		DB::table('users')->insert($insert_datas);
	}

}