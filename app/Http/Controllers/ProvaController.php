<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreprovaRequest;
use App\Http\Requests\UpdateprovaRequest;
use App\Models\prova;

class ProvaController extends Controller
{
    public function __construct(prova $prova)
    {
        $this->prova = $prova;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\StoreprovaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(StoreprovaRequest $request)
    {
        $modelo = $this->prova;
        $atributos = '';

        if($request->has('atributos_nivelamento')){
            $atributosNivelamento = $request->atributos_nivelamento;
            $modelo = $modelo->with('nivelamento:id,'.$atributosNivelamento);
            $atributos = 'nivelamento_id,';
        }else{
            $modelo = $modelo->with('nivelamento');
        }

        if($request->has('atributos_questoes')){
            $atributosQuestoes = $request->atributos_questoes;
            $modelo = $modelo->with('questoes:id',$atributosQuestoes);
        }else{
            $modelo = $modelo->with('questoes');
        }

        if($request->has('filtros')){
            $filtros = explode(';', $request->filtros);
            foreach ($filtros as $key => $condicao) {
                $filtro = explode(':', $condicao);
                $modelo = $modelo->where($filtro[0], $filtro[1], $filtro[2]);
            }
        }

        if($request->has('atributos')){
            $atributos .= $request->atributos;
            $modelo = $modelo->selectRaw($atributos)->get();
        }else{
            $modelo = $modelo->selectRaw($atributos.'id, nome')->get();
        }

        return response()->json($modelo, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreprovaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreprovaRequest $request)
    {
        $request->validate($this->prova->rules());
        $prova = $this->prova->create($request->all());

        return response()->json($prova, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\prova  $prova = Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prova = $this->prova->with('nivelamento')->with('questoes')->find($id);
        if($prova === null){
            return response()->json(['erro' => 'Nao exisite esta prova'], 404);
        }
        return response()->json($prova, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateprovaRequest  $request
     * @param  \App\Models\prova  $prova = Integer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateprovaRequest $request, $id)
    {
        $prova = $this->prova->find($id);

        if($prova === null){
            return response()->json(['erro' => 'Nao exisite esta prova'], 404);
        }

        if($request->method() === 'PATCH'){

            $regrasDinamicas = array();
            foreach ($prova->rules() as $input => $regras) {
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regras;
                }
            }
            $request->validate($regrasDinamicas);
        }else {
            $request->validate($prova->rules());
        }

        $prova->fill($request->all());
        $prova->save();
        return response()->json($prova, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\prova  $prova = Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prova = $this->prova->find($id);
        if($prova === null){
            return response()->json(['erro' => 'Nao exisite este prova'], 404);
        }

        $prova->delete();
        return response()->json(['msg' => 'prova foi deletado!'], 200);
    }
}
