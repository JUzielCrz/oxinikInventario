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
            $venta->observaciones = $request->observaciones;
            $venta->save();

            foreach( $request->arrProducto AS $indice => $g){
                // OBTENER PRODUCTO
                $cadenaProducto=explode('- ', $request->arrProducto[$indice]);
                $producto_id = intval($cadenaProducto[0]);
                $product= Producto::find($producto_id);


                //CALCULAR STOCK
                $unit_measure =  $request->arrUnidadMedida[$indice];
                $quantity = $request->arrCantidad[$indice];

                if ($unit_measure == 'unidad_medida_base'){
                    $quantity_stock = $quantity;
                }else if($unit_measure == 'unidad_medida_secundaria'){
                    $quantity_stock = $quantity * $product->unidad_conversion;
                }


                $buyProducts=new VentaProducto();
                $buyProducts->venta_id = $venta->id;
                $buyProducts->producto_id = $producto_id;
                $buyProducts->cantidad = $quantity_stock;
                $buyProducts->unidad_medida =  $request->arrUnidadMedidaTexto[$indice];
                $buyProducts->subtotal = $request->arrSubTotal[$indice];
                $buyProducts->iva = $request->arrIva[$indice];
                $buyProducts->total = $request->arrTotal[$indice];
                $buyProducts->facturado = $request->arrFacturado[$indice];
                $buyProducts->save();
                
                if($request->arrFacturado[$indice] == 'SI'){
                    $search_producto = AlmacenFiscal::where('producto_id',$buyProducts->producto_id)->first();
                }
                if($request->arrFacturado[$indice] == 'NO'){
                    $search_producto = Almacen::where('producto_id',$buyProducts->producto_id)->first();
                }
                
                $resta= $search_producto->stock - $quantity_stock;
                $sumsalidas=$search_producto->salidas + $quantity_stock;
                $search_producto->stock = $resta;
                $search_producto->salidas = $sumsalidas;
                $search_producto->save();
            }
                
                return response()->json(['mensaje'=>'success']);
            
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
        ->addColumn( 'buttons', '<a class="btn btn-sm btn-verde" href="{{route(\'venta.nota.show\', $idVenta)}}" data-toggle="tooltip" data-placement="top" title="Nota"><span class="fas fa-clipboard"></span></a>'.
                                '<button class="btn btn-sm btn-destroy" data-id="{{$idVenta}}"  data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash"></i></button>')
        // ->addColumn( 'btn-edit', '<button class="btn btn-outline-secondary btn-class-edit btn-xs" data-id="{{$idProducto}}"><span class="far fa-eye"></span></button>')
        ->rawColumns(['buttons'])
        ->toJson();
    }
    public function nota_show($idVenta){
        $nota=Venta::
        join('cliente', 'cliente.id','=', 'venta.cliente_id')
        ->select('cliente.nombre as cliente','venta.*')
        ->where('venta.id',$idVenta)->first();
        
        $productos=VentaProducto::
        join("producto","producto.id","venta_productos.producto_id")
        ->select("producto.nombre", "venta_productos.*")
        ->where('venta_id',$idVenta)->get();

        $data=["nota"=>$nota, "productos"=>$productos];
        return view('venta.notas.show', $data);
    }

    
    public function destroy(Venta $id){

        $ventaProductos = VentaProducto::where('venta_id',$id->id)->get();
        foreach ($ventaProductos as $ventaProducto) {
            $productoId = $ventaProducto->producto_id;
            $cantidadVenta = $ventaProducto->cantidad;
            if( $ventaProducto->facturado == 'SI'){
                $stock_almacen = AlmacenFiscal::where('producto_id',$productoId)->first();
                $suma=$stock_almacen->stock + $cantidadVenta;
                $sumaEntradas=$stock_almacen->entradas + $cantidadVenta;
                $stock_almacen->stock = $suma;
                $stock_almacen->entradas = $sumaEntradas;
                $stock_almacen->save();
            }
            if( $ventaProducto->facturado == 'NO'){
                $stock_almacen = Almacen::where('producto_id',$productoId)->first();
                $suma=$stock_almacen->stock +  $cantidadVenta;
                $suma_tradas=$stock_almacen->entradas + $cantidadVenta;

                $stock_almacen->stock = $suma;
                $stock_almacen->entradas = $suma_tradas;
                $stock_almacen->save();
                
            }
        }

        VentaProducto::where('venta_id',$id->id)->delete();
        $id->delete();
    }

}
