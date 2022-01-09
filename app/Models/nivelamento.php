<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nivelamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome'
    ];

    public function rules(){
        return [
            'nome' =>'required|unique:nivelamentos,nome,'.$this->id.'|max:50'
        ];
    }

    public function provas(){
        return $this->hasMany('App\Models\prova');
    }
}
