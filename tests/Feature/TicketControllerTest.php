<?php

namespace Tests\Feature;

use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketControllerTest extends TestCase
{
    use RefreshDatabase;  // This ensures the database is refreshed before each test

    // Test to check if tickets are fetched successfully
    public function test_returns_success_when_tickets_are_fetched()
    {
        // Create 5 tickets using the factory
        Ticket::factory()->count(5)->create();
    
        // Simulate the GET request to fetch all tickets
        $response = $this->getJson('/tickets');
    
        // Assert that the response is successful and returns the expected success message
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Tickets fetched successfully.',
                     'data' => [] // Expecting an array here for the ticket data
                 ]);
    }

    public function test_returns_error_when_no_tickets_are_found()
{
    // Simulate the GET request to fetch all tickets when the database is empty
    $response = $this->getJson('/tickets');

    // Assert that the response returns the correct error message
    $response->assertStatus(404)
             ->assertJson([
                 'status' => 'error',
                 'message' => 'No tickets found.',
             ]);
}








    
    // Test to check if a ticket is created successfully
    public function test_creates_a_ticket_successfully()
    {
        // Ticket data
        $ticketData = [
            'ticket_link' => 'https://newaccount1608206318646.freshdesk.com/a/tickets/11111',
            'category' => 'payment details',
            'status' => 'closed',
            'ticket_date' => '2025-04-15',
            'agent' => 'hany',
            'solved_by' => 'hany',
            'last_reminder' => null,
            'comments' => 'open FC_RECEIPT_DETAILS and get all info to add the details',
        ];

        // Simulate the POST request to create a ticket
        $response = $this->postJson('/tickets', $ticketData);

        // Assert that the response status is 201 and the correct success message is returned
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Ticket created successfully.',
                 ]);
    }
    // Test to check if a ticket is fetched successfully by ID
    
    /* suggested by vs code
    public function test_fetches_a_ticket_successfully()
    {
        // Create a ticket using the factory
        $ticket = Ticket::factory()->create();

        // Simulate the GET request to fetch the ticket by ID
        $response = $this->getJson('/tickets/' . $ticket->id);

        // Assert that the response is successful and returns the expected success message
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Ticket fetched successfully.',
                 ]);
    }
            check this suggestion after wards with chat gpt      */   
}
