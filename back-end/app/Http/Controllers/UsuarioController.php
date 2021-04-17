<?php

namespace App\Http\Controllers;

use App\Http\Requests\Usuarios\UsuarioCreateRequest;
use App\Models\Usuario;
use App\Rules\Telefone;
use App\Traits\ClanerStrings;
use Illuminate\Support\Facades\Hash;
use Exception;

class UsuarioController extends Controller
{
    use ClanerStrings;

    private $tableUsuario, $tableTelefone;

    public function __construct()
    {
        $this->tableUsuario = new Usuario();
        $this->tableTelefone = new Telefone();
    }
    
    public function store(UsuarioCreateRequest $request)
    {
        $infoUser = $request->only(['id_lojas', 'nome', 'email', 'senha']);

        $infoUser['senha'] = Hash::make($infoUser['senha'], ['rounds' => 12]);

        try {

            //$idUser = $this->tableUsuario->setUsuario($infoUser)->id_usuarios;

        } catch(Exception $e) {
            dd($e->getMessage());
            return response()->json(['status' => false, 'message' => 'Não foi possível criar registro do usuário'], 500);

        }

        $this->setTelefoneUsuario($request->telefones);

    }

    public function setTelefoneUsuario($telefones)
    {
        $telefonesOnlyNumbers = $this->onlyNumbersInAllItens($telefones);
    }

}
