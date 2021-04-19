<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lojas\LojaCreateRequest;
use App\Traits\ResponseMessage;
use App\Models\EnderecoLoja;
use App\Models\Loja;
use Exception;

class LojaController extends Controller
{
    use ResponseMessage;

    private $tableLojas, $tableEnderecos;

    public function __construct()
    {
        $this->tableLojas = new Loja();
        $this->tableEnderecos = new EnderecoLoja();
    }

    public function store(LojaCreateRequest $request)
    {
        $infoLoja = $request->only(['nome', 'cnpj']);

        try {

            $idLoja = $this->tableLojas->setLoja($infoLoja)->id_lojas;

        } catch(Exception $e) {

            return $this->formateMessageError('Não foi possivel criar a loja', 500);            
        }

        $response = $this->setEnderecoLoja($request->endereco, $idLoja);

        return $response;
        
    }

    public function list()
    {

        try {

            $lojas = $this->tableLojas->getLojas()->get();

        } catch(Exception $e) {
            return $this->formateMessageError('Error na listagem de dados', 500);

        }

        return $this->formateMessageSuccess($lojas);

    }

    private function setEnderecoLoja($endereco, $idLoja) 
    {
        $infoEndereco = $endereco;

        $infoEndereco['id_lojas'] = $idLoja;

        try {

            $this->tableEnderecos->setEndereco($infoEndereco);

        } catch(Exception $e) {

            return $this->formateMessageError('Não foi possivel registrar o endereco', 500);            

        }


        return $this->formateMessageSuccess('Registro criado com sucesso');
    }
}
