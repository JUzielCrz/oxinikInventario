<?php

namespace App\Http\Controllers;

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

    public function save(Request $request)
    { 

        $request->validate([
            'provedor' => ['required'],
            'folio_factura' => ['required', 'numeric'],
        ]);
        if(count($request->arrProducto) > 0){
            $cadenaProvedor=explode('- ', $request->provedor);
            $venta = new Venta();
            $venta->provedor_id = intval($cadenaProvedor[0]);
            $venta->folio_factura = $request->folio_factura;
            $venta->fecha = $request->fecha;
            
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
                    $productos->facturado = $request->arrFacturado[$indice];
                    $productos->save();
                }
                
                return response()->json(['mensaje'=>'success']);
            }
        }
    }

}
