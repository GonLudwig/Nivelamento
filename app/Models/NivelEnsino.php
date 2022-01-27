<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NivelEnsino extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome'
    ];

    public function roles() {
        return [
            'nome' => 'required|unique:niveis_ensinos,nome,'.$this->id.'|max:255'
        ];
    }
}
