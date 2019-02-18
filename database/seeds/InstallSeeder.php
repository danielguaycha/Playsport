<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizations')->insert([
            'name'=> 'OrganizationName',
            'logo'=>'logo.png'
        ]);

        DB::table('users')->insert([
            [
                'name'=> 'Admin 1',
                'email'=> 'admin@gmail.com',
                'password'=> bcrypt("admin"),
                'organization_id'=> 1,
            ],
            [
                'name'=> 'Admin 2',
                'email'=> 'admin2@gmail.com',
                'password'=> bcrypt("admin"),
                'organization_id'=> 1
            ],
            [
                'name'=> 'Admin 3',
                'email'=> 'admin3@gmail.com',
                'password'=> bcrypt("admin"),
                'organization_id'=> 1
            ]
        ]);
        DB::table('sports')->insert([
            [
                'name'=> 'Fútbol',
                'duration'=> 20,
                'status'=> 1,
                'min_players'=> 5,
                'max_players'=> 7,
                'denomination'=> 'Goles',
                'rules'=> 'Ninguna'
            ],
            [
                'name'=> 'Basket',
                'duration'=> 20,
                'status'=> 1,
                'min_players'=> 3,
                'max_players'=> 5,
                'denomination'=> 'Putos',
                'rules'=> 'Ninguna'
            ],
            [
                'name'=> 'Volley',
                'duration'=> -1,
                'status'=> 1,
                'min_players'=> 3,
                'max_players'=> 3,
                'denomination'=> 'Puntos',
                'rules'=> 'Ninguna'
            ],
            [
                'name'=> 'Indor',
                'duration'=> 20,
                'status'=> 1,
                'min_players'=> 4,
                'max_players'=> 6,
                'denomination'=> 'Goles',
                'rules'=> 'Ninguna'
            ]

        ]);

    }
}
