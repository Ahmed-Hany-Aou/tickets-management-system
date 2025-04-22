<?php

namespace App\Http\Controllers;

use App\Services\TicketService;
use App\Http\Requests\TicketRequest;
use Illuminate\Http\JsonResponse;
use App\Helpers\MessageResponse;

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    // Get all tickets
    public function index(): JsonResponse
    {
        try {
            // Fetch all tickets from the service layer
            $tickets = $this->ticketService->getAllTickets();

            // Check if the tickets collection is empty
            if ($tickets->isEmpty()) {
                return response()->json(MessageResponse::error(MessageResponse::NO_TICKETS_FOUND), 404);
            }

            // Return a success response if tickets are found
           return response()->json(MessageResponse::success(MessageResponse::TICKETS_FETCHED, $tickets), 200);
        } catch (\Exception $e) {
            // Return a generic error response in case of an exception
            return response()->json(MessageResponse::error('An error occurred.'), 500);
        }
    }

    public function store(TicketRequest $request): JsonResponse
    {
        try {
            // The validation has already been handled in TicketRequest
            $ticket = $this->ticketService->createTicket($request->validated());
    
            return response()->json(MessageResponse::success(MessageResponse::TICKET_CREATED, $ticket), 201);
        } catch (\Exception $e) {
            return response()->json(MessageResponse::error('An error occurred while creating the ticket.'), 500);
        }
    }
    
    public function show($id): JsonResponse
    {
        try {
            $ticket = $this->ticketService->getTicket($id);

            if (!$ticket) {
                return response()->json(MessageResponse::error(MessageResponse::TICKET_NOT_FOUND), 404);
            }

            return response()->json(MessageResponse::success(MessageResponse::TICKET_FETCHED, $ticket), 200);
        } catch (\Exception $e) {
            return response()->json(MessageResponse::error('An error occurred while fetching the ticket.'), 500); // More specific message
        }
    }
    
    public function update(TicketRequest $request, $id): JsonResponse
    {
        try {
            $ticket = $this->ticketService->updateTicket($id, $request->validated());
    
            return response()->json(MessageResponse::success(MessageResponse::TICKET_UPDATED, $ticket), 200);
        } catch (\Exception $e) {
            return response()->json(MessageResponse::error('An error occurred while updating the ticket.'), 500);
        }
    }
    
    public function destroy($id): JsonResponse
    {
        try {
            $this->ticketService->deleteTicket($id);
            return response()->json(MessageResponse::success(MessageResponse::TICKET_DELETED), 204);  // No content status
        } catch (\Exception $e) {
            return response()->json(MessageResponse::error('An error occurred while deleting the ticket.'), 500);
        }
    }
}    