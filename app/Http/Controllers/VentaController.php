<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Transaccion;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ventas = Venta::whereDate('created_at', '=', date('Y-m-d'))
            ->where('id_usuario', auth()->user()->id)->get();

        foreach ($ventas as $venta) {
            $detalles = DetalleVenta::where('id_venta', $venta->id)
                ->select('nombre_producto', 'cantidad')->get();
            $venta['detalles'] = $detalles;
        }

        $transacciones = Transaccion::whereDate('created_at', '=', date('Y-m-d'))
            ->where('id_usuario', auth()->user()->id)->get();

        return view('ventas', compact('ventas','transacciones'))->with('user', Auth::user());
    }

    public function deudas()
    {
        $ventas = Venta::where('id_usuario', auth()->user()->id)
            ->where('pagado', false)->get();

        foreach ($ventas as $venta) {
            $detalles = DetalleVenta::where('id_venta', $venta->id)
                ->select('nombre_producto', 'cantidad')->get();
            $venta['detalles'] = $detalles;
        }

        return view('ventas_deudas', compact('ventas'))->with('user', Auth::user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::all();
        return view('venta_create', compact('productos'))->with('user', Auth::user());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'nombre' => ['required', 'max:120'],
            'observaciones' => ['max:250'],
            'total' => ['required', 'numeric', 'between:0,999.99']
        ]);
        $credentials['id_usuario'] = Auth::user()->id;
        $credentials['pagado'] = $request->has('pagado');

        $venta_correcta = false;
        foreach ($request->values as $cantidad) {
            if ($cantidad > 0) {
                $venta_correcta = true;
            }
        }

        if ($venta_correcta) {
            $venta = Venta::create($credentials);

            $i = 0;
            foreach ($request->values as $cantidad) {
                if ($cantidad > 0) {
                    $detalle = [
                        'id_producto' => $request->productos[$i],
                        'id_venta' => $venta->id,
                        'cantidad' => $cantidad,
                        'nombre_producto' => $request->nombres_producto[$i]
                    ];
                    DetalleVenta::create($detalle);
                }
                $i = $i + 1;
            }

            return redirect()->route('ventas');
        }
        return back()->withErrors(['error' => 'Debe vender al menos un producto.'])
            ->withInput(request(['nombre', 'observaciones', 'total']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        $productos = Producto::all();

        $detalles = DetalleVenta::where('id_venta', $venta->id)
            ->select('id_producto', 'cantidad')->get();
        $venta['detalles'] = $detalles;

        return view('venta_edit', compact('productos', 'venta'))->with('user', Auth::user());
    }

    public function pagar(Venta $venta)
    {
        $venta->update([
            'pagado' => true,
            'fecha_pago' => date('Y-m-d H:i:s'),
        ]);
        return redirect()->route('ventas');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        $credentials = $request->validate([
            'nombre' => ['required', 'max:120'],
            'observaciones' => ['max:250'],
            'total' => ['required', 'numeric', 'between:0,999.99']
        ]);

        $venta_correcta = false;
        foreach ($request->values as $cantidad) {
            if ($cantidad > 0) {
                $venta_correcta = true;
            }
        }

        if ($venta_correcta) {
            DetalleVenta::where('id_venta', $venta->id)->delete();
            $venta->update($credentials);

            $i = 0;
            foreach ($request->values as $cantidad) {
                if ($cantidad > 0) {
                    $detalle = [
                        'id_producto' => $request->productos[$i],
                        'id_venta' => $venta->id,
                        'cantidad' => $cantidad,
                        'nombre_producto' => $request->nombres_producto[$i]
                    ];
                    DetalleVenta::create($detalle);
                }
                $i = $i + 1;
            }

            return redirect()->route('ventas');
        }
        return back()->withErrors(['error' => 'Debe vender al menos un producto.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        $venta->delete();
        return redirect()->route('ventas');
    }


    public function ventas(Request $request)
    {
        $fecha = $request->fecha;

        $ventas = Venta::whereDate('created_at', '=', Carbon::parse($request->fecha))
        ->where('id_usuario', auth()->user()->id)->get();

        foreach ($ventas as $venta) {
            $detalles = DetalleVenta::where('id_venta', $venta->id)
                ->select('nombre_producto', 'cantidad')->get();
            $venta['detalles'] = $detalles;
        }

        return view('ventas_fecha', compact('ventas', 'fecha'))->with('user', Auth::user());
    }



    public function caja(Request $request)
    {
        $ventas = Venta::whereMonth('fecha_pago', '=', date('m'))
            ->whereYear('fecha_pago', '=', date('Y'))->get();

        foreach ($ventas as $venta) {
            $detalles = DetalleVenta::where('id_venta', $venta->id)
                ->select('nombre_producto', 'cantidad')->get();
            $venta['detalles'] = $detalles;
        }

        $total = 0;
        $caja_roja = 0;
        $caja_verde = 0;
        $f_secos = 0;
        $wafles = 0;
        foreach ($ventas as $venta) {
            if ($venta->pagado) {
                $total = $total + $venta->total;
            }

            foreach ($venta->detalles as $detalle) {
                if ($detalle->nombre_producto == 'F. SECOS') {
                    $f_secos = $f_secos + 1;
                }

                if ($detalle->nombre_producto == 'WAFLES') {
                    $wafles = $wafles + 1;
                }
            }
        }
        $caja_roja = round($total * 0.6);
        $caja_verde = round($total * 0.4);
        $f_secos = $f_secos * 2;
        $wafles = $wafles * 4;
        $caja_verde = $caja_verde - $f_secos - $wafles;

        $datos = [
            'total' => $total,
            'caja_roja' => $caja_roja,
            'caja_verde' => $caja_verde,
            'f_secos' => $f_secos,
            'wafles' => $wafles
        ];

        return view('caja', compact('datos'))->with('user', Auth::user());
    }

    public function cajaAdmin(Request $request)
    {
        $fecha = date('Y');

        if (!is_null($fecha)) {
            $fecha = Carbon::parse($request->fecha);
        }


        $ventas = Venta::whereMonth('fecha_pago', '=', $fecha)
            ->whereYear('fecha_pago', '=', $fecha)->get();

        foreach ($ventas as $venta) {
            $detalles = DetalleVenta::where('id_venta', $venta->id)
                ->select('nombre_producto', 'cantidad')->get();
            $venta['detalles'] = $detalles;
        }

        $total = 0;
        $caja_roja = 0;
        $caja_verde = 0;
        $f_secos = 0;
        $wafles = 0;
        foreach ($ventas as $venta) {
            if ($venta->pagado) {
                $total = $total + $venta->total;
            }

            foreach ($venta->detalles as $detalle) {

                if ($detalle->nombre_producto == 'F. SECOS') {
                    $f_secos = $f_secos + 1;
                }

                if ($detalle->nombre_producto == 'WAFLES') {
                    $wafles = $wafles + 1;
                }
            }
        }
        $caja_roja = round($total * 0.6);
        $caja_verde = round($total * 0.4);
        $f_secos = $f_secos * 2;
        $wafles = $wafles * 4;
        $caja_verde = $caja_verde - $f_secos - $wafles;

        $datos = [
            'total' => $total,
            'caja_roja' => $caja_roja,
            'caja_verde' => $caja_verde,
            'f_secos' => $f_secos,
            'wafles' => $wafles
        ];

        return view('admin.caja', compact('datos', 'fecha'))->with('user', Auth::user());
    }



    public function jsonVentasMes()
    {

        Carbon::setLocale('es');
        $meses = [
            Carbon::parse(date('Y'))->subMonth(5)->translatedFormat('M Y'),
            Carbon::parse(date('Y'))->subMonth(4)->translatedFormat('M Y'),
            Carbon::parse(date('Y'))->subMonth(3)->translatedFormat('M Y'),
            Carbon::parse(date('Y'))->subMonth(2)->translatedFormat('M Y'),
            Carbon::parse(date('Y'))->subMonth(1)->translatedFormat('M Y'),
            Carbon::parse(date('Y'))->subMonth(0)->translatedFormat('M Y'),
        ];

        $ventas = [
            Venta::ventasMes(Carbon::parse(date('Y'))->subMonth(5)),
            Venta::ventasMes(Carbon::parse(date('Y'))->subMonth(4)),
            Venta::ventasMes(Carbon::parse(date('Y'))->subMonth(3)),
            Venta::ventasMes(Carbon::parse(date('Y'))->subMonth(2)),
            Venta::ventasMes(Carbon::parse(date('Y'))->subMonth(1)),
            Venta::ventasMes(Carbon::parse(date('Y'))->subMonth(0)),
        ];


        $data = [
            'categories' => $meses,
            'data' => $ventas
        ];
        return response()->json($data, 200);
    }




    //administrador

    public function ventasDia(Request $request)
    {
        $fecha = $request->fecha;

        $usuarios = User::all();

        foreach ($usuarios as $usuario) {
            $ventas = Venta::whereDate('created_at', '=', date('Y-m-d'))
                ->where('id_usuario', $usuario->id)->get();

            foreach ($ventas as $venta) {
                $detalles = DetalleVenta::where('id_venta', $venta->id)
                    ->select('nombre_producto', 'cantidad')->get();
                $venta['detalles'] = $detalles;
            }

            $usuario['ventas'] = $ventas;
        }

        return view('admin.ventas', compact('usuarios', 'fecha'))->with('user', Auth::user());
    }
}
