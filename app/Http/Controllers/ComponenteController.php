<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComponenteRequest;
use App\Http\Requests\UpdateComponenteRequest;
use App\Models\Componente;
use App\Repositories\ComponenteRepository;

class ComponenteController extends Controller
{
    public function __construct(Componente $componente)
    {
        $this->componente = $componente;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\StoreComponenteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(StoreComponenteRequest $request)
    {
        $componenteRepository = new ComponenteRepository($this->componente);

        if($request->has('atributos_provas_componentes')){
            $atributosProvasComponentes = 'provas_componentes:id,'.$request->atributos_provas_componentes;
            $componenteRepository->selectAtributosRelacionados($atributosProvasComponentes);
        }else{
            $componenteRepository->selectAtributosRelacionados('provas_componentes');
        }

        if($request->has('atributos_nivel')){
            $atributosNivel = 'nivel:id,'.$request->atributos_nivel;
            $componenteRepository->selectAtributosRelacionados($atributosNivel);
        }else{
            $componenteRepository->selectAtributosRelacionados('nivel');
        }

        if($request->has('filtros')){
            $componenteRepository->filtros($request->filtros);
        }

        if($request->has('atributos')){
            $atributos = $request->atributos;
            $componenteRepository->selectAtributos($atributos);
        }

        return response()->json($componenteRepository->getResultado(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreComponenteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComponenteRequest $request)
    {
        $request->validate($this->componente->rules());
        $componente = $this->componente->create([
            'nome' => $request->nome,
            'nivel_id' => $request->nivel_id,
            'situacao' => $request->situacao,
            'usuario_criador' => $request->usuario_criador,
            'usuario_atualizacao' => $request->usuario_atualizacao
        ]);

        return response()->json($componente, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Componente  $componente - Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $componente = $this->componente->with('provas_componentes')->with('nivel')->find($id);
        if($componente === null){
            return response()->json(['erro' => 'Nao exisite esta componente'], 404);
        }
        return response()->json($componente, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateComponenteRequest  $request
     * @param  \App\Models\Componente  $componente - Integer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComponenteRequest $request, $id)
    {
        $componente = $this->componente->find($id);

        if(!$componente){
            return response()->json(['erro' => 'Nao exisite esta componente'], 404);
        }

        if($request->method() === 'PATCH'){

            $regrasDinamicas = array();
            foreach ($componente->rules() as $input => $regras) {
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regras;
                }
            }
            $request->validate($regrasDinamicas);
        }else {
            $request->validate($componente->rules());
        }

        $componente->fill($request->all());
        $componente->save();
        return response()->json($componente, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Componente  $componente - Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $componente = $this->componente->find($id);
        if(!$componente){
            return response()->json(['erro' => 'Nao exisite este componente'], 404);
        }

        $componente->delete();
        return response()->json(['msg' => 'componente foi deletado!'], 200);
    }
}
