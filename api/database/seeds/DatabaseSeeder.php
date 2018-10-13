<?php
/**
 * Company : Bsetec
 * Product: Instasocial
 * Email : support@bsetec.com
 * Copyright © 2018 BSEtec. All rights reserved.
 */
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 * Method of seeding your database with test data using seed classes. 
	 * @return void
	 */
	public function run() {
		$this->call('OptionsTableSeeder');
		$this->call('UsersSeeder');
	}
}
