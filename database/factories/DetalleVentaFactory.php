<?php

namespace Database\Factories;

use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetalleVenta>
 */
class DetalleVentaFactory extends Factory
{
    protected $model = DetalleVenta::class;

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
            'venta_id' => $this->faker->randomElement($ventas)->id,
            'producto_id' => $this->faker->randomElement($productos)->id,
            'cantidad' => fake()->randomFloat(2, 0, 100),
            'valor' => fake()->randomFloat(2, 0, 100),
            'tipo_venta' => fake()->randomElement(['Detal', 'Por mayor']),
            'descuento' => fake()->randomFloat(2, 0, 100),
        ];
    }
}
