<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpcomingSermonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\UpcomingSermon::updateOrCreate([
            'title' => 'The Great Revival',
        ], [
            'pastor' => 'Pastor John Doe',
            'image' => 'images/sq-2.jpg',
            'date' => '2025-01-28',
            'button_text' => 'Join Us',
            'button_link' => route('sermon.single'),
        ]);
    }
}
