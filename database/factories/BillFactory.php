<?php

namespace Database\Factories;

use App\Models\Bill;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Bill::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'amount'=>$this->faker->randomFloat(2,0,1000),
            'category_id'=>function(){
                return Category::factory()->create()->id;
            },
            'payment_date'=>$this->faker->dateTimeBetween('+1 month', '+1 year'),
            'status'=>$this->faker->boolean(),
            'user_id'=>function(){
                return User::factory()->create()->id;
            },
            'period'=>$this->faker->dateTimeBetween('+1 month','+1 year')

        ];
    }
}
