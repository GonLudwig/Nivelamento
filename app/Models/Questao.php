<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questao extends Model
{
    use HasFactory;
    protected $table = 'questoes';

    protected $fillable = [
        'enunciado',
        'componente_id',
        'situacao',
        'usuario_criador',
        'usuario_atualização'
    ];

    public function rules(){
        return [
            'enunciado' => 'required',
            'componente_id' => 'required|exists:componentes,id',
            'situacao' => 'required',
            'usuario_criador' => 'required|max:255',
            'usuario_atualização' => 'required|max:255'
        ];
    }

    public function componente(){
        return $this->belongsTo('App\Models\Componente');
    }

    public function alternativas(){
        return $this->hasMany('App\Models\Alternativa');
    }
}
