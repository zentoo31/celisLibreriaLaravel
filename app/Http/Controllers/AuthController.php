<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator  = Validator::make($request -> all(),[
            'nombre' => 'required|string',
            'correo' => 'required|email|unique:user,correo',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $password = $request->password;
        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);

        Usuario::create([
            'id' => (string) Str::uuid(),
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'password' => $passwordHashed
        ]);

        return response()->json(true, 201);    
    }

    public function login(Request $request) {
        $credentials = $request->only('correo', 'password');
    
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }
    
        $cookie = cookie('auth_token', $token, 120);
        return response()->json(['message' => 'Inicio de sesión exitoso'], 200)->withCookie($cookie);
    }

    public function logout(){
        $cookie = cookie('auth_token', null, -1);
        return response()->json(['message' => 'Cierre de sesión exitoso'], 200)->withCookie($cookie);
    }


}
