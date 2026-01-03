<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WidgetController;
use App\Http\Controllers\AdminTicketController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware('role:manager')->group(function () {
        Route::get('/tickets', function () {
            return 'Управление тикетами';
        })->name('tickets.index');
    });
});

Route::get('/widget', [WidgetController::class, 'show'])->name('widget.show');
Route::post('/widget', [WidgetController::class, 'store'])->name('widget.store');


require __DIR__.'/auth.php';
