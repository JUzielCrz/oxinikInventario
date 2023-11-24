<?php

use Illuminate\Database\Seeder;
use App\Models\Provedor;
class ProveedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provedor::create([
            'nombre' => 'Marcos Gutierrez Mendoza',
            'correo' => 'marcos_temporal@correo.com',
            'telefono' => '9876546785',
        ]);
        Provedor::create([
            'nombre' => 'Salvador Martinez Salvatierra',
            'correo' => 'salvador_temporal@correo.com',
            'telefono' => '9876546785',
        ]);
    }
}
