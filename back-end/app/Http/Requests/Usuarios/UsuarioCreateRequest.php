<?php

namespace App\Http\Requests\Usuarios;

use App\Rules\OnlyNumbers;
use App\Rules\Password;
use App\Rules\Telefone;
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
            'id_lojas' => ['required', 'exists:lojas', new OnlyNumbers()],
            'nome' => ["required", "max:100"] ,
            'email' => ["required","max:100", "email:rfc,dns", 'unique:usuarios'] ,
            'senha' => [new Password, 'required', 'confirmed'] ,
            'telefones' => ["required"],
            'telefones.*' => ["required", new Telefone() ]
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
            'id_lojas.required' => "É necessário informa a loja",
            'id_lojas.exists' => "Loja não existe",
            "nome.required" => "É necessario informar um nome",
            "nome.max" => "Este nome é muito grande, pro favor utilizar abreviações",
            "email.required" => "É necessario informar um e-mail",
            "email.max" => "Esta e-mail é muito grande, por favor utilizar,
            se não for possísvel entre em contado",
            "email.email" => "Esse e-mail não é valido",
            "email.unique" => "Esse e-mail já foi cadastrado",
            "senha.required" => "É necessário informar uma senha",
            "senha.confirmed" => "As duas senha precisam ser iguais",
            "telefones.required" => "É necessario informar o telefone",
            "telefones.*.required" => "É necessario informar o telefone"
        ];
    }
}
