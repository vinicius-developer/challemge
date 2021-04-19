<?php

namespace App\Http\Controllers;

use App\Http\Requests\ViaCep\viaCepRequest;
use App\Traits\ResponseMessage;
use Illuminate\Support\Facades\Http;

class ViaCepController extends Controller
{

    use ResponseMessage;

    public function get_endereco($cep) 
    {  
        $response = Http::get("https://viacep.com.br/ws/$cep/json")->json();


        if($response && !array_key_exists('erro', $response)) {
            $endereco = array_slice($response, 0, 6);
            return $this->formateMessageSuccess($endereco);
        } else {
            return $this->formateMessageError("Não foi possível encontrar o endereço", 422);
        }
        
    }
}
