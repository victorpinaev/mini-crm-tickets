<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::factory()->count(6)->create();

        // Клиент только с телефоном
        Customer::create([
            'name' => 'Phone Only Customer',
            'phone' => '+380501112233',
            'email' => null,
        ]);
    }
}
