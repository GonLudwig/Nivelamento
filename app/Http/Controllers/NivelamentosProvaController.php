<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNivelamentosProvaRequest;
use App\Http\Requests\UpdateNivelamentosProvaRequest;
use App\Models\NivelamentosProva;
use App\Repositories\NivelamentosProvaRepository;

class NivelamentosProvaController extends Controller
{
    public function __construct(NivelamentosProva $nivelamentosProva)
    {
        $this->nivelamentosProva = $nivelamentosProva;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\StoreNivelamentosProvaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(StoreNivelamentosProvaRequest $request)
    {
        $nivelamentosProvaRepository = new NivelamentosProvaRepository($this->nivelamentosProva);
        // $atributos = '';

        if($request->has('atributos_nivelamentos')){
            $atributosNivelamentos = 'nivelamentos:id,'.$request->atributos_nivelamentos;
            $nivelamentosProvaRepository->selectAtributosRelacionados($atributosNivelamentos);
            // $atributos = 'nivelamentos_id,';
        }else{
            $nivelamentosProvaRepository->selectAtributosRelacionados('nivelamentos');
        }

        if($request->has('atributos_provas')){
            $atributosProvas = 'provas:id,'.$request->atributos_provas;
            $nivelamentosProvaRepository->selectAtributosRelacionados($atributosProvas);
            // $atributos = 'provas_id,';
        }else{
            $nivelamentosProvaRepository->selectAtributosRelacionados('provas');
        }

        if($request->has('filtros')){
            $nivelamentosProvaRepository->filtros($request->filtros);
        }

        if($request->has('atributos')){
            $atributos = $request->atributos;
            $nivelamentosProvaRepository->selectAtributos($atributos);
        }

        return response()->json($nivelamentosProvaRepository->getResultado(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNivelamentosProvaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNivelamentosProvaRequest $request)
    {
        $request->validate($this->nivelamentosProva->rules());
        $nivelamentosProva = $this->nivelamentosProva->create([
            'nivelamento_id' => $request->nivelamento_id,
            'prova_id' => $request->prova_id,
            'usuario_criador' => $request->usuario_criador,
            'usuario_atualizacao' => $request->usuario_atualizacao
        ]);

        return response()->json($nivelamentosProva, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NivelamentosProva  $nivelamentosProva - Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nivelamentosProva = $this->nivelamentosProva->with('nivelamentos')->with('provas')->find($id);
        if($nivelamentosProva === null){
            return response()->json(['erro' => 'Nao exisite esta nivelamento prova'], 404);
        }
        return response()->json($nivelamentosProva, 200);
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNivelamentosProvaRequest  $request
     * @param  \App\Models\NivelamentosProva  $nivelamentosProva - Integer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNivelamentosProvaRequest $request, $id)
    {
        $nivelamentosProva = $this->nivelamentosProva->find($id);

        if($nivelamentosProva === null){
            return response()->json(['erro' => 'Nao exisite esta nivelamento prova'], 404);
        }

        if($request->method() === 'PATCH'){

            $regrasDinamicas = array();
            foreach ($nivelamentosProva->rules() as $input => $regras) {
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regras;
                }
            }
            $request->validate($regrasDinamicas);
        }else {
            $request->validate($nivelamentosProva->rules());
        }

        $nivelamentosProva->fill($request->all());
        $nivelamentosProva->save();
        return response()->json($nivelamentosProva, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NivelamentosProva  $nivelamentosProva - Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nivelamentosProva = $this->nivelamentosProva->find($id);
        if($nivelamentosProva === null){
            return response()->json(['erro' => 'Nao exisite esta nivelamento prova'], 404);
        }

        $nivelamentosProva->delete();
        return response()->json(['msg' => 'Nivelamento prova foi deletada!'], 200);
    }
}
