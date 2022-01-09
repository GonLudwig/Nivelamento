<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alternativa extends Model
{
    use HasFactory;

    protected $fillable = [
        'questao_id',
        'alternativa'
    ];
    
    public function rules(){
        return [
            'questao_id' => 'required|exists:questoes,id',
            'alternativa' => 'required'
        ];
    }

    public function questao(){
        return $this->belongsTo('App\Models\questao');
    }
}
