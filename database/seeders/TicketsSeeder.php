<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();

        foreach ($customers as $customer) {

            // Новая заявка (сегодня)
            Ticket::create([
                'customer_id' => $customer->id,
                'subject' => 'New request',
                'message' => 'Client sent a new request',
                'status' => Ticket::STATUS_NEW,
                'created_at' => now(),
            ]);

            // В работе (неделя)
            Ticket::create([
                'customer_id' => $customer->id,
                'subject' => 'Request in progress',
                'message' => 'Manager is working on this request',
                'status' => Ticket::STATUS_IN_PROGRESS,
                'created_at' => now()->subDays(5),
            ]);

            // Завершена (месяц)
            Ticket::create([
                'customer_id' => $customer->id,
                'subject' => 'Completed request',
                'message' => 'Request successfully processed',
                'status' => Ticket::STATUS_DONE,
                'answered_at' => Carbon::now()->subDays(25),
                'created_at' => now()->subDays(30),
            ]);
        }
    }
}
