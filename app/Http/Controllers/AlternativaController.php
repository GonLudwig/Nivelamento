<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorealternativaRequest;
use App\Http\Requests\UpdatealternativaRequest;
use App\Models\alternativa;

class AlternativaController extends Controller
{
    public function __construct(alternativa $alternativa)
    {
        $this->alternativa = $alternativa;
    }

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
     * @param  \App\Models\alternativa  $alternativa = Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatealternativaRequest  $request
     * @param  \App\Models\alternativa  $alternativa = Integer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatealternativaRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\alternativa  $alternativa = Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
