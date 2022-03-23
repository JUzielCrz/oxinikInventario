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
            'nombre'      => 'Oxigeno',
            'unidad_medida'      => 'm3',
            'precio_compra'=> '800',
            'precio_venta'=> '1200',
            'precio_minimo'=> '1000',
        ]);
        $almacen=Almacen::create([
            'producto_id'      => $producto->id,
            'inicial'      => 50,
            'stock'      => 50,
        ]);
        $producto=Producto::create([
            'nombre'      => 'Nitrogeno',
            'unidad_medida'      => 'm3',
            'precio_compra'=> '800',
            'precio_venta'=> '1200',
            'precio_minimo'=> '1000',
        ]);
        $almacen=Almacen::create([
            'producto_id'      => $producto->id,
            'inicial'      => 50,
            'stock'      => 50,
        ]);
        $provedor=Provedor::create([
            'nombre'      => 'Jazmin San Gaspar'
        ]);
        
        
    }
}
