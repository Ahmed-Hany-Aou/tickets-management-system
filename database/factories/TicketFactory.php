<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition()
    {
        return [
            'ticket_link' => $this->faker->url,  // Use Faker to generate a fake URL
            'category' => $this->faker->word,
            'status' => $this->faker->randomElement(['open', 'closed']),
            'ticket_date' => $this->faker->date,
            'agent' => $this->faker->name,
            'solved_by' => $this->faker->name,
            'last_reminder' => $this->faker->optional()->word,
            'comments' => $this->faker->optional()->paragraph,
        ];
    }
}
