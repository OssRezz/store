<?php

namespace Database\Factories;

use App\Models\Inventario;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventario>
 */
class InventarioFactory extends Factory
{
    protected $model = Inventario::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $productos = Producto::select('id')->get();
        $arrProducto = [];
        foreach ($productos as $key => $value) {
            array_push($arrProducto, $value);
        }

        return [
            'producto_id' => $this->faker->unique()->randomElement($arrProducto),
            'cantidad' => fake()->randomFloat(2, 0, 100),
        ];
    }
}
