<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvasComponente extends Model
{
    use HasFactory;

    protected $fillable = [
        'prova_id',
        'componente_id',
        'quantidade_questao',
        'usuario_criador',
        'usuario_atualização'
    ];

    public function roles(){
        return [
            'prova_id' => 'required|exists:provas,id',
            'componente_id' => 'required|exists:componentes,id',
            'quantidade_questao' => 'required',
            'usuario_criador' => 'required|max:255',
            'usuario_atualização' => 'required|max:255'
        ];
    }

    public function provas(){
        return $this->hasMany('App\Models\Prova');
    }

    public function componentes(){
        return $this->hasMany('App\Models\Componente');
    }
}
