<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NivelamentosProva extends Model
{
    use HasFactory;

    protected $fillable = [
        'nivelamento_id',
        'prova_id',
        'usuario_criador',
        'usuario_atualizacao'
    ];

    public function rules(){
        return [
            'nivelamento_id' => 'required|exists:nivelamentos,id',
            'prova_id' => 'required|exists:provas,id',
            'usuario_criador' => 'required',
            'usuario_atualizacao' => 'required'
        ];
    }

    public function nivelamentos(){
        return $this->belongsTo('App\Models\Nivelamento', 'nivelamento_id', 'id');
    }

    public function provas(){
        return $this->belongsTo('App\Models\Prova', 'prova_id', 'id');
    }
}
