<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Account::class;
    public function definition(): array
    {
        return [
            'user_id' => function(){
                return User::factory()->create()->id;
            },
            'name' =>$this ->faker->word,
            'type' =>$this-> faker->randomElement(['Credit Card', 'E-wallet']),
            'amount' =>$this->faker->randomFloat(2, 0, 10000),
        ];
    }
}
