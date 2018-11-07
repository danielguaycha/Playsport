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
            'name'=> 'UAIC',
            'logo'=>'logo.png'
        ]);
        DB::table('users')->insert([
            [
                'name'=> 'Daniel Guaycha',
                'email'=> 'danielguaycha95@gmail.com',
                'password'=> bcrypt("dg851996"),
                'organization_id'=> 1,
            ],
            [
                'name'=> 'Nixon Quezada',
                'email'=> 'nxnqzd@gmail.com',
                'password'=> bcrypt("juegos12345678"),
                'organization_id'=> 1
            ],
            [
                'name'=> 'Erick Cañarte',
                'email'=> 'ca.arte07@hotmail.com',
                'password'=> bcrypt("juegos12345678"),
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
