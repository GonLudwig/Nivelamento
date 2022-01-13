<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreprovaRequest;
use App\Http\Requests\UpdateprovaRequest;
use App\Models\Prova;
use App\Repositories\ProvaRepository;

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
        $provaRepository = new ProvaRepository($this->prova);
        $atributos = '';

        if($request->has('atributos_nivelamento')){
            $atributosNivelamento = 'nivelamento:id,'.$request->atributos_nivelamento;
            $provaRepository->selectAtributosRelacionados($atributosNivelamento);
            $atributos = 'nivelamento_id,';
        }else{
            $provaRepository->selectAtributosRelacionados('nivelamento');
        }

        if($request->has('atributos_questao')){
            $atributosQuestoes = 'questoes:id,'.$request->atributos_questoes;
            $provaRepository->selectAtributosRelacionados($atributosQuestoes);
        }else{
            $provaRepository->selectAtributosRelacionados('questoes');
        }

        if($request->has('filtros')){
            $provaRepository->filtros($request->filtros);
        }

        if($request->has('atributos')){
            $atributos .= $request->atributos;
            $provaRepository->selectAtributos($atributos);
        }

        return response()->json($provaRepository->getResultado(), 200);
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
        $prova = $this->prova->create([
            'nivelamento_id' => $request->nivelamento_id,
            'nome' => $request->nome,
            'qtd_questao' => $request->qtd_questao,
            'media_apr' => $request->media_apr,
            'mensagem_apr' => $request->mensagem_apr,
            'mensagem_rep' => $request->mensagem_rep
        ]);

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

        if(!$prova){
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
        if(!$prova){
            return response()->json(['erro' => 'Nao exisite este prova'], 404);
        }

        $prova->delete();
        return response()->json(['msg' => 'prova foi deletado!'], 200);
    }
}
