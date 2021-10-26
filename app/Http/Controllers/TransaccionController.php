<?php

namespace App\Http\Controllers;

use App\Models\Transaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transacciones = Transaccion::whereDate('created_at', '=', date('Y-m-d'))
            ->where('id_usuario', auth()->user()->id)->get();

        return view('transacciones', compact('transacciones'))->with('user', Auth::user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaccion_create',)->with('user', Auth::user());
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
            'detalle' => ['required', 'max:250'],
            'observaciones' => ['max:250'],
            'total' => ['required', 'numeric', 'between:0,999.99']
        ]);
        $credentials['id_usuario'] = Auth::user()->id;
        $credentials['es_ingreso'] = $request->has('es_ingreso');
        
        $transaccion = Transaccion::create($credentials);

        return redirect()->route('transacciones');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaccion  $transaccion
     * @return \Illuminate\Http\Response
     */
    public function show(Transaccion $transaccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaccion  $transaccion
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaccion $transaccion)
    {
        return view('transaccion_edit', compact('transaccion'))->with('user', Auth::user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaccion  $transaccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaccion $transaccion)
    {
        $credentials = $request->validate([
            'detalle' => ['required', 'max:250'],
            'observaciones' => ['max:250'],
            'total' => ['required', 'numeric', 'between:0,999.99']
        ]);
        $credentials['es_ingreso'] = $request->has('es_ingreso');

        $transaccion->update($credentials);

        return redirect()->route('transacciones');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaccion  $transaccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaccion $transaccion)
    {
        $transaccion->delete();
        return redirect()->route('transacciones');
    }
}
