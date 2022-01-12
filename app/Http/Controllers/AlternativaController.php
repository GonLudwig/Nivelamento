<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorealternativaRequest;
use App\Http\Requests\UpdatealternativaRequest;
use App\Models\Alternativa;
use App\Repositories\AlternativaRepository;

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
    public function index(StorealternativaRequest $request)
    {
        $alternativaRepository = new AlternativaRepository($this->alternativa);
        $atributos = '';

        if($request->has('atributos_questao')){
            $atributosQuestoes = 'questao:id,'.$request->atributos_questao;
            $alternativaRepository->selectAtributosRelacionados($atributosQuestoes);
            $atributos = 'questao_id,';
        }else{
            $alternativaRepository->selectAtributosRelacionados('questao');
        }

        if($request->has('filtros')){
            $alternativaRepository->filtros($request->filtros);
        }

        if($request->has('atributos')){
            $atributos .= $request->atributos;
            $alternativaRepository->selectAtributos($atributos);
        }

        return response()->json($alternativaRepository->getResultado(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorealternativaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorealternativaRequest $request)
    {
        $request->validate($this->alternativa->rules());
        $alternativa = $this->alternativa->create([
            'questao_id' => $request->questao_id,
            'alternativa' => $request->alternativa
        ]);

        return response()->json($alternativa, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\alternativa  $alternativa = Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alternativa = $this->alternativa->with('prova')->with('alternativas')->find($id);
        if($alternativa === null){
            return response()->json(['erro' => 'Nao exisite esta alternativa'], 404);
        }
        return response()->json($alternativa, 200);
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
        $alternativa = $this->alternativa->find($id);

        if($alternativa === null){
            return response()->json(['erro' => 'Nao exisite esta alternativa'], 404);
        }

        if($request->method() === 'PATCH'){

            $regrasDinamicas = array();
            foreach ($alternativa->rules() as $input => $regras) {
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regras;
                }
            }
            $request->validate($regrasDinamicas);
        }else {
            $request->validate($alternativa->rules());
        }

        $alternativa->fill($request->all());
        $alternativa->save();
        return response()->json($alternativa, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\alternativa  $alternativa = Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alternativa = $this->alternativa->find($id);
        if($alternativa === null){
            return response()->json(['erro' => 'Nao exisite esta alternativa'], 404);
        }

        $alternativa->delete();
        return response()->json(['msg' => 'Alternativa foi deletada!'], 200);
    }
}
