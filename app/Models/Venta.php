<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_usuario',
        'nombre',
        'pagado',
        'observaciones',
        'total',
        'fecha_pago',
    ];

    public static function ventasMes($mes){
        $ventas = Venta::whereMonth('fecha_pago', '=', $mes)
        ->whereYear('created_at', '=', date('Y'))->get();

        $total=0;
        foreach ($ventas as $venta) {
            $total=$total+$venta->total;
        }
        return $total;
    }
}
