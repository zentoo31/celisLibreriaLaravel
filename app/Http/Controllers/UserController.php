<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
class UserController extends Controller
{
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
