<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'amount',
        'checkout_session_id',
        'complete'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
