<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::prefix('tickets')->group(function() {
    // Create a new ticket
    Route::post('/', [TicketController::class, 'store']);

    // Get all tickets
    Route::get('/', [TicketController::class, 'index']);




    // Get a single ticket by ID or by Freshdesk ID
    // This route will handle both cases: /tickets/{id} and /tickets/freshdesk/{id}
    // where {id} can be either a database ID or a Freshdesk ticket ID
    // The controller will determine how to handle the request based on the ID format
    Route::get('{id}', [TicketController::class, 'show']);

    // Update a ticket
    Route::put('{id}', [TicketController::class, 'update']);


    

    // Delete a ticket single ticket by ID or by Freshdesk ID
    // This route will handle both cases: /tickets/{id} and /tickets/freshdesk/{id}
    // where {id} can be either a database ID or a Freshdesk ticket ID
    // The controller will determine how to handle the request based on the ID format
    Route::delete('{id}', [TicketController::class, 'destroy']);
});