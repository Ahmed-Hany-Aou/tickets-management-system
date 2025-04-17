<?php

namespace App\Http\Controllers;

use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    // Get all tickets
    public function index()
    {
        return response()->json($this->ticketService->getAllTickets(), 200);
    }

    // Get a single ticket by ID
    public function show($id)
    {
        return response()->json($this->ticketService->getTicketById($id), 200);
    }

    // Create a new ticket
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ticket_link' => 'required|url',           // Validate ticket link
            'category' => 'required|string',           // Validate category
            'status' => 'required|string',             // Validate status
            'ticket_date' => 'required|date',          // Validate ticket date
            'agent' => 'required|string',              // Validate agent
            'solved_by' => 'required|string',          // Validate solved_by (required)
            'last_reminder' => 'nullable|string',      // Validate last reminder (nullable)
            'comments' => 'nullable|string',           // Validate comments (nullable)
        ]);
    
        // Use the TicketService for creating the ticket
        $ticket = $this->ticketService->createTicket($validated);

        return response()->json($ticket, 201);  // Return the created ticket as JSON with HTTP status 201
    }

    // Update an existing ticket
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'ticket_link' => 'required|url',          // Validate ticket link
            'category' => 'required|string',          // Validate category
            'status' => 'required|string',            // Validate status
            'ticket_date' => 'required|date',         // Validate ticket date
            'agent' => 'required|string',             // Validate agent
            'solved_by' => 'required|string',         // Validate solved_by (required)
            'last_reminder' => 'nullable|string',     // Validate last reminder (nullable)
            'comments' => 'nullable|string',          // Validate comments (nullable)
        ]);

        // Use the TicketService to update the ticket
        $ticket = $this->ticketService->updateTicket($id, $validated);
        return response()->json($ticket, 200);
    }

    // Delete a ticket
    public function destroy($id)
    {
        $this->ticketService->deleteTicket($id);
        return response()->json(null, 204);
    }
}
