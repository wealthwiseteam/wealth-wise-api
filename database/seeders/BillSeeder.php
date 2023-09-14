<?php

namespace Database\Seeders;

use App\Models\Bill;
use Database\Factories\BillFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bill::factory(5)->create();
    }
}
