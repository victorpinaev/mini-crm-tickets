<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Services\TicketService;

class TicketController extends Controller
{
    public function store(
        StoreTicketRequest $request,
        TicketService $service
    ) {
        $ticket = $service->create(
            $request->validated(),
            $request->file('files', [])
        );

        return (new TicketResource($ticket))
            ->response()
            ->setStatusCode(201);
    }
}

