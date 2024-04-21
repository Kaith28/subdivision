<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventGuest extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'in_charge_id',
        'photo',
        'name',
        'contact_no',
        'out'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
