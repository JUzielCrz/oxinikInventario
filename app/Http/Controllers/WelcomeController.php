<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Config;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
class WelcomeController extends Controller
{
    public function index()
    {
        $config= Config::find(1);
        return view('welcome', compact('config'));
    }

    public function data()
{
    $almacen = Producto::leftJoin('almacen', 'producto.id', '=', 'almacen.producto_id')
            ->leftJoin('almacen_fiscal', 'producto.id', '=', 'almacen_fiscal.producto_id')
            ->select([
                'producto.*',
                'producto.id as idProducto',
                DB::raw('GROUP_CONCAT(almacen.observaciones) as observaciones_no_fiscal'),
                DB::raw('GROUP_CONCAT(almacen_fiscal.observaciones) as observaciones_fiscal'),
                DB::raw('sum(almacen.stock + almacen_fiscal.stock) as sumStock')
            ])->groupBy('producto.id'); // Agrupar por la columna id del producto

    return DataTables::of($almacen)->toJson();
}


}
