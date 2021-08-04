<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\CompraProducto;
use App\Models\Producto;
use App\Models\Provedor;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('compra.index');
    }

    public function search_provedor(Request $request){
        if($request->get('query')){
            $query = $request->get('query');
            // $data = DB::table('contratos') ->where('num_contrato', 'LIKE', "%{$query}%")->get();
            $data=Provedor::
            where('nombre', 'LIKE', "%{$query}%")
            ->get();

            $output = '<ul class="dropdown-menu" style="display:block; position:relative">'; 
            foreach($data as $row) {
                $output .= '<li class="li-provedor"><a href="#">'.$row->id.'- '.$row->nombre.'</a></li>'; 
            }

            $output .= '</ul>'; echo $output;
        }
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
            $compra = new Compra();
            $compra->provedor_id = intval($cadenaProvedor[0]);
            $compra->folio_factura = $request->folio_factura;
            $compra->fecha = $request->fecha;
            
            if($compra->save()){
                foreach( $request->arrProducto AS $indice => $g){
                    
                    $cadenaProducto=explode('- ', $request->arrProducto[$indice]);
                    $productos=new CompraProducto();
                    $productos->compra_id = $compra->id;
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
