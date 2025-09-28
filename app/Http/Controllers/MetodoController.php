<?php

namespace App\Http\Controllers;

use App\Models\Metodo;
use Illuminate\Http\Request;

class MetodoController extends Controller
{
    public function getAPI(Request $req){
        $metodo = Metodo::find($req->id);
        return response()->json($metodo);
    }

    public function listAPI(Request $req)
    {
        $metodos = $req->has('id_usuario') 
            ? Metodo::where('id_usuario', $req->id_usuario)->get() 
            : Metodo::all();
        return response()->json($metodos);
    }

    public function saveAPI(Request $req)
    {
        $metodo = $req->id ? Metodo::find($req->id) : new Metodo();
        $metodo->tipo = $req->tipo;
        $metodo->id_usuario = $req->id_usuario;
        $metodo->save();

        return response()->json(['message' => 'Método guardado exitosamente']);
    }

    public function store(Request $request) {
        $user = auth()->user(); // Obtener usuario autenticado
        if (!$user) {
            return response()->json(['error' => 'No autenticado'], 401);
        }
        \Log::info(request()->all());
    
        Metodo::create([
            'tipo' => $request->tipo,
            'id_usuario' => $user->id, // Asegurar que el ID es del usuario autenticado
        ]);
    
        return response()->json(['mensaje' => 'Método guardado con éxito'], 200);
    }
    

    public function updateAPI(Request $req, $id)
    {
        $metodo = Metodo::find($id);
        if (!$metodo) {
            return response()->json(['error' => 'Método no encontrado'], 404);
        }

        $metodo-> id = $req->id;
        $metodo->tipo = $req->tipo;
        $metodo->id_usuario = $req->id_usuario;
        $metodo->save();

        return response()->json(['message' => 'Método actualizado exitosamente']);
    }

    public function deleteAPI(Request $req, $id)
    {
        $metodo = Metodo::find($id);
        if (!$metodo) {
            return response()->json(['error' => 'Método no encontrado'], 404);
        }

        $metodo->delete();

        return response()->json(['message' => 'Método eliminado exitosamente']);
    }
}
