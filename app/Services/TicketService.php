<?php
namespace App\Services;

use App\Models\Ticket;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class TicketService
{
    // Get all tickets
    public function getAllTickets()
    {
        return Ticket::all();
    }

    // Get a single ticket by ID
    public function getTicketByIdOrFreshdeskId($id)
    {
        // If the ID is numeric, we treat it as a Freshdesk ID
        if (is_numeric($id)) {
            // Try to find the ticket by Freshdesk ticket ID (in ticket_link)
            $ticket = Ticket::where('ticket_link', 'like', "%$id%")->first();
            if ($ticket) {
                return $ticket;
            }
        }

        // Otherwise, treat it as a database ID
        $ticket = Ticket::find($id);

        // If no ticket is found, throw an exception
        if (!$ticket) {
            throw new ModelNotFoundException("Ticket not found.");
        }

        return $ticket;
    }
    // Validate and create a new ticket
    public function validateAndCreateTicket(array $data)
    {
        // Validation logic
        $validator = Validator::make($data, [
            'ticket_link' => 'required|url',
            'category' => 'required|string',
            'status' => 'required|string',
            'ticket_date' => 'required|date',
            'agent' => 'required|string',
            'solved_by' => 'required|string',
            'last_reminder' => 'nullable|string',
            'comments' => 'nullable|string',
        ]);

        // If validation fails, throw validation exception
        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        // Create the ticket
        return $this->createTicket($data);
    }


    public function validateAndUpdateTicket($id, array $data)
    {
        // Validation logic
        $validator = Validator::make($data, [
            'ticket_link' => 'required|url',
            'category' => 'required|string',
            'status' => 'required|string',
            'ticket_date' => 'required|date',
            'agent' => 'required|string',
            'solved_by' => 'required|string',
            'last_reminder' => 'nullable|string',
            'comments' => 'nullable|string',
        ]);

        // If validation fails, throw validation exception
        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        // Update the ticket
        return $this->updateTicket($id, $data);
    }

    /**
     * Get a single ticket by ID or Freshdesk ID.
     *
     * @param int|string $id
     * @return array|null
     */
    public function getTicket($id)
    {
        // If the ID is numeric (Freshdesk ticket ID)
        if (is_numeric($id)) {
            // Try to find the ticket by matching the Freshdesk ticket ID in ticket_link
            $ticket = Ticket::where('ticket_link', 'like', "%$id%")->get();
    
            if ($ticket) {
                return $ticket;
            }
        }
    
        // If it's not numeric, treat it as a database ID
        $ticket = Ticket::find($id);
    
        // If no ticket is found, throw an exception
        if (!$ticket) {
            throw new ModelNotFoundException("Ticket not found.");
        }
    
        return $ticket;
    }
    

    // Create a new ticket
    public function createTicket(array $data)
    {
        return Ticket::create([
            'ticket_link' => $data['ticket_link'],
            'category' => $data['category'],
            'status' => $data['status'],
            'ticket_date' => $data['ticket_date'],
            'agent' => $data['agent'],
            'solved_by' => $data['solved_by'],
            'last_reminder' => $data['last_reminder'] ?? null,
            'comments' => $data['comments'] ?? null,
        ]);
    }

    // Update an existing ticket
    public function updateTicket($id, array $data)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update($data);
        return $ticket;
    }

    // Delete a ticket
    public function deleteTicket($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
    }
}
