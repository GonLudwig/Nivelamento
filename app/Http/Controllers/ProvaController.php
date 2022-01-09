<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreprovaRequest;
use App\Http\Requests\UpdateprovaRequest;
use App\Models\prova;

class ProvaController extends Controller
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
     * @param  \App\Http\Requests\StoreprovaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreprovaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\prova  $prova
     * @return \Illuminate\Http\Response
     */
    public function show(prova $prova)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\prova  $prova
     * @return \Illuminate\Http\Response
     */
    public function edit(prova $prova)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateprovaRequest  $request
     * @param  \App\Models\prova  $prova
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateprovaRequest $request, prova $prova)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\prova  $prova
     * @return \Illuminate\Http\Response
     */
    public function destroy(prova $prova)
    {
        //
    }
}
