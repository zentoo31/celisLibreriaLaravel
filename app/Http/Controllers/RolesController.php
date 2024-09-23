<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;

class RolesController extends Controller
{
    public function createRole(Request $request){
        $role = Roles::create([
                'nombreRol' => $request->nombreRol,
                'descripcion' => $request->descripcion
        ]);

        if (!$role) {
            $data = [
                'message' => 'error al crear el rol',
                'status' => '500'
            ];
            return response()->json($data, 500);
        }

        $data = [
            'role' => $role,
            'status' => 201
        ];

        return response()-> json($data, 201);
    }
}
