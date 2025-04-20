<?php

namespace App\Helpers;

class MessageResponse
{
    // Success Messages
    const TICKET_CREATED = 'Ticket created successfully.';
    const TICKET_UPDATED = 'Ticket updated successfully.';
    const TICKET_DELETED = 'Ticket deleted successfully.';
    const TICKET_FETCHED = 'Ticket fetched successfully.';
    const TICKETS_FETCHED = 'Tickets fetched successfully.';

    // Error Messages
    const TICKET_NOT_FOUND = 'Ticket not found.';
    const NO_TICKETS_FOUND = 'No tickets found.';
    const INVALID_TICKET_ID = 'Invalid ticket ID.';
    const INVALID_FRESHDESK_ID = 'Invalid Freshdesk ticket ID.';

    // Get response structure
    public static function getResponse($status, $message, $data = null)
    {
        return [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
    }

    // Get Success Response
    public static function success($message, $data = null)
    {
        return self::getResponse('success', $message, $data);
    }

    // Get Error Response
    public static function error($message, $data = null)
    {
        return self::getResponse('error', $message, $data);
    }
}
