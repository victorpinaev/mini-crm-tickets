<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\Customer;
use App\Repositories\Contracts\TicketRepositoryInterface;
use Illuminate\Support\Facades\DB;


class TicketService
{
    public function __construct(
        private TicketRepositoryInterface $tickets
    ) {}

    public function create(array $data, array $files = []): Ticket
    {
        return DB::transaction(function () use ($data, $files) {

            $customer = Customer::firstOrCreate(
                ['phone' => $data['phone']],
                [
                    'email' => $data['email'] ?? null,
                    'name'  => $data['name'],
                ]
            );

            $ticket = $this->tickets->create([
                'customer_id' => $customer->id,
                'subject'     => $data['subject'],
                'message'     => $data['message'],
                'status'      => Ticket::STATUS_NEW,
            ]);

            foreach ($files as $file) {
                $ticket
                    ->addMedia($file)
                    ->toMediaCollection('attachments');
            }

            return $ticket;
        });
    }
}
