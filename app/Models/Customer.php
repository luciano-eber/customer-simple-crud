<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'cep',
        'uf',
        'localidade',
        'bairro',
        'logradouro',
        'complemento'
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y - H:i:s',
        'updated_at' => 'datetime:d/m/Y - H:i:s'
    ];

    protected $appends = [ 
        'diff_date' 
    ];

    public function diffDate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_at->diffForHumans(),
        );
    }
}
