<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoProva extends Model
{
    use HasFactory;

    protected $fillable = [
        'nivelamento_id',
        'prova_id'
    ];

    public function reles(){
        return [
            'nivelamento_id' => 'required|exists,nivelamentos,id',
            'prova_id' => 'required|exists,provas,id'
        ];
    }

    public function nivelamentos(){
        return $this->hasMany('App\Models\Nivelamento');
    }

    public function provas(){
        return $this->hasMany('App\Models\Prova');
    }
}
