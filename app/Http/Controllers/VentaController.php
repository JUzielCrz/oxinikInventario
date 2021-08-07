<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\VentaProducto;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('venta.index');
    }

    public function search_producto(Request $request){

        if($request->get('query')){
            $query = $request->get('query');
            $data=Producto::
            where('nombre', 'LIKE', "%{$query}%")
            ->get();

            $output = '<ul class="dropdown-menu" style="display:block; position:relative">'; 
            foreach($data as $row) {
                $output .= '<li class="li-producto"><a href="#">'.$row->id.'- '.$row->nombre.'</a></li>'; 
            }

            $output .= '</ul>'; echo $output;
        }
    }
    public function search_cliente(Request $request){

        if($request->get('query')){
            $query = $request->get('query');
            $data=Cliente::
            where('nombre', 'LIKE', "%{$query}%")
            ->get();

            $output = '<ul class="dropdown-menu" style="display:block; position:relative">'; 
            foreach($data as $row) {
                $output .= '<li class="li-cliente"><a href="#">'.$row->id.'- '.$row->nombre.'</a></li>'; 
            }

            $output .= '</ul>'; echo $output;
        }
    }

    public function save(Request $request)
    { 

        if(count($request->arrProducto) > 0){
            $cadenaCliente=explode('- ', $request->cliente);

            foreach( $request->arrProducto AS $valid => $g){
                if($request->arrCantidad[$valid] <1){
                    return response()->json(['mensaje'=>'No se admiten valores menor a 1']);
                }
                
                $cadenaProducto=explode('- ', $request->arrProducto[$valid]);
                $actualizarstock = Almacen::where('producto_id',intval($cadenaProducto[0]))->first();
                $sumstock=$actualizarstock->stock-$request->arrCantidad[$valid];
                if($sumstock<0){
                    return response()->json(['mensaje'=>'No hay stock suficiente']);
                };
            }

            

            $venta = new Venta();
            $venta->cliente_id = intval($cadenaCliente[0]);
            $venta->folio_factura = $request->folio_factura;
            $venta->fecha = $request->fecha;
            $venta->total_general = $request->total_general;
            
            if($venta->save()){

                foreach( $request->arrProducto AS $indice => $g){
                    
                    $cadenaProducto=explode('- ', $request->arrProducto[$indice]);
                    $productos=new VentaProducto();
                    $productos->venta_id = $venta->id;
                    $productos->producto_id = intval($cadenaProducto[0]);
                    $productos->cantidad = $request->arrCantidad[$indice];
                    $productos->subtotal = $request->arrSubTotal[$indice];
                    $productos->iva = $request->arrIva[$indice];
                    $productos->total = $request->arrTotal[$indice];
                    $productos->save();
                    
                    $actualizarstock = Almacen::where('producto_id',$productos->producto_id)->first();
                    $sumstock=$actualizarstock->stock-$productos->cantidad;
                    $sumsalidas=$actualizarstock->salidas+$productos->cantidad;
                    $actualizarstock->stock = $sumstock;
                    $actualizarstock->salidas = $sumsalidas;
                    $actualizarstock->save();
                }
                
                return response()->json(['mensaje'=>'success']);
            }
        }
    }

}
