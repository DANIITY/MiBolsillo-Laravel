<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Especifica la tabla asociada con el modelo
    protected $table = 'clientes';

    // Los atributos que se pueden asignar masivamente
    protected $fillable = [
        'user_id',
        'additional_field', // Cualquier campo adicional de cliente
    ];

    /**
     * Relación con el modelo User
     * Cada cliente pertenece a un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
