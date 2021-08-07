<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        return view('cliente.index');
    }

    public function data(){
            $tanques=Cliente::
            select('cliente.*');
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
        ]);

        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->telefono = $request->telefono;
        $cliente->correo = $request->correo;
        $cliente->rfc = $request->rfc;
        $cliente->direccion = $request->direccion;
        $cliente->referencia = $request->referencia;
        $cliente->observaciones = $request->observaciones;

        if($cliente->save()){
            return response()->json(['mensaje'=>'Registrado Correctamente']);
        }
    }

    public function show(Cliente $id){
        return response()->json(['data'=>$id]);    
        // return $data;
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
        ]);
        $cliente = Cliente::find($id);
        $cliente->nombre = $request->nombre;
        $cliente->telefono = $request->telefono;
        $cliente->correo = $request->correo;
        $cliente->rfc = $request->rfc;
        $cliente->direccion = $request->direccion;
        $cliente->referencia = $request->referencia;
        $cliente->observaciones = $request->observaciones;
        if($cliente->save()){
            return response()->json(['mensaje'=>' Editado Correctamente']);
        }
    }

    public function destroy(Cliente $id){

        if($id->delete()){
            return response()->json(['mensaje'=>'Eliminado Correctamente']);
        }
    }

}