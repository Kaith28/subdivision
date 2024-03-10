<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function isActive()
    {
        $expirationDate = Carbon::parse($this->subscription->expiration);
        $currentDate = Carbon::now();
        if ($currentDate->gte($expirationDate)) {
            return false;
        }
        return true;
    }
}
