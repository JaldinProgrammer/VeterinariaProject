<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'name'=>'Vacuna',
                'reservable'=>'0',
                'available'=>'1'
            ],
                        [
                'name'=>'Ducha antiparacitaria',
                'reservable'=>'1',
                'available'=>'1'
            ],            [
                'name'=>'Analisis',
                'reservable'=>'0',
                'available'=>'1'
            ],            [
                'name'=>'Ecografia',
                'reservable'=>'0',
                'available'=>'1'
            ],            [
                'name'=>'Estetica',
                'reservable'=>'1',
                'available'=>'1'
            ],            [
                'name'=>'Consulta',
                'reservable'=>'1',
                'available'=>'1'
            ],            [
                'name'=>'Peluqueria',
                'reservable'=>'1',
                'available'=>'1'
            ],
        ]);
    }
}
