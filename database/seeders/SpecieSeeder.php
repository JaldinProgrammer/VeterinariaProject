<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('species')->insert([
            [
                'name'=>'Perro',
            ],            
            [
                'name'=>'Gato',
            ],            
            [
                'name'=>'Pez',
            ],            
            [
                'name'=>'Ave',
            ],            
            [
                'name'=>'Conejo',
            ],            
            [
                'name'=>'Serpiente',
            ]
        ]);
    }
}
