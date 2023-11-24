<?php

use Illuminate\Database\Seeder;
use App\Models\Cliente;
class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::create([
            'nombre' => 'Batman Martinez Martinez',
            'telefono' => '9525678343',
            'correo' => 'batman@gmail.com',
        ]);
        Cliente::create([
            'nombre' => 'Robin Cruz Cruz',
            'telefono' => '9876546785',
            'correo' => 'Robin@cliente.com',
        ]);
    }
}
