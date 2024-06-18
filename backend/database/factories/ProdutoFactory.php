<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake('pt_BR')->word(),
            'description' => fake('pt_BR')->paragraph(1),
            'price' => fake('pt_BR')->randomFloat(2, 10, 500),
            'category' => fake('pt_BR')->randomElement(['Eletronicos', 'Roupas', 'Alimentos', 'Esportes']),
        ];
    }
}
