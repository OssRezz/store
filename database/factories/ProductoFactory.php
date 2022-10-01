<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    protected $model = Producto::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'codigo' => fake()->unique()->numerify('###'),
            'nombre' => fake()->word(),
            'precio_compra' => fake()->randomFloat(2, 0, 10000),
            'precio_venta' => fake()->randomFloat(2, 0, 10000),
            'utilidad' => fake()->randomFloat(2, 0, 1000),
            'stock' => fake()->randomFloat(2, 0, 10),
        ];
    }
}
