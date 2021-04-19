<?php

namespace App\Http\Requests\Usuarios;

use App\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UsuarioAuthenticateRequest extends FormRequest
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
            'email' => ['required', 'email:rfc,dns', 'exists:usuarios', 'max:100'],
            'senha' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'É necessario preencher o campo e-mail',
            'email.email' => 'Esse email não é valido',
            'email.exists' => 'Esse e-mail não está cadastrado em nossa base de dados',
            'email.max' => 'Esse e-mail é muito longo, por favor entre em contado',
            'senha.required' => 'É necessário informar uma senha'
        ];
    }
}
