<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FunctionType>
 */
class FunctionTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $baseAmount = $this->faker->numberBetween(500, 2000); 

        return [
            'nameFunction'       => $this->faker->jobTitle(),
            'amount'             => $baseAmount,
            'workDay'            => 26, // Standard mensuel
            'dayAmount'          => $baseAmount / 26,
            'hourAmount'         => ($baseAmount / 26) / 8, // Basé sur 8h/jour
            'housing'            => $this->faker->randomFloat(2, 50, 150),
            'transportationCost' => $this->faker->randomFloat(2, 200, 600),
            'familialAllocation' => $this->faker->randomFloat(2, 10, 50),
            'user_id'            => 1, 
        ];
    }
}
