<?php

namespace App\Http\Controllers;

use App\Http\Requests\Usuarios\UsuarioAuthenticateRequest;
use App\Http\Requests\Usuarios\UsuarioCreateRequest;
use App\Http\Requests\Usuarios\AddLojaRequest;
use App\Traits\AuthenticateItens;
use App\Traits\ResponseMessage;
use App\Models\TelefoneUsuario;
use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    use AuthenticateItens, ResponseMessage;

    private $tableUsuario, $tableTelefone;

    public function __construct()
    {
        $this->tableUsuario = new Usuario();
        $this->tableTelefone = new TelefoneUsuario();
    }
    
    public function store(UsuarioCreateRequest $request)
    {
        $infoUser = $request->only(['id_lojas', 'nome', 'email', 'senha']);

        $infoUser['senha'] = $this->generatePassword($infoUser['senha']);

        try {

            $idUser = $this->tableUsuario->setUsuario($infoUser)->id_usuarios;

        } catch(Exception $e) {

            return $this->formateMessageError($e->getMessage(), 500);

        }

        $response = $this->setTelefoneUsuario($request->telefones, $idUser);

        return $response;

    }

    public function authenticate(UsuarioAuthenticateRequest $request) 
    {

        $data = $this->tableUsuario->getUsuarioComEmail($request->email);
        
        $usersExists = $this->checkUsersExists($request, $data);

        if($usersExists) {

            $id = $data->first()->id_usuarios;
            
            $aud = $request->url();

            $token = $this->generateToken($id, $aud);

        } else {

            return $this->formateMessageError('Email ou senha estão incorretos', 422);

        }

        return response()->json([
            'status' => true,
            'message' => [
               'token' => $token,
               'exp' => '5 horas',
            ]
        ]);

    }

    public function list($idLoja = null)
    {

        if($idLoja){

            $usuarios = $this->tableUsuario->getUsuariosLojaEspecifica($idLoja)->get();
                
        } else {

            $usuarios = $this->tableUsuario->getUsuarios()->get();

        }

        $usuariosComTelefone = $this->tableTelefone->getAllTelefonesUsuariosEspecifico($usuarios);

        return $this->formateMessageSuccess($usuariosComTelefone);

    }   

    public function change_loja(AddLojaRequest $request)
    {

        try {

            $this->tableUsuario->addLojaUsuario($request->id_lojas, $request->id_usuarios);

        } catch(Exception $e) {

            return $this->formateMessageError('Não foi possível concluir a ação', 500);

        }

        return $this->formateMessageSuccess('Usuario associado a loja com sucesso');

    }

    public function check_access(Request $request) {

        $token = $request->bearerToken();

        
        try {
            $this->checkToken($token);

        } catch(Exception $e) {

            return $e->getMessage();
            return response()->json(['status' => false], 401);

        }

    }

    public function find_user($id) 
    {
        try {

            $user = $this->tableUsuario->getUsuarioComId($id)->first();

            $user->telefones = $this->tableTelefone
                ->getAllTelefonesUsuarioEspecifico($user)
                ->get()
                ->pluck('telefone');

        } catch(Exception $e) {
            
            return $this->formateMessageError("Usuario não encontrado", 500);

        }


        return $this->formateMessageSuccess($user);

    }

    private function checkUsersExists(UsuarioAuthenticateRequest $request, $data) 
    {

        if($data->exists()) {

            $user = $data->first();
            return $this->checkPassword($request->senha, $user->senha);

        } else {

            return false;

        }
    }

    private function setTelefoneUsuario($telefones, $idUser)
    {

        $arrComRegistrosTelefones =  $this->buildTelefone($telefones, $idUser);

        try {

            $this->tableTelefone->setTelefone($arrComRegistrosTelefones);

        }catch (Exception $e) {

            return $this->formateMessageError('Não foi possivel registrar os telefones', 500);

        }

        return $this->formateMessageSuccess("Cadastro efetuado com sucesso");

    }

    private function buildTelefone($telefones, $idUser)
    {
        $result = [];

        foreach($telefones as $telefone) 
        {
            $arr = [
                'telefone' => $telefone,
                'id_usuarios' => $idUser
            ];

            array_push($result, $arr);
        }

        return $result;
    }

}
