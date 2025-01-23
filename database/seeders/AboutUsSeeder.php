<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\AboutUs::updateOrCreate([
            'title' => 'About Our Church',
        ], [
            'description' => 'We are a community of believers dedicated to spreading love, faith, and hope.',
            'button_text' => 'Learn More',
            'button_link' => '#',
            'images' => json_encode([
                'images/sq-1.jpg',
                'images/sq-2.jpg',
                'images/sq-3.jpg',
                'images/sq-4.jpg',
                'images/sq-5.jpg',
                'images/sq-6.jpg'
            ]),
        ]);
    }
}
