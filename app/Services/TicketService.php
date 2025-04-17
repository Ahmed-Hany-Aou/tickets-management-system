<?php
namespace App\Services;

use App\Models\Ticket;

class TicketService
{
    // Get all tickets
    public function getAllTickets()
    {
        return Ticket::all();
    }

    // Get a single ticket by ID
    public function getTicketById($id)
    {
        return Ticket::findOrFail($id);
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
        $ticket->update([
            'ticket_link' => $data['ticket_link'],
            'category' => $data['category'],
            'status' => $data['status'],
            'ticket_date' => $data['ticket_date'],
            'agent' => $data['agent'],
            'solved_by' => $data['solved_by'],
            'last_reminder' => $data['last_reminder'] ?? null,
            'comments' => $data['comments'] ?? null,
        ]);
        return $ticket;
    }

    // Delete a ticket
    public function deleteTicket($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
    }
}