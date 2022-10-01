<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;
    protected $table = 'detalle_compra';
    protected $fillable = [
        'compra_id',
        'producto_id',
        'cantidad',
        'valor',
    ];
    public function ProductoFk()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
