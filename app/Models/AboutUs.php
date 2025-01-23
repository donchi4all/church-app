<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'button_text',
        'button_link',
        'images',
    ];

    protected $casts = [
        'images' => 'array', // To handle multiple image paths stored as JSON in the database
    ];

    /**
     * Accessor to decode the images JSON into an array.
     */
    public function getImagesAttribute($value)
    {
        return json_decode($value); // Convert JSON string to PHP array
    }
}
