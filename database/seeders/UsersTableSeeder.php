<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creamos el usuario Admin
        \App\Models\User::Create([
            'email' => 'root@sgiarcoiris.com',
            'password' => bcrypt('561-Arcoiris'),
            'person_id' => 1,
            'role_id' => 1
        ]);
    }
}
