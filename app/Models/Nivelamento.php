<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivelamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'situacao',
        'usuario_criador',
        'usuario_atualizacao'
    ];

    public function rules(){
        return [
            'nome' =>'required|unique:nivelamentos,nome,'.$this->id.'|max:50',
            'situacao' => 'required',
            'usuario_criador' => 'required|max:255',
            'usuario_atualizacao' => 'required|max:255'
        ];
    }

    public function nivelamentos_provas(){
        return $this->belongsToMany(
            'App\Models\Prova',
            'nivelamentos_provas',
            'nivelamento_id',
            'prova_id');
    }
}