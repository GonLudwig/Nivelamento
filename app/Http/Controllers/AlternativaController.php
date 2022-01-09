<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorealternativaRequest;
use App\Http\Requests\UpdatealternativaRequest;
use App\Models\alternativa;

class AlternativaController extends Controller
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
     * @param  \App\Http\Requests\StorealternativaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorealternativaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\alternativa  $alternativa
     * @return \Illuminate\Http\Response
     */
    public function show(alternativa $alternativa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\alternativa  $alternativa
     * @return \Illuminate\Http\Response
     */
    public function edit(alternativa $alternativa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatealternativaRequest  $request
     * @param  \App\Models\alternativa  $alternativa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatealternativaRequest $request, alternativa $alternativa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\alternativa  $alternativa
     * @return \Illuminate\Http\Response
     */
    public function destroy(alternativa $alternativa)
    {
        //
    }
}
