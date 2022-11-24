<?php

namespace App\Http\Controllers;

use App\Models\DetallesPedido;
use App\Http\Requests\StoreDetallesPedidoRequest;
use App\Http\Requests\UpdateDetallesPedidoRequest;

class DetallesPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDetallesPedidoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDetallesPedidoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetallesPedido  $detallesPedido
     * @return \Illuminate\Http\Response
     */
    public function show(DetallesPedido $detallesPedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetallesPedido  $detallesPedido
     * @return \Illuminate\Http\Response
     */
    public function edit(DetallesPedido $detallesPedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDetallesPedidoRequest  $request
     * @param  \App\Models\DetallesPedido  $detallesPedido
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDetallesPedidoRequest $request, DetallesPedido $detallesPedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetallesPedido  $detallesPedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetallesPedido $detallesPedido)
    {
        //
    }
}
