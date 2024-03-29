<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'user_id',
        'in_charge_id',
        'in',
        'out',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
