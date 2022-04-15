<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\{ Cpf as CpfRule, Cep as CepRule };
use Illuminate\Validation\Rule;

class Update extends FormRequest
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
            'email' => [ 
                'required', 
                'string', 
                'email', 
                Rule::unique('customers')->ignore($this->id) 
            ],
            'cpf' => [ 
                new CpfRule,  
                Rule::unique('customers')->ignore($this->id) 
            ],
            'cep' => [ 
                new CepRule 
            ],
            'uf' => 'required|string|max:2',
            'localidade' => 'required|string',
            'bairro' => 'required|string',
            'logradouro' => 'required|string',
            'complemento' => 'required|string',
        ];
    }
}
