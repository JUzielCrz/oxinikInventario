<?php

use Illuminate\Database\Seeder;
use App\Models\Producto;
use Carbon\Carbon;
class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fechaActual = Carbon::now();

        Producto::create([
            'nombre' => 'Soda Manzanita 600 ml',
            'unidad_medida_base' => 'unidad',
            'unidad_medida_secundaria' => 'caja',
            'unidad_conversion' => 25,
            'descripcion' => 'Refresco de lata de empresa cocacola',
            'clave_sat' => 'ASD765FDE',
            'precio_compra' => 13,
            'precio_venta' => 19,
            'precio_minimo' => 17,
            'user_id' => 1,
            'created_at' => $fechaActual,
            'updated_at' => $fechaActual,
        ]);
    }
}
