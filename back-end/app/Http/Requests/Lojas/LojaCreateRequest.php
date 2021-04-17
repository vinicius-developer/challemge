<?php

namespace App\Http\Requests\Lojas;

use App\Rules\Cep;
use App\Rules\Cnpj;
use App\Rules\OnlyNumbers;
use App\Rules\Uppercase;
use Illuminate\Foundation\Http\FormRequest;

class LojaCreateRequest extends FormRequest
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
            "nome" => ['max:100', 'required'],
            "cnpj" => [new Cnpj, 'required'],
            "endereco" => ['required'],
            "endereco.logradouro" => ['required', 'max:80'],
            "endereco.numero" => ['required', new OnlyNumbers()],
            "endereco.cep" => ['required', new Cep()],
            "endereco.bairro" => ['required', 'max:80'],
            "endereco.cidade" => ['required', 'max:80'],
            "endereco.UF" => ['required', 'max:2', 'min:2', new Uppercase]  
        ];
    }

    public function messages()
    {
        return [
            'nome.max:100' => 'Este nome é muito grande,
            por favor entrar em contato', 
            'nome.required' => 'É necessário inserir um nome',
            'cnpj.cnpj' => 'CNPJ inválido',
            'cnpj.required' => "É necessário informar um CNPJ",
            'logradouro.required' => 'É necessário informar um logradouro',
            'logradouro.max' => "logradouro muito grande pro favor entrar em contato",
            'numero.required' => 'É necessario informar um numero', 'numero.regex' => 'não possui formato válido',
            'cep.required' => 'É necessário informar um CEP',
            'cep.formato_cep' => 'não possuí formato valído',
            'bairro.required' => 'É necessário informar um bairro',
            'bairro.max' => 'nome do bairro muito grande por favor entrar em contado', 
            'cidade.required' => 'É necessério informar uma cidade',
            'cidade.max:80' => 'nome da cidade muito grande por favor entrar em contado',
            'UF.required' => 'É necessário informar a UF', 
            'UF.max:2' => "UF inválida", 
            'UF.min:2' => "UF inválida",
        ];
    }
}
