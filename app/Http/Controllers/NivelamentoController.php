<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorenivelamentoRequest;
use App\Http\Requests\UpdatenivelamentoRequest;
use App\Models\Nivelamento;
use App\Repositories\NivelamentoRepository;

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
        $nivelamentoRepository = new NivelamentoRepository($this->nivelamento);
        $atributos = '';

        // if($request->has('atributos_nivelamentos_provas')){
        //     $atributosProva = 'nivelamentos_provas:id,nivelamento_id,'.$request->atributos_prova;
        //     $nivelamentoRepository->selectAtributosRelacionados($atributosProva);
        // }else{
        //     $nivelamentoRepository->selectAtributosRelacionados('nivelamentos_provas');
        // }

        if($request->has('filtros')){
            $nivelamentoRepository->filtros($request->filtros);
        }

        if($request->has('atributos')){
            $atributos .= $request->atributos;
            $nivelamentoRepository->selectAtributos($atributos);
        }

        return response()->json($nivelamentoRepository->getResultado(), 200);
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
        $nivelamento = $this->nivelamento->create([
            'nome' => $request->nome,
            'situacao' => $request->situacao,
            'usuario_criador' => $request->usuario_criador,
            'usuario_atualizacao' =>$request->usuario_atualizacao
        ]);

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
        $nivelamento = $this->nivelamento->with('nivelamentos_provas')->find($id);
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
            return response()->json(['erro' => 'Nao exisite este nivelamento'], 404);
        }

        $nivelamento->delete();
        return response()->json(['msg' => 'nivelamento foi deletado!'], 200);
    }
}
