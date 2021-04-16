<?php

namespace App\Http\Requests\Usuarios;

use App\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UsuarioCreateRequest extends FormRequest
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
            'id_lojas' => ["required", "exists:lojas", "regex:/[0-9]/" ] ,
            'nome' => ["required", "max:100"] ,
            'email' => ["required","max:100","email:rfc,dns"] ,
            'senha' => [new Password, 'required', 'confirmed'] ,
            'telefones' => ["required"],
            'telefones.*' => ["required"]
        ];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function messages()
    {
        return [
            "id_lojas.required" => "É necessário indicar uma loja",
            "id_lojas.exists" => "Está loja não é valida",
            "id_lojas.regex" => "Tipo de dados inválido",
            "nome.required" => "É necessario informar um nome",
            "nome.max" => "Este nome é muito grande, pro favor utilizar abreviações",
            "email.required" => "É necessario informa um e-mail",
            "email.max" => "Esta e-mail é muito grande, por favor utilizar,
            se não for possísvel entre em contado",
            "email.email" => "esse e-mail não é valido",
            "senha.required" => "É necessário informar uma senha",
            "senha.password_confirmation" => "As duas senha precisam ser iguais",
            "telefone.required" => "É necessario informar o item telefone",
        ];
    }
}
