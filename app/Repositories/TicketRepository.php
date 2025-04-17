<?php

namespace App\Repositories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TicketRepository
{
    // Get all tickets
    public function getAllTickets()
    {
        return Ticket::all();
    }

    // Get a single ticket by ID or Freshdesk ID
    public function getTicketByIdOrFreshdeskId($id)
    {
        // If the ID is numeric, first try to find tickets by Freshdesk ticket ID
        if (is_numeric($id)) {
            // Search for all tickets where ticket_link contains the numeric ID
            $tickets = Ticket::where('ticket_link', 'LIKE', "%/$id")->get();
            if ($tickets->isNotEmpty()) {
                return $tickets;
            }
        }

        // If no tickets are found by ticket_link, treat it as a database ID
        $ticket = Ticket::find($id);

        // If no ticket is found, throw an exception
        if (!$ticket) {
            throw new ModelNotFoundException("Ticket not found.");
        }

        return $ticket;
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
