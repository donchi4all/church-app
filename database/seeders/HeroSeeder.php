<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $heroData = [
            'Arise & Shine in Faith' => [
                'subtitle' => 'Arise and shine, for your light has come! (Isaiah 60:1)',
                'image' => 'images/landscape-1.jpg',
                'image2' => 'images/landscape-2.jpg',
                'button_text' => 'Go to sermons',
                'button_link' => route('sermon.single'),
                'youtube' => 'https://www.youtube.com/watch?v=mwtbEGNABWU',
            ],
            'Ministry of Reconciliation' => [
                'subtitle' => 'Ministry of reconciliation: Serving God and His people (2 Corinthians 5:18)',
                'image' => 'images/landscape-1.jpg',
                'image2' => 'images/landscape-1.jpg',
                'button_text' => 'Go to sermons',
                'button_link' => route('sermon.single'),
                'youtube' => 'https://www.youtube.com/watch?v=mwtbEGNABWU',
            ],
            'Fellowship in Partnership' => [
                'subtitle' => 'Partnership in the gospel: Fellowship in Christ (Philippians 1:5)',
                'image' => 'images/landscape-1.jpg',
                'image2' => 'images/landscape-2.jpg',
                'button_text' => 'Go to sermons',
                'button_link' => route('sermon.single'),
                'youtube' => 'https://www.youtube.com/watch?v=mwtbEGNABWU',
            ],
            'Reach Out in Faith' => [
                'subtitle' => 'Reach out to us: The Lord is near to all who call on Him (Psalm 145:18)',
                'image' => 'images/landscape-1.jpg',
                'image2' => 'images/landscape-1.jpg',
                'button_text' => 'Go to sermons',
                'button_link' => route('sermon.single'),
                'youtube' => 'https://www.youtube.com/watch?v=mwtbEGNABWU',
            ],
            'Power of Prayer' => [
                'subtitle' => 'The prayer of the righteous is powerful and effective (James 5:16)',
                'image' => 'images/landscape-1.jpg',
                'image2' => 'images/landscape-2.jpg',
                'button_text' => 'Go to sermons',
                'button_link' => route('sermon.single'),
                'youtube' => 'https://www.youtube.com/watch?v=mwtbEGNABWU',
            ],
            'Generosity in Giving' => [
                'subtitle' => 'Give and it will be given to you (Luke 6:38)',
                'image' => 'images/landscape-1.jpg',
                'image2' => 'images/landscape-2.jpg',
                'button_text' => 'Go to sermons',
                'button_link' => route('sermon.single'),
                'youtube' => 'https://www.youtube.com/watch?v=mwtbEGNABWU',
            ],
        ];

        foreach ($heroData as $title => $data) {
            \App\Models\Hero::updateOrCreate([
                'title' => $title,
            ], $data);
        }

    }
}
