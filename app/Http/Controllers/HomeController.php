<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Producto;
use App\Http\Models\Bodega;

class HomeController extends Controller
{
    
    public function index()
    {
        $productos=Producto::all();
        $bodegas=Bodega::all();
        return view('home',compact("productos","bodegas"));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        $avatar = "https://www.gravatar.com/avatar/" . md5('franklin.archila@gmail.com'). "&s=80";
        return view('contact',compact("avatar"));
    }


    public function create(Request $request)
    {   
        $json = array( 'type' => 'success', 'message' => 'se registro producto', 'data' => '');
        try {
			$producto=new Producto;
			$producto->codigo=$request->input("codigo");
			$producto->nombre=$request->input("nombre");
			$producto->descripcion=$request->input("descripcion");
            $producto->estado=$request->input("estado");
            $producto->existencia=$request->input("existencia");
			$producto->id_bodega=$request->input("id_bodega");
            $producto->save();
            $json["data"]=$producto->id;
		} catch(\Exception $e) {
			$json = array( 'type' => 'error', 'message' => 'error al registrar',  'data' => '');
        }
        echo json_encode($json);
    }

    public function update(Request $request)
    {
        $json = array( 'type' => 'success', 'message' => 'se actualizo producto');
        try {
            $producto=Producto::findOrFail($request->input("id"));
			//$producto->codigo=$request->input("codigo");
			$producto->nombre=$request->input("nombre");
			$producto->descripcion=$request->input("descripcion");
            $producto->estado=$request->input("estado");
            $producto->existencia=$request->input("existencia");
			//$producto->id_bodega=$request->input("bodega");
			$producto->save();
		} catch(\Exception $e) {
			$json = array( 'type' => 'error', 'message' => 'error al editar');
        }
        echo json_encode($json);
    }
}
