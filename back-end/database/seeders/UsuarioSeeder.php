<?php

namespace Database\Seeders;

use App\Models\Loja;
use App\Models\TelefoneUsuario;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id_lojas = Loja::create([
            'nome' => "Loja de teste",
            'cnpj' => "59.896.084/0001-36"
        ])->id_lojas;

        $id = Usuario::create([
            'nome' => 'ADMIN',
            'email' => 'admin@gmail.com',
            'id_lojas' => $id_lojas,
            'senha' => '$2y$12$f9SusqXiYaGvJawTYBIvFuU4fosHP4OIexh4iox2nNLiqxbW56MMC',
        ])->id_usuarios;

        TelefoneUsuario::create([
            'id_usuarios' => $id,
            'telefone' => '(11) 99999-9999'
        ]);
    }
}
