<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizer',
        'address',
        'contact_no',
        'event_location',
        'event_purpose',
        'estimated_attendees',
        'start_time',
        'end_time',
        'time',
    ];

    public function eventGuests()
    {
        return $this->hasMany(EventGuest::class);
    }
}
