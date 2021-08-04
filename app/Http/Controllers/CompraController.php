<?php

namespace App\Http\Controllers;

use App\Models\Compra;
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

    public function save(Request $request)
    { 
        // dump($request->all());
        $request->validate([
            'provedor' => ['required'],
            'folio_factura' => ['required', 'numeric'],
        ]);

        if(count($request->arrProducto) > 0){
            $compra = new Compra();
            $compra->provedor = $request->provedor;
            $compra->save();

            foreach( $request->arrProducto AS $series => $g){
                $productos=new NotaTanque;
                $productos->provedor = $request->arrProvedor[$series];
                $productos->save();
            }
        }
        // return response()->json(['mensaje'=>'error']);
    }
}
