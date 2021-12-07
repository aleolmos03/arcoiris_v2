<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EventTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::Create([
            'name' => 'root',
            'email' => 'admin@sgiarcoiris.com',
            'password' => bcrypt('561-Arcoiris'),
            'voluntary_id' => 1,
            'role_id' => 1

        ]);
    }
}
