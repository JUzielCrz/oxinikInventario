<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $useradmin=User::create([
            'name'      => 'Administrador OXINIK',
            'email'     =>  'sge.oxinik@gmail.com',
            'email_verified_at'     =>  '2020-01-17 13:00:00',
            'password'  => Hash::make('oxinik023'),
        ]);
    }
}
