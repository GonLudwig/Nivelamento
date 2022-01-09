<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorenivelamentoRequest;
use App\Http\Requests\UpdatenivelamentoRequest;
use App\Models\nivelamento;

class NivelamentoController extends Controller
{
    public function __construct(nivelamento $nivelamento)
    {
        $this->nivelamento = $nivelamento;   
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\StorenivelamentoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(StorenivelamentoRequest $request)
    {
        $exibicao = array();

        if($request->has('atributos')){
            $atributos = $request->atributos;
            $exibicao = $this->nivelamento->selectRaw($atributos)->with('provas')->get();
        }else {
            $exibicao = $this->nivelamento->get();
        }

        return response()->json($exibicao, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorenivelamentoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorenivelamentoRequest $request)
    {
        $request->validate($this->nivelamento->rules());
        $nivelamento = $this->nivelamento->create($request->all());

        return response()->json($nivelamento, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\nivelamento  $nivelamento = Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nivelamento = $this->prova->with('provas')->find($id);
        if ($nivelamento === null) {
            return response()->json(['erro' => 'Nao existe este nivelamento'], 404);
        }

        return response()->json($nivelamento, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatenivelamentoRequest  $request
     * @param  \App\Models\nivelamento  $nivelamento - Integer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatenivelamentoRequest $request, $id)
    {
        $nivelamento = $this->nivelamento->find($id);

        if ($nivelamento === null) {
            return response()->json(['erro' => 'Nao existe este nivelamento'], 404);
        }

        if ($request->method() === 'PATCH'){
            $regrasDinamicas = array();
            foreach ($nivelamento->rules() as $input => $regra) {
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas);
        }else {
            $request->validate($nivelamento->rules());
        }

        $nivelamento->fill($request->all());
        $nivelamento->save();
        return response()->json($nivelamento, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\nivelamento  $nivelamento = Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nivelamento = $this->nivelamento->find($id);
        if($nivelamento === null){
            return response()->json(['erro' => 'Nao exisite este nive$nivelamento'], 404);
        }

        $nivelamento->delete();
        return response()->json(['msg' => 'nivelamento foi deletado!'], 200);
    }
}
