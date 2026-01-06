<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Brick\Money\Money;
use Brick\Math\RoundingMode;

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
        $baseAmount = $this->faker->numberBetween(2000, 6000); 
        $baseMoney = Money::of($baseAmount, 'USD');
        $workDays = 26;

        return [
            'nameFunction'       => $this->faker->jobTitle(),
            'workDay'            => $workDays,
            'amount'             => $baseMoney,
            'dayAmount'          => $baseMoney->dividedBy($workDays, RoundingMode::HALF_UP),
            'hourAmount'         => $baseMoney->dividedBy($workDays, RoundingMode::HALF_UP)
                                            ->dividedBy(8, RoundingMode::HALF_UP),
            
            'housing'            => Money::of($this->faker->numberBetween(100, 500), 'USD'),
            'transportationCost' => Money::of($this->faker->numberBetween(50, 200), 'USD'),
            'familialAllocation' => Money::of($this->faker->numberBetween(20, 100), 'USD'),
            
            'user_id'            => \App\Models\User::factory(), 
        ];
    }
}
