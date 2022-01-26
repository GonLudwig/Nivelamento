<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prova extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'qtd_questao',
        'media_apr',
        'mensagem_apr',
        'mensagem_rep'
    ];

    public function rules(){
        return [
            'nome' =>'required|unique:provas,nome,'.$this->id.'|max:50',
            'qtd_questao' => 'required',
            'media_apr' => 'required',
            'mensagem_apr' => 'required|max:255',
            'mensagem_rep' => 'required|max:255'
        ];
    }

    public function nivelamentos(){
        return $this->hasMany('App\Models\GrupoProva');
    }

}
