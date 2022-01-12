<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository {
    
    public function __construct($model){
        $this->model = $model;
    }

    public function selectAtributosRelacionados($atributos){
        $this->model = $this->model->with($atributos);
    }

    public function filtros($filtros){
        $filtros = explode(';', $filtros);
        foreach ($filtros as $key => $condicao) {
            $filtro = explode(':', $condicao);
            $this->model = $this->model->where($filtro[0], $filtro[1], $filtro[2]);
        }
    }

    public function selectAtributos($atributos){
        $this->model = $this->model->selectRaw($atributos);
    }

    public function getResultado(){
        return $this->model->get();
    }
}