<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Venta;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venta>
 */
class VentaFactory extends Factory
{
    protected $model = Venta::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = User::select('id')->get();
        $date = date('Y-m-d', strtotime('now +' . $this->faker->numberBetween(1, 50) . ' days'));
        return [
            'user_id' => $this->faker->randomElement($users)->id,
            'valor_total' => fake()->randomFloat(2, 0, 50000),
            'fecha' => $date,
            'forma_pago' => fake()->randomElement(['Efectivo', 'Transacción', 'Credito']),
            'forma_pago_dos' => fake()->randomElement(['Efectivo', 'Transacción', 'Credito']),
            'valor_pago_dos' => fake()->randomFloat(2, 0, 50000),
            'observaciones' => fake()->word(),
        ];
    }
}
