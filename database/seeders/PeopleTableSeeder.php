<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //Creamos Persona Admin
       \App\Models\Person::Create([
        'DNI' => '00000000',
        'name' => 'Administrador',
        'last_name' => 'SGI-Arcoiris',
        'nick_name' => 'Admin',
        'sex' => 'M',
        'date_of_birth' => Now(),
        'state' => 'A',
        'blood_type_id' => 1,
        'address_id' => 1
    ]);
    }
}
