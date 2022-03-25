<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\AlmacenFiscal;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\VentaProducto;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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
                if($request->arrFacturado[$valid] == 'SI'){
                    $get_producto = AlmacenFiscal::where('producto_id',intval($cadenaProducto[0]))->first();
                }
                if($request->arrFacturado[$valid] == 'NO'){
                    $get_producto = Almacen::where('producto_id',intval($cadenaProducto[0]))->first();
                }
                $resta_stock=$get_producto->stock-$request->arrCantidad[$valid];
                if($resta_stock<0){
                    return response()->json(['mensaje'=>'No hay stock suficiente']);
                };
            }

            

            $venta = new Venta();
            $venta->cliente_id = intval($cadenaCliente[0]);
            $venta->tipo_folio = $request->tipo_folio;
            $venta->folio = $request->folio;
            $venta->fecha = $request->fecha;
            $venta->total_general = $request->total_general;
            $venta->observaciones = $request->total_general;
            
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
                    
                    if($request->arrFacturado[$indice] == 'SI'){
                        $search_producto = AlmacenFiscal::where('producto_id',$productos->producto_id)->first();
                    }
                    if($request->arrFacturado[$indice] == 'NO'){
                        $search_producto = Almacen::where('producto_id',$productos->producto_id)->first();
                    }
                    
                    $resta= $search_producto->stock - $productos->cantidad;
                    $sumsalidas=$search_producto->salidas+$productos->cantidad;
                    $search_producto->stock = $resta;
                    $search_producto->salidas = $sumsalidas;
                    $search_producto->save();
                }
                
                return response()->json(['mensaje'=>'success']);
            }
        }
    }

    public function index_nota(){
        return view('venta.notas.lista');
    }

    public function nota_data(){
        $notas=Venta::
        join('cliente','cliente.id','venta.cliente_id')
        ->select('nombre as cliente', 'tipo_folio', 'folio', 'fecha','total_general', 'venta.id as idVenta');
        return DataTables::of(
            $notas
        )
        ->addColumn( 'btnShow', '<a class="btn btn-sm btn-verde" href="{{route(\'venta.nota.show\', $idVenta)}}" data-toggle="tooltip" data-placement="top" title="Nota"><span class="fas fa-clipboard"></span></a>')
        // ->addColumn( 'btn-edit', '<button class="btn btn-outline-secondary btn-class-edit btn-xs" data-id="{{$idProducto}}"><span class="far fa-eye"></span></button>')
        // ->addColumn( 'btn-stock', '<button class="btn btn-outline-secondary btn-class-stock btn-xs" data-id="{{$idProducto}}"><i class="fas fa-exchange-alt fa-rotate-90"></i></span></button>')
        ->rawColumns(['btnShow'])
        ->toJson();
    }
    public function nota_show($idVenta){
        $nota=Venta::
        join('cliente', 'cliente.id','=', 'venta.cliente_id')
        ->select('cliente.nombre as cliente','venta.*')
        ->where('venta.id',$idVenta)->first();
        $productos=VentaProducto::where('venta_id',$idVenta)->get();
        $data=["nota"=>$nota, "productos"=>$productos];
        return view('venta.notas.show', $data);
    }
}
