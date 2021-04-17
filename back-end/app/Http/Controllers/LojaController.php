<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lojas\LojaCreateRequest;
use App\Models\EnderecoLoja;
use App\Models\Loja;
use App\Traits\ClanerStrings;
use Exception;

class LojaController extends Controller
{
    use ClanerStrings;

    private $tableLojas, $tableEnderecos;

    public function __construct()
    {
        $this->tableLojas = new Loja();
        $this->tableEnderecos = new EnderecoLoja();
    }

    public function store(LojaCreateRequest $request)
    {
        $infoLoja = $request->only(['nome', 'cnpj']);

        $infoLoja['cnpj'] = $this->onlyNumbers($infoLoja['cnpj']);

        try {
            $idLoja = $this->tableLojas->setLoja($infoLoja)->id_lojas;
        } catch(Exception $e) {
            return response()->json(['status' => false, 'message' => 'Não foi possivel criar a loja'], 500);
        }

        $response = $this->setEnderecoLoja($request->endereco, $idLoja);

        return $response;
        
    }

    private function setEnderecoLoja($endereco, $idLoja) 
    {
        $infoEndereco = $endereco;

        $infoEndereco['cep'] = $this->onlyNumbers($infoEndereco['cep']);

        $infoEndereco['id_lojas'] = $idLoja;

        try {
            $this->tableEnderecos->setEndereco($infoEndereco);
        } catch(Exception $e) {
            return response()->json(['status' => false, 'message' => 'não foi possivel registrar o endereco'], 500);
        }

        return response()->json(['status' => true, 'message' => 'registro criado com sucesso']);
    }
}
