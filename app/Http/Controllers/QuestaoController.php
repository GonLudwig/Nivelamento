<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorequestaoRequest;
use App\Http\Requests\UpdatequestaoRequest;
use App\Models\questao;

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
        $filtro = array();

        if($request->has('atributos')){
            $atributos = $request->atributos;
            $filtro = $this->questao->selectRaw($atributos)->with('prova')->with('alternativas')->get();
        }else{
            $filtro = $this->questao->with('prova')->with('alternativas')->get();
        }

        return response()->json($filtro, 200);
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
        $questao = $this->questao->create($request->all());

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
        $questao = $this->questao->with('prova')->with('alternativas')->find($id);
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
