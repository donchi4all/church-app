<?php

namespace Database\Seeders;

use App\Models\RecentSermon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecentSermonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        RecentSermon::updateOrCreate([
            'title' => 'Walking in Faith',
        ], [
            'pastor' => 'Pastor Jane Smith',
            'image' => 'images/rect-img-1.jpg',
            'date' => '2025-01-15',
            'description' => 'An inspiring sermon on how to walk by faith and not by sight.',
            'link' => route('sermon.single'),
        ]);

        RecentSermon::updateOrCreate([
            'title' => 'Overcoming Doubt',
        ], [
            'pastor' => 'Pastor John Doe',
            'image' => 'images/rect-img-2.jpg',
            'date' => '2024-12-05',
            'description' => 'A powerful sermon focused on how to overcome doubt and trust in God\'s plan.',
            'link' => route('sermon.single'),
        ]);

        RecentSermon::updateOrCreate([
            'title' => 'The Power of Prayer',
        ], [
            'pastor' => 'Pastor Emily Davis',
            'image' => 'images/rect-img-3.jpg',
            'date' => '2025-01-10',
            'description' => 'A sermon on the transformative power of prayer in our daily lives.',
            'link' => route('sermon.single'),
        ]);

    }
}
