<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Plan::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'icon' => $this->faker->word,
            'color' => $this->faker->hexColor,
            'note' => $this->faker->sentence,
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
            'current_amount' => $this->faker->randomFloat(2, 0, 1000),
            'target_amount' => $this->faker->randomFloat(2, 1000, 5000),
            'user_id'=>function(){
                return User::factory()->create()->id;
            },
            'category_id'=>function(){
                return Category::factory()->create()->id;
            }

        ];
    }
}
