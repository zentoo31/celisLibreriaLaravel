<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roles::create([
            'nombreRol' => 'Empleado',
            'descripcion' => 'Rol del empleado'
        ]);
        Roles::create([
            'nombreRol' => 'Administrador',
            'descripcion' => 'Rol del administrador'
        ]);
    }
}
