<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prova extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'media_apr',
        'situacao',
        'mensagem_apr',
        'mensagem_rep',
        'usuario_criador',
        'usuario_atualizacao'
    ];

    public function rules(){
        return [
            'nome' =>'required|unique:provas,nome,'.$this->id.'|max:50',
            'media_apr' => 'required',
            'situacao' => 'required',
            'mensagem_apr' => 'required|max:255',
            'mensagem_rep' => 'required|max:255',
            'usuario_criador' => 'required|max:255',
            'usuario_atualizacao' => 'required|max:255'
        ];
    }

    public function nivelamentos_provas(){
        return $this->belongsToMany(
            'App\Models\Nivelamento',
            'nivelamentos_provas',
            'prova_id',
            'nivelamento_id'
        );
    }

    public function provas_componentes(){
        return $this->belongsToMany(
            'App\Models\Componente',
            'provas_componentes',
            'prova_id',
            'componente_id'
        )->withPivot('quantidade_questao');
    }
}
