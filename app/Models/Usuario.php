<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
class Usuario extends Authenticatable implements JWTSubject
{
    use Notifiable;

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

    protected $keyType = 'string'; // o 'uuid' dependiendo de la configuración
    public $incrementing = false; // No incrementar, ya que se usa UUID
        
        
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
