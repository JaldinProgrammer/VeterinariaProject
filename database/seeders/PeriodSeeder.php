<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('periods')->insert([
            [
                'begin'=>'07:00:00',
                'end'=>'08:00:00',
            ],
            [
                'begin'=>'08:00:00',
                'end'=>'09:00:00',
            ],
	        [
                'begin'=>'09:00:00',
                'end'=>'10:00:00',
            ],
	        [
                'begin'=>'10:00:00',
                'end'=>'11:00:00',
            ],
	        [
                'begin'=>'11:00:00',
                'end'=>'12:00:00',
            ],
	        [
                'begin'=>'12:00:00',
                'end'=>'13:00:00',
            ],
	        [
                'begin'=>'13:00:00',
                'end'=>'14:00:00',
            ],
	        [
                'begin'=>'14:00:00',
                'end'=>'15:00:00',
            ],
	        [
                'begin'=>'15:00:00',
                'end'=>'16:00:00',
            ],
	        [
                'begin'=>'16:00:00',
                'end'=>'17:00:00',
            ],
	        [
                'begin'=>'17:00:00',
                'end'=>'18:00:00',
            ],
	        [
                'begin'=>'18:00:00',
                'end'=>'19:00:00',
            ],
	        [
                'begin'=>'19:00:00',
                'end'=>'20:00:00',
            ],
            [
                'begin'=>'20:00:00',
                'end'=>'21:00:00',
            ]
        ]);
    }
}
