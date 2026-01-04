<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('customer')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['customer', 'media']);

        return view('tickets.show', compact('ticket'));
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:new,in_progress,done',
        ]);

        $ticket->update([
            'status' => $request->status,
            'answered_at' => $request->status === 'done' ? now() : null,
        ]);

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('success', 'Статус обновлён');
    }


}
