<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;

class TicketStatisticsController extends Controller
{
    public function index()
    {
        return response()->json([
            'today' => Ticket::today()->count(),
            'week'  => Ticket::thisWeek()->count(),
            'month' => Ticket::thisMonth()->count(),
        ]);
    }
}

