<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivelamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'situacao'
    ];

    public function rules(){
        return [
            'nome' =>'required|unique:nivelamentos,nome,'.$this->id.'|max:50',
            'situacao' => 'required'
        ];
    }

    public function nivelamentos_provas(){
        return $this->hasMany('App\Models\NivelamentosProva');
    }
}