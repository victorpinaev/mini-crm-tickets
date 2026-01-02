<?php

namespace App\Repositories;

use App\Models\Ticket;
use App\Repositories\Contracts\TicketRepositoryInterface;

class EloquentTicketRepository implements TicketRepositoryInterface
{
    public function create(array $data): Ticket
    {
        return Ticket::create($data);
    }
}

