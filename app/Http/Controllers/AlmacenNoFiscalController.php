<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Producto;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class AlmacenNoFiscalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('almacen.nofiscal.index');
    }

    public function data(){
        $almacen=Producto::
        leftjoin('almacen','producto.id','=','almacen.producto_id')
        ->select('almacen.*','almacen.id as idAlmacen', 'producto.*','producto.id as idProducto');
        return DataTables::of(
            $almacen
        )                                                               
        // ->addColumn( 'btn-show', '<button class="btn btn-outline-secondary btn-class-show btn-xs" data-id="{{$idProducto}}"><span class="far fa-eye"></span></button>')
        ->addColumn( 'btn-edit', '<button class="btn btn-outline-secondary btn-class-edit btn-sm" data-id="{{$idProducto}}"><span class="far fa-edit"></span></button>')
        ->addColumn( 'btn-stock', '<button class="btn btn-outline-secondary btn-class-stock btn-sm" data-id="{{$idProducto}}"><i class="fas fa-exchange-alt fa-rotate-90"></i></span></button>')
        ->rawColumns(['btn-stock','btn-edit'])
        ->toJson();
    }

    public function show($id){
        $data=Producto::
        leftjoin('almacen','producto.id','=','almacen.producto_id')
        ->select('almacen.*', 'almacen.id as idAlmacen','producto.nombre','producto.clave_sat', 'unidad_medida_base', 'producto.id as idProducto')
        ->where('producto.id',$id)
        ->first();
        return response()->json(['data'=>$data]);
    }

    public function update(Request $request)
    {
            $almacen=Almacen::find($request->idAlmacen);
            $almacen->observaciones = $request->observaciones;
            if($almacen->save()){
                return response()->json(['mensaje'=>'Editado Correctamente']);
            };
    }

    public function update_stock(Request $request){

        $almacen = Almacen::find($request->idAlmacen);
        
        if($request->insidencia == 'Aumento'){
            $suma = $almacen->stock + $request->cantidad;
        }else{
            $suma = $almacen->stock - $request->cantidad;
        }

        if($suma >= 0){
            $almacen->stock = $suma;
            $almacen->save();
            return response()->json(['mensaje'=>'success']);
        }

        return response()->json(['mensaje'=>'error']);
    }
}
