<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
class Usuario extends Authenticatable implements JWTSubject
{

    protected $table = 'user'; 

    protected $fillable = [
        'id',
        'nombre', 
        'correo', 
        'password', 
        'role_id'
    ];

    protected $hidden = [
        'password', 
    ];

    use HasFactory;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
