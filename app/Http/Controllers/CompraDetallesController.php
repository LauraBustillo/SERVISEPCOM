<?php

namespace App\Http\Controllers;

use App\Models\CompraDetalles;
use App\Http\Requests\StoreCompraDetallesRequest;
use App\Http\Requests\UpdateCompraDetallesRequest;

class CompraDetallesController extends Controller
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
     * @param  \App\Http\Requests\StoreCompraDetallesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompraDetallesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompraDetalles  $compraDetalles
     * @return \Illuminate\Http\Response
     */
    public function show(CompraDetalles $compraDetalles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompraDetalles  $compraDetalles
     * @return \Illuminate\Http\Response
     */
    public function edit(CompraDetalles $compraDetalles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompraDetallesRequest  $request
     * @param  \App\Models\CompraDetalles  $compraDetalles
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompraDetallesRequest $request, CompraDetalles $compraDetalles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompraDetalles  $compraDetalles
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompraDetalles $compraDetalles)
    {
        //
    }
}
