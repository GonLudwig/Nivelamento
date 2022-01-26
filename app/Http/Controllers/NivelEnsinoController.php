<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNivelEnsinoRequest;
use App\Http\Requests\UpdateNivelEnsinoRequest;
use App\Models\NivelEnsino;

class NivelEnsinoController extends Controller
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
     * @param  \App\Http\Requests\StoreNivelEnsinoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNivelEnsinoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NivelEnsino  $nivelEnsino
     * @return \Illuminate\Http\Response
     */
    public function show(NivelEnsino $nivelEnsino)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NivelEnsino  $nivelEnsino
     * @return \Illuminate\Http\Response
     */
    public function edit(NivelEnsino $nivelEnsino)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNivelEnsinoRequest  $request
     * @param  \App\Models\NivelEnsino  $nivelEnsino
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNivelEnsinoRequest $request, NivelEnsino $nivelEnsino)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NivelEnsino  $nivelEnsino
     * @return \Illuminate\Http\Response
     */
    public function destroy(NivelEnsino $nivelEnsino)
    {
        //
    }
}
