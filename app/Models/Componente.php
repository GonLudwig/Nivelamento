<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'nivel_id',
        'situacao',
        'usuario_criador',
        'usuario_atualizacao'
    ];

    public function rules(){
        return [
            'nome' => 'required',
            'nivel_id' => 'required|exists:niveis_ensinos,id',
            'situacao' => 'required',
            'usuario_criador' => 'required|max:255',
            'usuario_atualizacao' => 'required|max:255'
        ];  
    }

    public function provas_componentes(){
        return $this->belongsToMany(
            'App\Models\Prova',
            'provas_componentes',
            'componente_id',
            'prova_id'
        )->withPivot('quantidade_questao');
    }

    public function nivel(){
        return $this->belongsTo('App\Models\NivelEnsino');
    }
}
