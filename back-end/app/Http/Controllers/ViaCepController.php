<?php

namespace App\Http\Controllers;

use App\Http\Requests\ViaCep\viaCepRequest;
use Illuminate\Support\Facades\Http;

class ViaCepController extends Controller
{

    public function get_endereco(viaCepRequest $request) 
    {  
        $response = Http::get("https://viacep.com.br/ws/$request->cep/json")->json();

        $endereco = array_slice($response, 0, 6);
        
        if(!array_key_exists('erro', $endereco)) {
            return response()->json([
                "status" => true,
                "message" => $endereco
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Não foi possível encontrar o endereço"
            ], 422);
        }
        
    }
}
