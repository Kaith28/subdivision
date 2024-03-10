<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'cover_photo',
        'title',
        'body'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
