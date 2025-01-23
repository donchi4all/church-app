<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Testimonial::updateOrCreate([
            'author' => 'James Smith',
        ], [
            'quote' => 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.',
            'role' => 'Church Visitor',
            'image' => 'images/person_1.jpg',
            'title' => 'Far far away, behind the word mountains',
        ]);

        Testimonial::updateOrCreate([
            'author' => 'Emily Johnson',
        ], [
            'quote' => 'Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.',
            'role' => 'Church Member',
            'image' => 'images/person_2.jpg',
            'title' => 'Separated they live in Bookmarksgrove',
        ]);

        Testimonial::updateOrCreate([
            'author' => 'Sarah Lee',
        ], [
            'quote' => 'They live the blind texts and speak in multiple languages that cannot be understood.',
            'role' => 'Church Volunteer',
            'image' => 'images/person_3.jpg',
            'title' => 'The language of the blind texts',
        ]);

        Testimonial::updateOrCreate([
            'author' => 'John Doe',
        ], [
            'quote' => 'Far from the countries Vokalia and Consonantia, they lead the world with blind texts.',
            'role' => 'Guest Speaker',
            'image' => 'images/person_4.jpg',
            'title' => 'Leading with the blind texts',
        ]);

        Testimonial::updateOrCreate([
            'author' => 'Jessica Brown',
        ], [
            'quote' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
            'role' => 'Church Leader',
            'image' => 'images/person_5.jpg',
            'title' => 'The river named Duden',
        ]);

        Testimonial::updateOrCreate([
            'author' => 'Michael Green',
        ], [
            'quote' => 'There live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics.',
            'role' => 'Church Member',
            'image' => 'images/person_3.jpg',
            'title' => 'The coast of Semantics',
        ]);

        Testimonial::updateOrCreate([
            'author' => 'William White',
        ], [
            'quote' => 'The large language ocean that connects the worlds of Vokalia and Consonantia.',
            'role' => 'Church Visitor',
            'image' => 'images/person_2.jpg',
            'title' => 'The large language ocean',
        ]);

        Testimonial::updateOrCreate([
            'author' => 'Mary Black',
        ], [
            'quote' => 'Separated they live in Bookmarksgrove, where the Semantics create a beautiful language ocean.',
            'role' => 'Church Volunteer',
            'image' => 'images/person_4.jpg',
            'title' => 'Creating a beautiful language',
        ]);

    }
}
