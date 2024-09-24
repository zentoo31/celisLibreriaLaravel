<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'user';
    protected $fillable = [
        'id',
        'nombre', 
        'correo', 
        'password', 
        'role_id'
    ];

}
