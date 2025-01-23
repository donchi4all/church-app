<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpcomingSermon extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'pastor',
        'image',
        'date',
        'button_text',
        'button_link',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];
}
