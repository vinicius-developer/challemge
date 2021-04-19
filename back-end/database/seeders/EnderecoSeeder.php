<?php

namespace Database\Seeders;

use App\Models\EnderecoLoja;
use Illuminate\Database\Seeder;

class EnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EnderecoLoja::create([
            'id_lojas' => 1,
            'cep' => '04429-000',
            'logradouro' => 'Dias de Almeida',
            'UF' => 'SP',
            'Bairro' => "Jardim Miriam",
            'cidade' => "São Paulo",
            'numero' => 12333,
            'complemento' => ''
        ]);

        EnderecoLoja::create([
            'id_lojas' => 2,
            'cep' => '04429-000',
            'logradouro' => 'Dias de Almeida',
            'UF' => "SP",
            'Bairro' => "Jardim Miriam",
            'cidade' => "São Paulo",
            'numero' => 12333,
            'complemento' => ''
        ]);

        EnderecoLoja::create([
            'id_lojas' => 3,
            'cep' => '04429-000',
            'logradouro' => 'Dias de Almeida',
            'UF' => "SP",
            'bairro' => "Jardim Miriam",
            'cidade' => "São Paulo",
            'numero' => 12333,
            'complemento' => ''
        ]);

        EnderecoLoja::create([
            'id_lojas' => 4,
            'cep' => '04429-000',
            'logradouro' => 'Dias de Almeida',
            'UF' => "SP",
            'Bairro' => "Jardim Miriam",
            'cidade' => "São Paulo",
            'numero' => 12333,
            'complemento' => ''
        ]);

        EnderecoLoja::create([
            'id_lojas' => 5,
            'cep' => '04429-000',
            'logradouro' => 'Dias de Almeida',
            'UF' => "SP",
            'Bairro' => "Jardim Miriam",
            'cidade' => "São Paulo",
            'numero' => 12333,
            'complemento' => ''
        ]);

        EnderecoLoja::create([
            'id_lojas' => 6,
            'cep' => '04429-000',
            'logradouro' => 'Dias de Almeida',
            'UF' => "SP",
            'Bairro' => "Jardim Miriam",
            'cidade' => "São Paulo",
            'numero' => 12333,
            'complemento' => ''
        ]);

        EnderecoLoja::create([
            'id_lojas' => 7,
            'cep' => '04429-000',
            'logradouro' => 'Dias de Almeida',
            'UF' => "SP",
            'Bairro' => "Jardim Miriam",
            'cidade' => "São Paulo",
            'numero' => 12333,
            'complemento' => ''
        ]);
    }
}
