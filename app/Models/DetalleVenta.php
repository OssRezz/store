<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;
    protected $table = 'detalle_venta';

    public function ProductoFk()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
    public function Ventas()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }

}
