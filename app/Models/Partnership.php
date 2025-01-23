<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partnership extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'occupation',
        'address',
        'state_country',
        'phone_number',
        'alt_phone_number',
        'email',
        'monthly_pledge',
    ];

}
