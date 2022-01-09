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
        $modelo = array();

        if($request->has('atributos')){
            $atributos = $request->atributos;
            $modelo = $this->prova->selectRaw($atributos)->with('nivelamento')->with('questoes')->get();
        }else{
            $modelo = $this->prova->with('nivelamento')->with('questoes')->get();
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
