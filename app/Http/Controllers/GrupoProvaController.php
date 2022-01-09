<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storegrupo_provaRequest;
use App\Http\Requests\Updategrupo_provaRequest;
use App\Models\grupo_prova;

class GrupoProvaController extends Controller
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
     * @param  \App\Http\Requests\Storegrupo_provaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storegrupo_provaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\grupo_prova  $grupo_prova
     * @return \Illuminate\Http\Response
     */
    public function show(grupo_prova $grupo_prova)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\grupo_prova  $grupo_prova
     * @return \Illuminate\Http\Response
     */
    public function edit(grupo_prova $grupo_prova)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updategrupo_provaRequest  $request
     * @param  \App\Models\grupo_prova  $grupo_prova
     * @return \Illuminate\Http\Response
     */
    public function update(Updategrupo_provaRequest $request, grupo_prova $grupo_prova)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\grupo_prova  $grupo_prova
     * @return \Illuminate\Http\Response
     */
    public function destroy(grupo_prova $grupo_prova)
    {
        //
    }
}
