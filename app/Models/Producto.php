<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'codigo',
        'precio_venta',
        'precio_compra',
        'utilidad',
        'estado',
    ];

    public function Producto()
    {
        return $this->hasMany(Producto::class);
    }
}
