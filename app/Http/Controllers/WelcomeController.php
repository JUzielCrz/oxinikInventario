<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function data(){
        $almacen=Producto::
        leftjoin('almacen','producto.id','=','almacen.producto_id')
        ->select(
            'almacen.stock',
            'almacen.id as idAlmacen',
            'producto.nombre',
            'producto.clave_sat', 
            'producto.unidad_medida',
            'producto.id as idProducto', 
            'producto.precio_compra', 
            'producto.precio_venta', 
        );
        return DataTables::of(
            $almacen
        )                                                               
        ->toJson();
    }
}
