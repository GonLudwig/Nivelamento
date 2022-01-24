<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoQuestao extends Model
{
    use HasFactory;

    protected $fillable = [
        'prova_id',
        'questao_id'
    ];

    public function rules(){
        return [
            'prova_id' => 'required|exists:provas,id',
            'questao_id' => 'required|exists:questoes,id'
        ];
    }

    public function provas(){
        return $this->hasMany('App\Models\Prova');
    }

    public function questoes(){
        return $this->hasMany('App\Models\Questao');
    }
}
