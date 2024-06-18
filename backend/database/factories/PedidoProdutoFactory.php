<?php

namespace Database\Factories;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PedidoProduto>
 */
class PedidoProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pedido_id = Pedido::factory()->create()->id;
        $produto_id = Produto::factory()->create()->id;

        return [
            'pedido_id' => $pedido_id,
            'produto_id' => $produto_id,
            'quantidade' => fake()->randomDigitNotNull(),
            'valor' => fake()->randomFloat(2, 50, 300)
        ];
    }
}
