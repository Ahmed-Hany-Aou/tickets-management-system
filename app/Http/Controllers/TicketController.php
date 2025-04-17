<?php
namespace App\Http\Controllers;

use App\Services\TicketService;
use App\Http\Requests\TicketRequest;
use Illuminate\Http\JsonResponse;

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
        $tickets = $this->ticketService->getAllTickets();
        return response()->json($tickets, 200);
    }

    // Get a single ticket by ID or Freshdesk ID
    public function show($id): JsonResponse
    {
        $ticket = $this->ticketService->getTicket($id);
        return response()->json($ticket, 200);
    }

    // Create a new ticket
    public function store(TicketRequest $request): JsonResponse
    {
        // The validation has already been handled in TicketRequest
        $ticket = $this->ticketService->createTicket($request->validated());
        return response()->json($ticket, 201);  // Created status
    }

    // Update a ticket
    public function update(TicketRequest $request, $id): JsonResponse
    {
        // The validation has already been handled in TicketRequest
        $ticket = $this->ticketService->updateTicket($id, $request->validated());
        return response()->json($ticket, 200);
    }

    // Delete a ticket
    public function destroy($id): JsonResponse
    {
        $this->ticketService->deleteTicket($id);
        return response()->json(null, 204);  // No content status
    }
}
