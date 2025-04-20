<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_link',
        'category',
        'status',
        'ticket_date',
        'agent',
        'solved_by',
        'last_reminder',
        'comments'
    ];
}
