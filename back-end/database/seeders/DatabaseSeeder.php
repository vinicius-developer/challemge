<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            UsuarioSeeder::class
        ]);

        \App\Models\Loja::factory(7)->create();

        $this->call([
            EnderecoSeeder::class
        ]);

        \App\Models\Usuario::factory(5)->create();
        \App\Models\TelefoneUsuario::factory(10)->create();
    }
}
