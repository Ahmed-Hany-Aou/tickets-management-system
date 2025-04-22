<?php

namespace App\Services;

use App\Repositories\TicketRepository;
use App\Helpers\MessageResponse;
use App\Models\Ticket;
use Illuminate\Support\Collection; // Add this

class TicketService
{
    protected $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    // Get all tickets
    public function getAllTickets(): Collection // Specify return type
    {
        return $this->ticketRepository->getAllTickets(); // Just return the Collection
    }

    // ... (other methods remain largely the same, but remove MessageResponse)

    public function getTicket($id)
    {
        $ticket = $this->ticketRepository->getTicketByIdOrFreshdeskId($id);

        if (!$ticket) {
            return null; // Return null if not found (or throw an exception, see below)
        }

        return $ticket;
    }

    public function createTicket(array $data)
    {
        return $this->ticketRepository->createTicket($data);
    }

    public function updateTicket($id, array $data)
    {
        return $this->ticketRepository->updateTicket($id, $data);
    }

    public function deleteTicket($id)
    {
        return $this->ticketRepository->deleteTicket($id);
    }
}