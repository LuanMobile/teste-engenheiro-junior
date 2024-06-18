<?php

namespace Database\Factories;

use App\Enum\DiscountEnum;
use App\Enum\StatusOrderEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedido>
 */
class PedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->randomElement([1, 2]),
            'status' => fake()->randomElement(array_column(StatusOrderEnum::cases(), "value")),
            'dt_pedido' => now(),
            'desconto' => fake()->randomElement(array_column(DiscountEnum::cases(), "value")),
            'valor_total' => fake()->randomFloat(2, 100, 500),
        ];
    }
}
