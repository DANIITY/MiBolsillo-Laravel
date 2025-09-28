<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use Illuminate\Http\Request;

class SubcategoriaController extends Controller
{
    public function index(Request $req){
        if($req->id){
            $subcategoria = Subcategoria::find($req->id);
        }
        else{
            $subcategoria = new Subcategoria();
        }
        return view('subcategoria',compact('subcategoria'));
}
public function getAPI(Request $req){
    $idUsuario = $request->query('id_usuario');
    $subcategoria = Subcategoria::find($req->id);
    return response()->json($subcategoria);
}

public function listAPI(Request $req) {
    if ($req->has('id_usuario')) {
        $subcategorias = Subcategoria::whereHas('categoria', function ($query) use ($req) {
            $query->where('id_usuario', $req->id_usuario);
        })->get();
    } else {
        $subcategorias = Subcategoria::all();
    }
    return response()->json($subcategorias);
}

public function saveAPI(Request $req){
    if($req->id !=0){
        $subcategoria = Subcategoria::find($req->id);
    }
    else{
        $subcategoria = new Subcategoria();
    }
    
    $subcategoria -> id_c = $req->id_c;
    $subcategoria -> nombre = $req->nombre;
    $subcategoria -> precio = $req->precio;
    $subcategoria -> fech = $req->fech;
    $subcategoria -> id_m = $req->id_m;
    
    $subcategoria->save();  
    return "ok";

}
public function updateAPI(Request $req, $id){
    if($req->id !=0){
        $subcategoria = Subcategoria::find($req->id);
    }
    else{
        $subcategoria = new Subcategoria();
    }
    $subcategoria -> id = $req->id;
    $subcategoria -> id_c = $req->id_c;
    $subcategoria -> nombre = $req->nombre;
    $subcategoria -> precio = $req->precio;
    $subcategoria -> fech = $req->fech;
    $subcategoria -> id_m = $req->id_m;
    
    $subcategoria->save();  
    return "ok";

}
public function deleteAPI(Request $req, $id){
    $subcategoria = Subcategoria::find($req->id);
    $subcategoria->delete();
    return "ok";

}
}
