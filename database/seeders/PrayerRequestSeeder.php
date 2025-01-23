<?php

namespace Database\Seeders;

use App\Models\PrayerRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrayerRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrayerRequest::create([
            'title' => 'Mr',
            'first_name' => 'John',
            'middle_name' => 'A.',
            'last_name' => 'Doe',
            'state_country' => 'New York, USA',
            'request' => 'Pray for health and blessings.',
        ]);

        PrayerRequest::create([
            'title' => 'Mrs',
            'first_name' => 'Jane',
            'middle_name' => null,
            'last_name' => 'Smith',
            'state_country' => 'California, USA',
            'request' => 'Pray for my family.',
        ]);
    }
}
