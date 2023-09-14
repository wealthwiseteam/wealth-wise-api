<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Budget;
use App\Models\Category;
use App\Models\Transaction;
use Database\Factories\BillFactory;
use Database\Factories\BudgetFactory;
use Database\Factories\TipFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //$this->call(CategorySeeder::class);
          //$this->call(BudgetSeeder::class);
        //$this->call(PlanSeeder::class);
        $this->call(BillSeeder::class);
        //$this->call(TipSeeder::class);

        //$this->call(AccountSeeder::class);
        //$this->call(TransactionSeeder::class);


         //\App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
