<?php

namespace App\Http\Requests\Usuarios;

use Illuminate\Foundation\Http\FormRequest;

class AddLojaRequest extends FormRequest
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
            'id_lojas' => ['required', 'exists:lojas'],
            'id_usuarios' => ['required', 'exists:usuarios']
        ];
    }

    public function messages()
    {
        return [
            'id_lojas.required' => 'É necessário infomar uma loja',
            'id_lojas.exists' => 'Esta loja não é valida por favor entre em contato',
            'id_usuarios.required' => 'É necessário informar uma usuário',
            'id_usuarios.exists' => 'Este usuário não é valído'
        ];
    }
}
