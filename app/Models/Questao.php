<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questao extends Model
{
    use HasFactory;
    protected $table = 'questoes';

    protected $fillable = [
        'prova_id',
        'enunciado',
        'resposta_id'
    ];

    public function rules(){
        return [
            'prova_id' => 'required|exists:provas,id',
            'enunciado' => 'required',
            'resposta_id' => 'exists:alternativas,id'
        ];
    }

    public function prova(){
        return $this->belongsTo('App\Models\Prova');
    }

    public function alternativas(){
        return $this->hasMany('App\Models\Alternativa');
    }
}
