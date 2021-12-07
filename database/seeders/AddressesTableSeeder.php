<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //Creamos direccion Admin
       \App\Models\Address::Create([
        'address' => 'Administrador',
        'city_id' =>1
    ]);
    }
}
