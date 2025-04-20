<?php

namespace App\Services;

use App\Repositories\TicketRepository;
use App\Helpers\MessageResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Ticket;


class TicketService
{
    protected $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    // Get all tickets
    public function getAllTickets()
    {
        return $this->ticketRepository->getAllTickets(); // Delegate to the repository
    }

    // Get a single ticket by ID or Freshdesk ID
    public function getTicket($id)
    {
        return $this->ticketRepository->getTicketByIdOrFreshdeskId($id);
    }

    // Create a new ticket
    public function createTicket(array $data)
    {
        return $this->ticketRepository->createTicket($data);
    }

    // Update an existing ticket
    public function updateTicket($id, array $data)
    {
        return $this->ticketRepository->updateTicket($id, $data);
    }

    // Delete a ticket
    public function deleteTicket($id)
    {
        return $this->ticketRepository->deleteTicket($id);
    }
}
