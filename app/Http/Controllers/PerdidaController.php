<?php

namespace App\Http\Controllers;

use App\Models\Perdida;
use Illuminate\Http\Request;

class PerdidaController extends Controller
{
    public function index(Request $req){
        if($req->id){
            $perdida = Perdida::find($req->id);
        }
        else{
            $perdida = new Perdida();
        }
        return view('perdida',compact('perdida'));
}
public function getAPI(Request $req){
    $perdida = Perdida::find($req->id);
    return response()->json($perdida);
}

public function listAPI(Request $req) {
        $perdida = Perdida::all();
        return response()->json($perdida);
}


public function saveAPI(Request $req){
    if($req->id !=0){
        $perdida = Perdida::find($req->id);
    }
    else{
        $perdida = new Perdida();
    }
    
    $perdida -> correo = $req->correo;
    $perdida->save();  
    return "ok";

}
public function updateAPI(Request $req){
    if($req->id !=0){
        $perdida = Perdida::find($req->id);
    }
    else{
        $perdida = new Perdida();
    }
    $perdida -> id = $req->id;
    $perdida -> correo = $req->correo;
    $perdida->save();  
    return "ok";

}
public function deleteAPI(Request $req){
    $perdida = Perdida::find($req->id);
    $perdida->delete();
    return "ok";

}
}
