<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
                'name'=>'Carlos Isaac Jaldin Benavides',
                'email'=>'carjal192000@gmail.com',
                'password'=>Hash::make('12345678'),
                'phone'=>'76041031',
                'veterinarian' => '1',
                'admin' => '1',
                'customer' => '0'
            ],
              [
                'name'=>'Valeria Coronado Arispe',
                'email'=>'vc6337617@gmail.com',
                'password'=>Hash::make('12345678'),
                'phone'=>'62066339',
                'veterinarian' => '1',
                'admin' => '1',
                'customer' => '0'
              ],
               [
                'name'=>'Franz Rodrigo Garcia',
                'email'=>'franz.garcia.rv@gmail.com',
                'password'=>Hash::make('12345678'),
                'phone'=>'72379772',
                'veterinarian' => '1',
                'admin' => '1',
                'customer' => '0'
            ]
        ]);
    }
}

