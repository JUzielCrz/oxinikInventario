<?php

use App\Models\Almacen;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Provedor;
use Illuminate\Database\Seeder;

class RegistrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cliente=Cliente::create([
            'nombre'      => 'Uziel Alonso Cruz'
        ]);
        $producto=Producto::create([
            'nombre'      => 'Cubrebocas Tela',
            'unidad_medida'      => 'pz'
        ]);
        $provedor=Provedor::create([
            'nombre'      => 'OXINIK'
        ]);
        $almacen=Almacen::create([
            'producto_id'      => $producto->id,
            'inicial'      => 50,
            'stock'      => 50,
        ]);
        
    }
}
