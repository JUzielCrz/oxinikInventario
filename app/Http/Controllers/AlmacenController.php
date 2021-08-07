<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Producto;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AlmacenController extends Controller
{
    public function index()
    {
        return view('almacen.index');
    }

    public function data(){
        $almacen=Producto::
        leftjoin('almacen','producto.id','=','almacen.producto_id')
        ->select('almacen.*','almacen.id as idAlmacen','producto.nombre','producto.clave_sat', 'producto.unidad_medida','producto.id as idProducto');
        return DataTables::of(
            $almacen
        )                                                               
        // ->addColumn( 'btn-show', '<button class="btn btn-outline-secondary btn-class-show btn-xs" data-id="{{$idProducto}}"><span class="far fa-eye"></span></button>')
        ->addColumn( 'btn-edit', '<button class="btn btn-outline-secondary btn-class-edit btn-xs" data-id="{{$idProducto}}"><span class="far fa-eye"></span></button>')
        ->addColumn( 'btn-stock', '<button class="btn btn-outline-secondary btn-class-stock btn-xs" data-id="{{$idProducto}}"><i class="fas fa-exchange-alt fa-rotate-90"></i></span></button>')
        ->rawColumns(['btn-stock','btn-edit'])
        ->toJson();
    }

    public function show($id){
        $data=Producto::
        leftjoin('almacen','producto.id','=','almacen.producto_id')
        ->select('almacen.*', 'almacen.id as idAlmacen','producto.nombre','producto.clave_sat', 'unidad_medida', 'producto.id as idProducto')
        ->where('producto.id',$id)
        ->first();
        return response()->json(['data'=>$data]);
    }

    public function update(Request $request)
    {
        // if($request->idAlmacen == null){
        //     $almacen=new Almacen();
        //     $almacen->producto_id = $request->idProducto;
        //     $almacen->inicial = $request->inicial;
        //     $almacen->observaciones = $request->observaciones;
        //     if($almacen->save()){
        //         return response()->json(['mensaje'=>'Editado Correctamente']);
        //     };
        // }else{
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
