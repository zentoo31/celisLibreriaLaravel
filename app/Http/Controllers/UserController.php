<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function registerUser(Request $request){
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
            'id' => Str::uuid(),
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'password' => $passwordHashed
        ]);

        return response()->json(true, 201);    
    }

    public function loginUser(Request $request){
        $credentials = $request->only('correo', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            $data = [
                'message' => 'Credenciales inválidos',
                'status' => 201
            ];
            return response()->json($data, 401);
        }    

        $cookie = cookie('auth_token', $token, 120);
        
        $data = [
            'message' => 'Inicio de sesión exitoso',
            'status' => 200
        ]; 
        
        return response()->json($data, 200)->withCookie($cookie);
    }    

    public function getUserInfo(Request $request) {
        $user = JWTAuth::parseToken()->authenticate();
        if (!$user) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($user, 200);
    }
    

}
