<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoAlternativa extends Model
{
    use HasFactory;

    protected $fillable = [
        'questao_id',
        'alternativa_id'
    ];

    public function rules(){
        return [
            'questao_id' => 'required|exists:questoes,id',
            'alternativa_id' => 'required|exists:alternativas,id'
        ];
    }

    public function questoes(){
        return $this->hasMany('App\Models\Questao');
    }

    public function alternativas(){
        return $this->hasMany('App\Models\Alternativa');
    }
}
