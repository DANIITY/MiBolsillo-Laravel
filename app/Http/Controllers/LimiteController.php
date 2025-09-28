<?php

namespace App\Http\Controllers;

use App\Models\Limite;
use Illuminate\Http\Request;

class LimiteController extends Controller
{
    public function index(Request $req){
        if($req->id){
            $limite = Limite::find($req->id);
        }
        else{
            $limite = new Limite();
        }
        return view('limite',compact('limite'));
}
public function getAPI(Request $req){
    $limite = Limite::find($req->id);
    return response()->json($limite);
}

public function listAPI(Request $req) {
    if ($req->has('id_usuario')) {
        $limite = Limite::where('id_usuario', $req->id_usuario)->get();
    } else {
        $limite = Limite::all();
    }
    return response()->json($limite);
}


public function saveAPI(Request $req){
    if($req->id !=0){
        $limite = Limite::find($req->id);
    }
    else{
        $limite = new Limite();
    }
    
    $limite -> cantidad = $req->cantidad;
    $limite -> id_usuario = $req->id_usuario;
    $limite->save();  
    return "ok";

}
public function updateAPI(Request $req, $id){
    if($req->id !=0){
        $limite = Limite::find($req->id);
    }
    else{
        $limite = new Limite();
    }
    $limite-> id = $req->id;
    $limite -> cantidad = $req->cantidad;
    $limite -> id_usuario = $req->id_usuario;
    $limite->save();  
    return "ok";

}
public function deleteAPI(Request $req, $id){
    $limite = Limite::find($req->id);
    $limite->delete();
    return "ok";

}
}
