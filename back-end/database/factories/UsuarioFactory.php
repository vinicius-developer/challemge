<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsuarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Usuario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'senha' => '$2y$12$f9SusqXiYaGvJawTYBIvFuU4fosHP4OIexh4iox2nNLiqxbW56MMC',
            'id_lojas' => rand(1, 7),
        ];
    }
}
