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
 * File : ReportsTableSeeder
 * Use : Seed the default Reports table data's
 * Functionality :
 *  >>> When we run the artisan seed commands, Reports default values updated to the table
 */
class ReportsTableSeeder extends Seeder {

    public function run() {
        DB::table('reports')->delete();
        $password = app('hash')->make('bsetec123');
        $insert_datas = [
            [
                'types' => 'Self-Harm',
                'types' => 'violence',
                'types' => 'Sexual Content',
                'types' => 'Child Safety',
                'types' => "I don't like this"
            ],
        ];
        DB::table('reports')->insert($insert_datas);
    }

}
