<?php

namespace App\Http\Controllers;

use App\Models\Provedor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProvedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        return view('provedor.index');
    }

    public function data(){
            $tanques=Provedor::
            select('provedor.*');
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

        $provedor = new Provedor();
        $provedor->nombre = $request->nombre;
        $provedor->direccion = $request->direccion;
        $provedor->telefono = $request->telefono;
        $provedor->correo = $request->correo;

        if($provedor->save()){
            return response()->json(['mensaje'=>'Registrado Correctamente']);
        }
    }

    public function show(Provedor $id){
        return response()->json(['data'=>$id]);    
        // return $data;
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
        ]);
        $provedor = Provedor::find($id);
        $provedor->nombre = $request->nombre;
        $provedor->direccion = $request->direccion;
        $provedor->telefono = $request->telefono;
        $provedor->correo = $request->correo;
        if($provedor->save()){
            return response()->json(['mensaje'=>' Editado Correctamente']);
        }
    }

    public function destroy(Provedor $id){

        dump($id);
        if($id->delete()){
            return response()->json(['mensaje'=>'Eliminado Correctamente']);
        }
    }

}