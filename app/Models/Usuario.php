<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    public $timestamps = false; 
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'cpf',
        'senha',
        'tipo',
    ];

    protected $hidden = [
        'senha',
    ];

    protected $casts = [
        'senha' => 'hashed',
    ];

    // Método para autenticação personalizada
    public function getAuthPassword()
    {
        return $this->senha;
    }
}
