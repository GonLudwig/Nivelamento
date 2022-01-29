<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NivelEnsino extends Model
{
    use HasFactory;
    protected $table = 'niveis_ensinos';

    protected $fillable = [
        'nome'
    ];

    public function rules() {
        return [
            'nome' => 'required|unique:niveis_ensinos,nome,'.$this->id.'|max:255'
        ];
    }
}
