<?php

namespace App\Http\Requests\ViaCep;

use App\Rules\Cep;
use Illuminate\Foundation\Http\FormRequest;

class viaCepRequest extends FormRequest
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
            "cep" => [new Cep(), 'required']
        ];
    }

    public function messages()
    {
        return [
            "cep.required" => "É necessário enviar um CEP",
            "cep.formato_cep" => "CEP com foramto invalido"
        ];
    }
}
