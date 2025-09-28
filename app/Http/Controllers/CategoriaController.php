<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(Request $req){
        if($req->id){
            $categoria = Categoria::find($req->id);
        }
        else{
            $categoria = new Categoria();
        }
        return view('categoria',compact('categoria'));
}
public function getAPI(Request $req){
    $categoria = Categoria::find($req->id);
    return response()->json($categoria);
}

public function listAPI(Request $req) {
    if ($req->has('id_usuario')) {
        $categoria = Categoria::where('id_usuario', $req->id_usuario)->get();
    } else {
        $categoria = Categoria::all();
    }
    return response()->json($categoria);
}


public function saveAPI(Request $req){
    if($req->id !=0){
        $categoria = Categoria::find($req->id);
    }
    else{
        $categoria = new Categoria();
    }
    
    $categoria -> nombre = $req->nombre;
    $categoria -> id_usuario = $req->id_usuario;
    $categoria->save();  
    return "ok";

}
public function updateAPI(Request $req, $id){
    if($req->id !=0){
        $categoria = Categoria::find($req->id);
    }
    else{
        $categoria = new Categoria();
    }
    $categoria -> id = $req->id;
    $categoria -> nombre = $req->nombre;
    $categoria -> id_usuario = $req->id_usuario;
    $categoria->save();  
    return "ok";

}
public function deleteAPI(Request $req, $id){
    $categoria = Categoria::find($req->id);
    $categoria->delete();
    return "ok";

}
}
