<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'user_id',
        'photo',
        'name',
        'contact_no'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
