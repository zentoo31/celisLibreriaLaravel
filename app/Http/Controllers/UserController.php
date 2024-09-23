<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
            return response()->json($data, 500);
        }

        
        
    }
}
