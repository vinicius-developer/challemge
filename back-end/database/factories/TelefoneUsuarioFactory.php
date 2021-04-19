<?php

namespace Database\Factories;

use App\Models\TelefoneUsuario;
use Dotenv\Util\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TelefoneUsuarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TelefoneUsuario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_usuarios' => rand(1,5),
            'telefone' => '(11) ' . rand(20000,99999) . '-' . rand(2000, 9999)
        ];
    }
}
