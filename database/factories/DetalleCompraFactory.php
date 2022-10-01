<?php

namespace Database\Factories;

use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetalleCompra>
 */
class DetalleCompraFactory extends Factory
{
    protected $model = DetalleCompra::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $ventas = Venta::select('id')->get();
        $productos = Producto::select('id')->get();
        return [
            'compra_id' => $this->faker->randomElement($ventas)->id,
            'producto_id' => $this->faker->randomElement($productos)->id,
            'cantidad' => fake()->randomFloat(2, 0, 100),
            'valor' => fake()->randomFloat(2, 0, 100),
        ];
    }
}
