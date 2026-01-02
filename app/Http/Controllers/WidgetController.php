<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Services\TicketService;

class WidgetController extends Controller
{
    public function __construct(private TicketService $ticketService) {}

    public function show()
    {
        return view('widget');
    }

    public function store(StoreTicketRequest $request)
    {
        $ticket = $this->ticketService->create(
            $request->validated(),
            $request->file('files', [])
        );

        return response()->json([
            'success' => true,
            'message' => 'Ваша заявка успешно отправлена',
        ]);
    }
}
