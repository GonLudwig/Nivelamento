<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNivelEnsinoRequest;
use App\Http\Requests\UpdateNivelEnsinoRequest;
use App\Models\NivelEnsino;
use App\Repositories\NivelEnsinoRepository;

class NivelEnsinoController extends Controller
{
    public function __construct(NivelEnsino $nivelEnsino)
    {
        $this->nivelEnsino = $nivelEnsino;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\StoreNivelEnsinoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(StoreNivelEnsinoRequest $request)
    {
        $nivelEnsinoRepository = new NivelEnsinoRepository($this->nivelEnsino);

        if($request->has('filtros')){
            $nivelEnsinoRepository->filtros($request->filtros);
        }

        if($request->has('atributos')){
            $atributos = $request->atributos;
            $nivelEnsinoRepository->selectAtributos($atributos);
        }

        return response()->json($nivelEnsinoRepository->getResultado(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNivelEnsinoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNivelEnsinoRequest $request)
    {
        $request->validate($this->nivelEnsino->rules());
        $nivelEnsino = $this->nivelEnsino->create([
            'nome' => $request->nome
        ]);

        return response()->json($nivelEnsino, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NivelEnsino  $nivelEnsino = Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nivelEnsino = $this->nivelEnsino->find($id);
        if($nivelEnsino === null){
            return response()->json(['erro' => 'Nao exisite esta nivel de ensino'], 404);
        }
        return response()->json($nivelEnsino, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNivelEnsinoRequest  $request
     * @param  \App\Models\NivelEnsino  $nivelEnsino = Integer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNivelEnsinoRequest $request, $id)
    {
        $nivelEnsino = $this->nivelEnsino->find($id);

        if(!$nivelEnsino){
            return response()->json(['erro' => 'Nao exisite esta nivel de ensino'], 404);
        }

        if($request->method() === 'PATCH'){

            $regrasDinamicas = array();
            foreach ($nivelEnsino->rules() as $input => $regras) {
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regras;
                }
            }
            $request->validate($regrasDinamicas);
        }else {
            $request->validate($nivelEnsino->rules());
        }

        $nivelEnsino->fill($request->all());
        $nivelEnsino->save();
        return response()->json($nivelEnsino, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NivelEnsino  $nivelEnsino = Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nivelEnsino = $this->nivelEnsino->find($id);
        if(!$nivelEnsino){
            return response()->json(['erro' => 'Nao exisite este nivel de ensino'], 404);
        }

        $nivelEnsino->delete();
        return response()->json(['msg' => 'nivel de Ensino foi deletado!'], 200);
    }
}
