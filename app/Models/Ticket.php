<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
