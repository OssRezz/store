<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $fillable = [
        'valor_total',
        'observaciones',
        'fecha',
        'users_id',
    ];
    public function UsuarioFk()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
