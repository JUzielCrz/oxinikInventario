<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Config;


class ConfigController extends Controller
{
    //
    public function index(){
        $config= Config::find(1);
        return view('configuracion.index', compact('config'));
    }

    public function save(Request $request){
        $request->validate([
            'name' => 'required',
            'logo' => 'image|mimes:jpeg,jpg,png,svg,webp',
        ]);
        $imgDelete=Config::find(1);
        $product =  request()->except(['_token']);

  
        if ($image = $request->file('logo')) {
            \File::delete(public_path('img/'. $imgDelete->logo));
            $profileImage = "logo"."-" .date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move('img/', $profileImage);
            $product['logo'] = "$profileImage";
        }else{
            unset($product['logo']);
        }
    
        Config::where('id', 1)->update($product);
        return redirect()->route('configuracion.index');
    }

    public function getconfig(){
        $config=Config::find(1);
        return $config;
    }
}
