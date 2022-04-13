<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\{ Cpf as CpfRule, Cep as CepRule };

class Register extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|string|min:4',
            'email' => 'required|string|email|unique:customers',
            'cpf' => [ new CpfRule, 'unique:customers' ],
            'cep' => [ new CepRule ],
            'uf' => 'required|string|min:2|max:2',
            'localidade' => 'required|string',
            'bairro' => 'required|string',
            'logradouro' => 'required|string',
            'complemento' => 'required|string',
        ];
    }
}
