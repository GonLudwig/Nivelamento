<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storegrupo_alternativaRequest;
use App\Http\Requests\Updategrupo_alternativaRequest;
use App\Models\grupo_alternativa;

class GrupoAlternativaController extends Controller
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
     * @param  \App\Http\Requests\Storegrupo_alternativaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storegrupo_alternativaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\grupo_alternativa  $grupo_alternativa
     * @return \Illuminate\Http\Response
     */
    public function show(grupo_alternativa $grupo_alternativa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\grupo_alternativa  $grupo_alternativa
     * @return \Illuminate\Http\Response
     */
    public function edit(grupo_alternativa $grupo_alternativa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updategrupo_alternativaRequest  $request
     * @param  \App\Models\grupo_alternativa  $grupo_alternativa
     * @return \Illuminate\Http\Response
     */
    public function update(Updategrupo_alternativaRequest $request, grupo_alternativa $grupo_alternativa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\grupo_alternativa  $grupo_alternativa
     * @return \Illuminate\Http\Response
     */
    public function destroy(grupo_alternativa $grupo_alternativa)
    {
        //
    }
}
