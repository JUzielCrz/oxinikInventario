<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function data(){
        $almacen=Producto::
        leftjoin('almacen','producto.id','=','almacen.producto_id')
        ->leftjoin('almacen_fiscal','producto.id','=','almacen_fiscal.producto_id')
        ->select(
            'almacen.id as idAlmacen',
            'producto.nombre',
            'producto.clave_sat', 
            'producto.unidad_medida',
            'producto.id as idProducto', 
            'producto.precio_minimo', 
            'producto.precio_venta', 
            DB::raw('(almacen.stock + almacen_fiscal.stock) as sumStock')
        );
        return DataTables::of(
            $almacen
        )                                                               
        ->toJson();
    }
}
