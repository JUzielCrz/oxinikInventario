<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\AlmacenFiscal;
use App\Models\Producto;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        return view('producto.index');
    }

    public function data(){
            $tanques=Producto::
            select('producto.*');
            return DataTables::of(
                $tanques
            )                                                               
            ->addColumn( 'btn-show', '<button class="btn btn-outline-secondary btn-class-show btn-xs" data-id="{{$id}}"><span class="far fa-eye"></span></button>')
            ->addColumn( 'btn-edit', '<button class="btn btn-outline-secondary btn-class-edit btn-xs" data-id="{{$id}}"><span class="far fa-edit"></span></button>')
            ->addColumn( 'btn-delete', '<button class="btn btn-outline-secondary btn-class-delete btn-xs" data-id="{{$id}}"><span class="fas fa-trash"></span></button>')
            ->rawColumns(['btn-show','btn-edit','btn-delete'])
            ->toJson();
    }

    public function create(Request $request){
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'unidad_medida' => ['required'],
            'stock_inicial' => ['required'],
        ]);

        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->clave_sat = $request->clave_sat;
        $producto->unidad_medida = $request->unidad_medida;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->precio_minimo = $request->precio_minimo;
        $producto->descripcion = $request->descripcion;
        $producto->save();

        $almacen=new Almacen();
        $almacen->producto_id = $producto->id;
        $almacen->inicial = $request->stock_inicial;
        $almacen->stock = $request->stock_inicial;
        $almacen->save();

        $almacen=new AlmacenFiscal();
        $almacen->producto_id = $producto->id;
        $almacen->stock = 0;
        $almacen->save();

        return response()->json(['mensaje'=>'Registrado Correctamente']);

    }

    public function show(Producto $id){
        return response()->json(['data'=>$id]);    
        // return $data;
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
        ]);
        $producto = Producto::find($id);
        $producto->nombre = $request->nombre;
        $producto->clave_sat = $request->clave_sat;
        $producto->unidad_medida = $request->unidad_medida;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->precio_minimo = $request->precio_minimo;
        $producto->descripcion = $request->descripcion;
        if($producto->save()){
            return response()->json(['mensaje'=>' Editado Correctamente']);
        }
    }

    public function destroy(Producto $id){
        $almacen= Almacen::where('producto_id',$id->id);
        $almacen->delete();
        if($id->delete()){    

            return response()->json(['mensaje'=>'Eliminado Correctamente']);
        }
    }

}
