<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\AlmacenFiscal;
use App\Models\Producto;
use App\Models\ProductHistory;
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
            ->addColumn( 'btn-history', '<a class="btn btn-sm btn btn-outline-secondary" href="{{route(\'product.history\', $id)}}" data-toggle="tooltip" data-placement="top" title="Historial"><i class="fas fa-history"></i></a>')
            ->addColumn( 'btn-edit', '<button class="btn btn-sm btn-outline-secondary btn-class-edit btn-xs" data-id="{{$id}}"><span class="far fa-edit"></span></button>')
            ->addColumn( 'btn-delete', '<button class="btn btn-smbtn-outline-secondary btn-class-delete btn-xs" data-id="{{$id}}"><span class="fas fa-trash"></span></button>')
            ->rawColumns(['btn-history','btn-edit','btn-delete'])
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
        $producto->user_id = auth()->id();
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

    public function history($id)
    {
        $products = 
        ProductHistory::
        leftjoin('users','users.id','product_histories.user_id')
        ->select('users.name as user_name', 'product_histories.*')
        ->where("product_id", $id)->get();
        return view('producto.history', compact("products"));
    }
}
