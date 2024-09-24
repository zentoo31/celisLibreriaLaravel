<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(){
        $users = Usuario::all();

        $data = [
            'usuarios' => $users,
            'status' => 200
        ];

        return response() -> json($data, 200);
    }

    public function createUser(Request $request){
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

    

}
