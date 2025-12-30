<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;

class WidgetController extends Controller
{
    public function show()
    {
        return view('widget');
    }

    public function store(StoreTicketRequest $request)
    {
        $request->validated();

        return response()->json([
            'success' => true,
            'message' => 'Ваша заявка успешно отправлена',
        ]);
    }
}
