<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorequestaoRequest;
use App\Http\Requests\UpdatequestaoRequest;
use App\Models\questao;

class QuestaoController extends Controller
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
     * @param  \App\Http\Requests\StorequestaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorequestaoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\questao  $questao
     * @return \Illuminate\Http\Response
     */
    public function show(questao $questao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\questao  $questao
     * @return \Illuminate\Http\Response
     */
    public function edit(questao $questao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatequestaoRequest  $request
     * @param  \App\Models\questao  $questao
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatequestaoRequest $request, questao $questao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\questao  $questao
     * @return \Illuminate\Http\Response
     */
    public function destroy(questao $questao)
    {
        //
    }
}
