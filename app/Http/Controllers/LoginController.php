<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        

        if (!$user || $user->rol !== 'cliente') {
            $arr = array('acceso' => "", 'token' => "", 'error' => "El usuario no existe", 'idUsuario' => 0, 'nombreUsuario' => '');
            return json_encode($arr);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('app')->plainTextToken;
            $arr = array('acceso' => "ok", 'error' => "", 'token' => $token, 'idUsuario' => $user->id, 'nombreUsuario' => $user->name);
            return json_encode($arr);
        } else {
            $arr = array('acceso' => "", 'token' => "", 'error' => "Correo o contraseña incorrectos", 'idUsuario' => 0, 'nombreUsuario' => '');
            return json_encode($arr);
        }
    }

    public function hashPassword(Request $request)
    {
        $password = $request->input('password');
        $hashedPassword = Hash::make($password);
        return response()->json(['hashed_password' => $hashedPassword]);
    }

    public function verifyPassword(Request $request)
    {
        $password = $request->input('password');
        $hashedPassword = $request->input('hashed_password');

        if (Hash::check($password, $hashedPassword)) {
            return response()->json(['message' => 'Password is correct']);
        } else {
            return response()->json(['message' => 'Password is incorrect']);
        }
    }

    public function encryptData(Request $request)
    {
        $data = $request->input('data');
        $encryptedData = Crypt::encryptString($data);
        return response()->json(['encrypted_data' => $encryptedData]);
    }

    public function decryptData(Request $request)
    {
        $encryptedData = $request->input('encrypted_data');

        try {
            $decryptedData = Crypt::decryptString($encryptedData);
            return response()->json(['decrypted_data' => $decryptedData]);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json(['message' => 'Decryption failed'], 400);
        }
    }
}
