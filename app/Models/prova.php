<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prova extends Model
{
    use HasFactory;

    protected $fillable = [
        'nivelamento_id',
        'nome',
        'qtd_questao',
        'media_apr',
        'mensagem_apr',
        'mensagem_rep'
    ];

    public function rules(){
        return [
            'nivelamento_id' => 'required|exists:nivelamentos,id',
            'nome' =>'required|unique:provas,nome,'.$this->id.'|max:50',
            'qtd_questao' => 'required',
            'media_apr' => 'required',
            'mensagem_apr' => 'required|max:255',
            'mensagem_rep' => 'required|max:255'
        ];
    }

    public function nivelamentos(){
        return $this->belongsTo('App\Models\nivelamento');
    }

    public function questoes(){
        return $this->hasMany('App\Models\questao');
    }

}
