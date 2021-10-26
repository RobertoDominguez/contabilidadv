<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_producto',
        'id_venta',
        'cantidad',
        'nombre_producto'
    ];
}
