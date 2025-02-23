<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrayerRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'state_country',
        'request',
        'phone',
        'email'
    ];
}
