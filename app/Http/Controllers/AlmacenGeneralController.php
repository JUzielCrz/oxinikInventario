<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class AlmacenGeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('almacen.general.index');
    }

    public function data(){
        $almacen=Producto::
        leftjoin('almacen','producto.id','=','almacen.producto_id')
        ->leftjoin('almacen_fiscal','producto.id','=','almacen_fiscal.producto_id')
        ->select('producto.*','almacen.inicial',
            DB::raw('
            (almacen.entradas + almacen_fiscal.entradas) as sumEntradas,
            (almacen.salidas + almacen_fiscal.salidas) as sumSalidas,
            (almacen.stock + almacen_fiscal.stock) as sumStock'));
        return DataTables::of(
            $almacen
        ) 
        ->toJson();
    }
}

// ->addSelect(['tanque_desc' => tanque::select(DB::raw("CONCAT(ph,', ', capacidad,', ', material,', ',fabricante,', ',tipo_tanque)"))->whereColumn( 'nota_tanque.num_serie', 'tanques.num_serie')])
// ->select('almacen.*','almacen.id as idAlmacen','producto.nombre','producto.clave_sat', 'producto.unidad_medida','producto.id as idProducto', 'producto.precio_compra', 'producto.precio_venta', 'producto.precio_minimo');
// $almacen=Producto::
//         leftjoin('almacen','producto.id','=','almacen.producto_id')
//         ->leftjoin('almacen_fiscal','producto.id','=','almacen_fiscal.producto_id')
//         ->select(DB::raw('sum()'));