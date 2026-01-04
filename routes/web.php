<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WidgetController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MediaController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/media/{media}/download', [MediaController::class, 'download'])
        ->name('media.download');
});

Route::middleware(['auth', 'role:manager'])->group(function () {

    Route::get('/tickets', [TicketController::class, 'index'])
        ->name('tickets.index');

    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])
        ->name('tickets.show');

    Route::patch('/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])
        ->name('tickets.updateStatus');
});

Route::get('/widget', [WidgetController::class, 'show'])->name('widget.show');
Route::post('/widget', [WidgetController::class, 'store'])->name('widget.store');


require __DIR__.'/auth.php';
