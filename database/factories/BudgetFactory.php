<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Budget>
 */
class BudgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     protected $model=Budget::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'user_id' => function(){
<<<<<<< HEAD
                 return User::factory()->create()->id;
=======
            return User::factory()->create()->id;
>>>>>>> 8a18d3f (edit database seeder and budget factory)
            },
            'amount' => $this->faker->randomFloat(2, 1000, 10000),
            'category_id' => $this->faker->numberBetween(1, 2),
            'start_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'end_date' => $this->faker->dateTimeBetween('+1 month', '+1 year'),
            'period' => $this->faker->dateTimeBetween('+1 month', '+1 year'),
        ];
    }
}
