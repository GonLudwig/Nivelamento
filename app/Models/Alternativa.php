<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternativa extends Model
{
    use HasFactory;

    protected $fillable = [
        'alternativa'
    ];
    
    public function rules(){
        return [
            'alternativa' => 'required'
        ];
    }

    public function questoes(){
        return $this->hasMany('App\Models\GrupoQuestao');
    }
}
