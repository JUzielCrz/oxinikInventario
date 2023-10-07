<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\AlmacenFiscal;
use App\Models\Compra;
use App\Models\CompraProducto;
use App\Models\Producto;
use App\Models\Provedor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CompraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
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
            'folio' => ['required'],
            'tipo_folio' => ['required'],
            'total_general' => ['required'],
            'fecha' => ['required'],
        ]);
        

        if(count($request->arrProducto) > 0){
            
            //CREAR COMPRA
            $cadenaProvedor=explode('- ', $request->provedor);
            $compra = new Compra();
            $compra->provedor_id = intval($cadenaProvedor[0]);
            $compra->tipo_folio = $request->tipo_folio;
            $compra->folio = $request->folio;
            $compra->total_general = $request->total_general;
            $compra->observaciones = $request->observaciones;
            $compra->fecha = $request->fecha;
            $compra->save();
            
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

                $buyProducts=new CompraProducto();
                $buyProducts->compra_id = $compra->id;
                $buyProducts->producto_id = $producto_id;
                $buyProducts->cantidad = $quantity_stock;
                $buyProducts->subtotal = $request->arrSubTotal[$indice];
                $buyProducts->iva = $request->arrIva[$indice];
                $buyProducts->total = $request->arrTotal[$indice];
                $buyProducts->facturado = $request->arrFacturado[$indice];
                $buyProducts->save();

                if($request->arrFacturado[$indice] == 'SI'){
                    $stock_almacen = AlmacenFiscal::where('producto_id',$buyProducts->producto_id)->first();
                    if($stock_almacen){
                        $suma=$stock_almacen->stock +  $quantity_stock;
                        $sumentradas=$stock_almacen->entradas+$quantity_stock;
                        $stock_almacen->stock = $suma;
                        $stock_almacen->entradas = $sumentradas;
                        $stock_almacen->save();
                    }else{
                        $new_registro= new AlmacenFiscal();
                        $new_registro->producto_id = $buyProducts->producto_id;
                        $new_registro->stock =$quantity_stock;
                        $new_registro->entradas = $quantity_stock;
                        $new_registro->save();
                    }
                }else{
                    $stock_almacen = Almacen::where('producto_id',$buyProducts->producto_id)->first();
                    $suma=$stock_almacen->stock +  $quantity_stock;
                    $sumentradas=$stock_almacen->entradas+$buyProducts->cantidad;
                    $stock_almacen->stock = $suma;
                    $stock_almacen->entradas = $sumentradas;
                    $stock_almacen->save();
                }
            }
            return response()->json(['mensaje'=>'success']);
        
        }
    }


    public function index_nota(){
        return view('compra.notas.lista');
    }

    public function nota_data(){
        $notas=Compra::
        join('provedor','provedor.id','compra.provedor_id')
        ->select('nombre as provedor', 'folio', 'fecha','total_general', 'compra.id as idCompra');
        return DataTables::of(
            $notas
        )
        ->addColumn( 'btnShow', '<a class="btn btn-sm btn-verde" href="{{route(\'compras.nota.show\', $idCompra)}}" data-toggle="tooltip" data-placement="top" title="Nota"><span class="fas fa-clipboard"></span></a>'.
        '<a class="btn btn-edit"  href="{{route(\'compras.nota.edit\', $idCompra)}}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>')
        // ->addColumn( 'btn-edit', '<button class="btn btn-outline-secondary btn-class-edit " data-id="{{$idCompra}}"><span class="far fa-eye"></span></button>')
        // ->addColumn( 'btn-stock', '<button class="btn btn-outline-secondary btn-class-stock btn-xs" data-id="{{$idProducto}}"><i class="fas fa-exchange-alt fa-rotate-90"></i></span></button>')
        ->rawColumns(['btnShow'])
        ->toJson();
    }
    public function nota_show($idCompra){
        $nota=Compra::
        join('provedor', 'provedor.id','=', 'compra.provedor_id')
        ->select('provedor.nombre as provedor','compra.*')
        ->where('compra.id',$idCompra)->first();
        
        $productos=CompraProducto::
        join('producto', 'producto.id','=','compra_productos.producto_id')
        ->select('producto.nombre','compra_productos.*')
        ->where('compra_id',$idCompra)->get();
        
        $data=["nota"=>$nota, "productos"=>$productos];
        return view('compra.notas.show', $data);
    }

    public function edit($idCompra){
        $nota=Compra::
        join('provedor', 'provedor.id','=', 'compra.provedor_id')
        ->select('provedor.nombre as nombreProvedor', 'provedor.id as idProvedor','compra.*')
        ->where('compra.id',$idCompra)->first();
        $proveedor=$nota->idProvedor.'- '.$nota->nombreProvedor;
        
        $productos=CompraProducto::
        join('producto', 'producto.id','=','compra_productos.producto_id')
        ->select('producto.nombre', 'producto.unidad_conversion', 'producto.unidad_medida_base', 'producto.unidad_medida_secundaria','compra_productos.*')
        ->where('compra_id',$idCompra)->get();
        
        $data=["nota"=>$nota, "productos"=>$productos, "proveedor"=>$proveedor];
        return view('compra.notas.edit', $data);
        
    }

    public function update_encabezado(Request $request,$id){
        $request->validate([
            'provedor' => ['required'],
            'folio' => ['required'],
            'tipo_folio' => ['required'],
            'fecha' => ['required'],
        ]);
        dd($request->all());

        $cadenaProvedor=explode('- ', $request->provedor);

        $compra = Compra::find($id);
        $compra->provedor_id = intval($cadenaProvedor[0]);
        $compra->tipo_folio = $request->tipo_folio;
        $compra->folio = $request->folio;
        $compra->observaciones = $request->observaciones;
        $compra->fecha = $request->fecha;
        $compra->save();

    }

    public function product_add(Request $request,$nota_id){
            $cadenaProducto=explode('- ', $request->producto);
            $producto_id= intval($cadenaProducto[0]);
            $product= Producto::find($producto_id);

            //CALCULAR STOCK
            $unit_measure =  $request->unidad_medida;
            $quantity = $request->cantidad;
            if ($unit_measure == 'unidad_medida_base'){
                $quantity_stock = $quantity;
            }else if($unit_measure == 'unidad_medida_secundaria'){
                $quantity_stock = $quantity * $product->unidad_conversion;
            }            
            

            $buy_product = new CompraProducto();
            $buy_product->compra_id = $nota_id;
            $buy_product->producto_id = $producto_id;
            $buy_product->cantidad = $quantity_stock;
            $buy_product->subtotal = $request->subtotal;
            $buy_product->iva = $request->iva;
            $buy_product->total = $request->total;
            $buy_product->facturado = $request->facturado;
            $buy_product->save();


            if($request->facturado== 'SI'){
                $stock_almacen = AlmacenFiscal::where('producto_id',$buy_product->producto_id)->first();
                if($stock_almacen){
                    $suma=$stock_almacen->stock +  $quantity_stock;
                    $sumentradas=$stock_almacen->entradas+$quantity_stock;
                    $stock_almacen->stock = $suma;
                    $stock_almacen->entradas = $sumentradas;
                    $stock_almacen->save();
                }else{
                    $new_registro= new AlmacenFiscal();
                    $new_registro->producto_id = $buy_product->producto_id;
                    $new_registro->stock =$quantity_stock;
                    $new_registro->entradas = $quantity_stock;
                    $new_registro->save();
                }
            }else{
                $stock_almacen = Almacen::where('producto_id',$buy_product->producto_id)->first();
                $suma=$stock_almacen->stock +  $quantity_stock;
                $sumentradas=$stock_almacen->entradas+$quantity_stock;
                $stock_almacen->stock = $suma;
                $stock_almacen->entradas = $sumentradas;
                $stock_almacen->save();
            }
            
            $preciosProductos= CompraProducto::where('compra_id', $nota_id)->sum('total');
            $compra= Compra::find($nota_id);
            $compra->total_general = $preciosProductos;
            $compra->save();
            
    }

    public function nota_product_delete($id){
        $productos=CompraProducto::find($id);

        if($productos->facturado == 'SI'){
            $stock_almacen = AlmacenFiscal::where('producto_id',$productos->producto_id)->first();
            $resta=$stock_almacen->stock - $productos->cantidad;
            $restatradas=$stock_almacen->entradas - $productos->cantidad;
            $stock_almacen->stock = $resta;
            $stock_almacen->entradas = $restatradas;
            $stock_almacen->save();
        }else{
            $stock_almacen = Almacen::where('producto_id',$productos->producto_id)->first();
            $resta=$stock_almacen->stock -  $productos->cantidad;
            $resta_tradas=$stock_almacen->entradas - $productos->cantidad;

            $stock_almacen->stock = $resta;
            $stock_almacen->entradas = $resta_tradas;
            $stock_almacen->save();
        }

        if($productos->delete()){
            return response()->json(['mensaje'=>'Eliminado Correctamente']);
        }
    }

}
