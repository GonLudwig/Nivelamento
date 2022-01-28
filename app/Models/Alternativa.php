<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternativa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'questao_id',
        'alternativa_correto',
        'usuario_criador',
        'usuario_atualização'
    ];
    
    public function rules(){
        return [
            'nome' => 'required|max:500',
            'questao_id' => 'required|exists:questoes,id',
            'alternativa_correto' => 'required',
            'usuario_criador' => 'required|max:255',
            'usuario_atualização' => 'required|max:255'
        ];
    }

    public function questao(){
        return $this->belongsTo('App\Models\Questao');
    }
}
