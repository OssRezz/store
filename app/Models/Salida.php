<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    use HasFactory;
    protected $fillable = [
        'producto_id',
        'user_id',
        'cantidad',
        'observaciones',
    ];

    public function ProductoFk()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
