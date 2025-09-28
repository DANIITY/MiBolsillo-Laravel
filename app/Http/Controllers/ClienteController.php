<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    public function index(Request $req)
    {
        if ($req->id) {
            $cliente = Cliente::find($req->id);
        } else {
            $cliente = new Cliente();
        }
        return view('cliente', compact('cliente'));
    }

    public function getAPI(Request $req)
    {
        $cliente = Cliente::find($req->id);
        return response()->json($cliente);
    }

    public function listAPI()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }

    public function saveAPI(Request $req)
    {
        // Buscar o crear el usuario
        $user = $req->id ? User::find($req->id) : new User();
        if (!$user) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }
    
        // Guardar o actualizar el usuario
        $user->name = $req->nombre;
        $user->email = $req->correo;
        $user->rol = 'cliente'; // Asignar rol 'cliente'
        if ($req->password) {
            $user->password = Hash::make($req->password);
        }
        $user->save();
    
        // Crear o actualizar el cliente
        $cliente = $req->id ? Cliente::find($req->id) : new Cliente();
        $cliente->user_id = $user->id;
        $cliente->additional_field = $req->additional_field; // Otros campos adicionales
        $cliente->save();
    
        // Enviar notificación de bienvenida
        $user->notify(new \App\Notifications\WelcomeNotification());
    
        // Autenticar y generar token
        if (Auth::attempt(['email' => $req->correo, 'password' => $req->password])) {
            $token = $user->createToken('app')->plainTextToken;
            return response()->json([
                'acceso' => "ok",
                'error' => "",
                'token' => $token,
                'idUsuario' => $user->id,
                'nombreUsuario' => $user->name
            ]);
        } else {
            return response()->json(['error' => 'Autenticación fallida'], 401);
        }
    }


    public function updateAPI(Request $req, $id)
    {
        $cliente = Cliente::find($id);
        
        if ($cliente) {
            $cliente->user_id = $req->user_id;
            $cliente->name = $req->name;
            $cliente->email = $req->email;
            if ($req->password) {
                $cliente->password = Hash::make($req->password); // Encriptar si hay nueva contraseña
            }
            $cliente->additional_field = $req->additional_field;

            $cliente->save();
            return "ok";
        }
        
        return response()->json(['error' => 'Cliente no encontrado'], 404);
    }

    public function deleteAPI(Request $req, $id)
    {
        $cliente = Cliente::find($id);
        
        if ($cliente) {
            $cliente->delete();
            return "ok";
        }
        
        return response()->json(['error' => 'Cliente no encontrado'], 404);
    }
}
