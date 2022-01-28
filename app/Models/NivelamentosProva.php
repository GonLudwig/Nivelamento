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
        'usuario_atualização'
    ];

    public function roles(){
        return [
            'nivelamento_id' => 'required|exists:nivelamentos,id',
            'prova_id' => 'required|exists:provas,id',
            'usuario_criador' => 'required',
            'usuario_atualização' => 'required'
        ];
    }

    public function nivelamentos(){
        return $this->hasMany('App\Models\Nivelamento');
    }

    public function provas(){
        return $this->hasMany('App\Models\Prova');
    }
}
