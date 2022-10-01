<?php

namespace Database\Factories;

use App\Models\Compra;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Compra>
 */
class CompraFactory extends Factory
{
    protected $model = Compra::class;

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
            'observaciones' => fake()->word(),
        ];
    }
}
