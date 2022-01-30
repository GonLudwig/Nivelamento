<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorequestaoRequest;
use App\Http\Requests\UpdatequestaoRequest;
use App\Models\Questao;
use App\Repositories\QuestaoRepository;

class QuestaoController extends Controller
{
    public function __construct(questao $questao)
    {
        $this->questao = $questao;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\StorequestaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(StorequestaoRequest $request)
    {
        $questaoRepository = new QuestaoRepository($this->questao);
        $atributos = '';

        if($request->has('atributos_componente')){
            $atributosQuestao = 'componente:id,'.$request->atributos_componente;
            $questaoRepository->selectAtributosRelacionados($atributosQuestao);
            $atributos = 'componente_id,';
        }else{
            $questaoRepository->selectAtributosRelacionados('componente');
        }

        if($request->has('atributos_alternativas')){
            $atributosAlternativas = 'alternativas:id,'.$request->atributos_alternativas;
            $questaoRepository->selectAtributosRelacionados($atributosAlternativas);
        }else{
            $questaoRepository->selectAtributosRelacionados('alternativas');
        }

        if($request->has('filtros')){
            $questaoRepository->filtros($request->filtros);
        }

        if($request->has('atributos')){
            $atributos .= $request->atributos;
            $questaoRepository->selectAtributos($atributos);
        }

        return response()->json($questaoRepository->getResultado(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorequestaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorequestaoRequest $request)
    {
        $request->validate($this->questao->rules());
        $questao = $this->questao->create([
            'enunciado' => $request->enunciado,
            'componente_id' => $request->componente_id,
            'situacao' => $request->situacao,
            'usuario_criador' => $request->usuario_criador,
            'usuario_atualizacao' => $request->usuario_atualizacao
        ]);

        return response()->json($questao, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\questao  $questao = Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $questao = $this->questao->with('componente')->with('alternativas')->find($id);
        if($questao === null){
            return response()->json(['erro' => 'Nao exisite esta questao'], 404);
        }
        return response()->json($questao, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatequestaoRequest  $request
     * @param  \App\Models\questao  $questao = Integer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatequestaoRequest $request, $id)
    {
        $questao = $this->questao->find($id);

        if($questao === null){
            return response()->json(['erro' => 'Nao exisite esta questão'], 404);
        }

        if($request->method() === 'PATCH'){

            $regrasDinamicas = array();
            foreach ($questao->rules() as $input => $regras) {
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regras;
                }
            }
            $request->validate($regrasDinamicas);
        }else {
            $request->validate($questao->rules());
        }

        $questao->fill($request->all());
        $questao->save();
        return response()->json($questao, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\questao  $questao
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $questao = $this->questao->find($id);
        if($questao === null){
            return response()->json(['erro' => 'Nao exisite esta questao'], 404);
        }

        $questao->delete();
        return response()->json(['msg' => 'Questao foi deletada!'], 200);
    }
}
