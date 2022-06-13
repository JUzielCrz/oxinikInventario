<?php

use App\Rol;
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
            'password'  => Hash::make('oxinik#2020'),
        ]);

        //Creacion de Rol para Administrador
        $roladmin= Rol::create([
            'name'=>'Admin',
            'slug'=>'admin',
            'description'=>'Administrador',
            ]);
        //crear relacion en la tabla rol_user para admin
        $useradmin->roles()->sync([$roladmin->id]);
    }
}
