<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Hero;
use App\Models\AboutUs;
use App\Models\Testimonial;
use App\Models\RecentSermon;
use Illuminate\Http\Request;
use App\Models\UpcomingSermon;

class PageController extends Controller
{
    public function home()
    {
        // // Hero Section Data
        // $hero = [
        //     'title' => 'Arise & Shine',
        //     'subtitle' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
        //     'image' => 'images/landscape-1.jpg',
        //     'image2' => 'images/landscape-2.jpg',
        //     'button' => ['text' => 'Go to sermons', 'link' => route('sermon.single')],
        //     'youtube' => 'https://www.youtube.com/watch?v=mwtbEGNABWU'
        // ];

        // // Upcoming Sermons Section
        // $upcomingSermon = [
        //     'title' => 'We Must Be Doers of The Word Not Hearers Only',
        //     'pastor' => 'Pastor Nelson',
        //     'image' => 'images/sq-2.jpg',
        //     'date' => now()->addDays(30),
        //     'button' => ['text' => 'Join This Sermon', 'link' => '#'],
        // ];

        // // Recent Sermons Section
        // $recentSermons = [
        //     [
        //         'title' => 'Live The Message',
        //         'date' => '15 Jan 2020',
        //         'pastor' => 'Pastor Campbell',
        //         'image' => 'images/rect-img-1.jpg',
        //         'description' => 'Far far away, behind the word mountains.',
        //         'link' => '#',
        //     ],
        //     [
        //         'title' => 'Doers Not Hearers',
        //         'date' => '22 Jan 2020',
        //         'pastor' => 'Pastor Campbell',
        //         'image' => 'images/rect-img-2.jpg',
        //         'description' => 'Far far away, behind the word mountains.',
        //         'link' => '#',
        //     ],
        //     [
        //         'title' => 'By faith not by sight',
        //         'date' => '22 Jan 2020',
        //         'pastor' => 'Pastor Campbell',
        //         'image' => 'images/rect-img-3.jpg',
        //         'description' => 'Far far away, behind the word mountains.',
        //         'link' => '#',
        //     ],
        // ];

        // // About Us Section
        // $aboutUs = [
        //     'title' => 'Welcome to TheChurch',
        //     'description' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
        //     'button' => ['text' => 'Know more about us', 'link' => '#'],
        //     'images' => ['images/sq-1.jpg', 'images/sq-2.jpg', 'images/sq-3.jpg', 'images/sq-4.jpg', 'images/sq-5.jpg', 'images/sq-6.jpg']
        // ];

        // // Testimonials Section
        // $testimonials = [
        //     [
        //         'quote' => 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.',
        //         'author' => 'James Smith',
        //         'role' => 'Church Visitor',
        //         'image' => 'images/person_1.jpg', // Cycles through 1, 2, 3
        //         'title' => 'Far far away, behind the word mountains'
        //     ],
        //     [
        //         'quote' => 'Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.',
        //         'author' => 'Emily Johnson',
        //         'role' => 'Church Member',
        //         'image' => 'images/person_2.jpg', // Cycles through 1, 2, 3
        //         'title' => 'Separated they live in Bookmarksgrove'
        //     ],
        //     [
        //         'quote' => 'They live the blind texts and speak in multiple languages that cannot be understood.',
        //         'author' => 'Sarah Lee',
        //         'role' => 'Church Volunteer',
        //         'image' => 'images/person_3.jpg', // Cycles through 1, 2, 3
        //         'title' => 'The language of the blind texts'
        //     ],
        //     [
        //         'quote' => 'Far from the countries Vokalia and Consonantia, they lead the world with blind texts.',
        //         'author' => 'John Doe',
        //         'role' => 'Guest Speaker',
        //         'image' => 'images/person_4.jpg', // Cycles through 1, 2, 3
        //         'title' => 'Leading with the blind texts'
        //     ],
        //     [
        //         'quote' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
        //         'author' => 'Jessica Brown',
        //         'role' => 'Church Leader',
        //         'image' => 'images/person_5.jpg', // Cycles through 1, 2, 3
        //         'title' => 'The river named Duden'
        //     ],
        //     [
        //         'quote' => 'There live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics.',
        //         'author' => 'Michael Green',
        //         'role' => 'Church Member',
        //         'image' => 'images/person_3.jpg', // Cycles through 1, 2, 3
        //         'title' => 'The coast of Semantics'
        //     ],
        //     [
        //         'quote' => 'The large language ocean that connects the worlds of Vokalia and Consonantia.',
        //         'author' => 'William White',
        //         'role' => 'Church Visitor',
        //         'image' => 'images/person_2.jpg', // Cycles through 1, 2, 3
        //         'title' => 'The large language ocean'
        //     ],
        //     [
        //         'quote' => 'Separated they live in Bookmarksgrove, where the Semantics create a beautiful language ocean.',
        //         'author' => 'Mary Black',
        //         'role' => 'Church Volunteer',
        //         'image' => 'images/person_4.jpg', // Cycles through 1, 2, 3
        //         'title' => 'Creating a beautiful language'
        //     ]
        // ];


        // //join us
        $joinUs = [
            'title' => 'Get better by hearing our sermons',
            'button_text' => 'join us',
            'button_link' => route('sermon.single'),
        ];

        $hero = Hero::whereId(1)->first();
        $upcomingSermon = UpcomingSermon::first();
        $recentSermons = RecentSermon::all();
        $aboutUs = AboutUs::first();
        $testimonials = Testimonial::all();

        return view('frontend.pages.home', compact('hero', 'upcomingSermon', 'recentSermons', 'aboutUs', 'testimonials', 'joinUs'));
    }


    public function ministry()
    {
        // Hero Section Data
        // $hero = [
        //     'title' => 'Ministry',
        //     'subtitle' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
        //     'image' => 'images/landscape-1.jpg',
        //     'image2' => 'images/landscape-1.jpg',
        //     'button' => ['text' => 'Go to sermons', 'link' => route('sermon.single')],
        //     'youtube' => 'https://www.youtube.com/watch?v=mwtbEGNABWU'
        // ];

        // // Recent Sermons Section
        // $recentSermons = [
        //     [
        //         'title' => 'Womens Ministry',
        //         'image' => 'images/rect-img-6.jpg',
        //         'description' => 'Far far away, behind the word mountains.',
        //         'link' => '#',
        //         'readmore' => 'Read more',
        //     ],
        //     [
        //         'title' => 'Children Ministry',
        //         'image' => 'images/rect-img-4.jpg',
        //         'description' => 'Far far away, behind the word mountains.',
        //         'link' => '#',
        //         'readmore' => 'Read more',
        //     ],
        //     [
        //         'title' => 'Personal Ministry',
        //         'image' => 'images/rect-img-1.jpg',
        //         'description' => 'Far far away, behind the word mountains.',
        //         'link' => '#',
        //         'readmore' => 'Read more',
        //     ],
        //     [
        //         'title' => 'Womens Ministry',
        //         'image' => 'images/rect-img-5.jpg',
        //         'description' => 'Far far away, behind the word mountains.',
        //         'link' => '#',
        //         'readmore' => 'Read more',
        //     ],
        //     [
        //         'title' => 'Children Ministry',
        //         'image' => 'images/rect-img-3.jpg',
        //         'description' => 'Far far away, behind the word mountains.',
        //         'link' => '#',
        //         'readmore' => 'Read more',
        //     ],
        //     [
        //         'title' => 'Personal Ministry',
        //         'image' => 'images/rect-img-2.jpg',
        //         'description' => 'Far far away, behind the word mountains.',
        //         'link' => '#',
        //         'readmore' => 'Read more',
        //     ]

        // ];

        $hero = Hero::whereId(2)->first();
        $recentSermons = RecentSermon::all();

        return view('frontend.pages.ministry', compact('hero', 'recentSermons'));
    }

    public function contact()
    {
        // Hero Section Data
        // $hero = [
        //     'title' => 'Get In Touch',
        //     'subtitle' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
        //     'image' => 'images/landscape-1.jpg',
        //     'image2' => 'images/landscape-1.jpg',
        //     'button' => ['text' => 'Go to sermons', 'link' => route('sermon.single')],
        //     'youtube' => 'https://www.youtube.com/watch?v=mwtbEGNABWU'
        // ];

        // Data for the Contact Page
        $contactDetails = [
            'address' => '155 Market St #101, Paterson, NJ 07505, United States',
            'phone' => '+1 202 2020 200',
            'email' => 'info@mydomain.com',
            'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4263.740639795807!2d-74.17364760599528!3d40.917497609740195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2fdcb3088f637%3A0xd6a71bd6813b7c40!2sPaterson%20City%20Hall!5e0!3m2!1sen!2sph!4v1597647087983!5m2!1sen!2sph'
        ];

        $hero = Hero::whereId(3)->first();
        return view('frontend.pages.contact', compact('contactDetails', 'hero'));
    }

    public function sermonSingle()
    {
        // Data for the Single Sermon Page
        $sermon = [
            'title' => 'Living and Sharing The Gospel',
            'date' => '15 Jan 2020',
            'pastor' => 'Pastor Campbell',
            'content' => 'Far far away, behind the word mountains...',
        ];

        $relatedSermons = [
            [
                'title' => 'Living and Sharing The Gospel',
                'date' => '15 Jan 2020',
                'pastor' => 'Pastor Campbell',
                'image' => 'images/sq-3.jpg',
                'link' => '#',
            ],
        ];

        return view('frontend.pages.sermon-single', compact('sermon', 'relatedSermons'));
    }

    public function partnership()
    {
        // Hero Section Data
        // $hero = [
        //     'title' => 'Partnership',
        //     'subtitle' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
        //     'image' => 'images/landscape-1.jpg',
        //     'image2' => 'images/landscape-2.jpg',
        //     'button' => ['text' => 'Go to sermons', 'link' => route('sermon.single')],
        //     'youtube' => 'https://www.youtube.com/watch?v=mwtbEGNABWU'
        // ];

        $hero = Hero::whereId(4)->first();

        return view('frontend.pages.partnership', compact('hero'));
    }


    public function prayerForm()
    {
        // Hero Section Data
        // $hero = [
        //     'title' => 'Prayer Form',
        //     'subtitle' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
        //     'image' => 'images/landscape-1.jpg',
        //     'image2' => 'images/landscape-2.jpg',
        //     'button' => ['text' => 'Go to sermons', 'link' => route('sermon.single')],
        //     'youtube' => 'https://www.youtube.com/watch?v=mwtbEGNABWU'
        // ];
        $hero = Hero::whereId(5)->first();

        return view('frontend.pages.prayer-form', compact('hero'));
    }

    public function donation()
    {
        // Hero Section Data
        // $hero = [
        //     'title' => 'Donation',
        //     'subtitle' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
        //     'image' => 'images/landscape-1.jpg',
        //     'image2' => 'images/landscape-2.jpg',
        //     'button' => ['text' => 'Go to sermons', 'link' => route('sermon.single')],
        //     'youtube' => 'https://www.youtube.com/watch?v=mwtbEGNABWU'
        // ];
        $hero = Hero::whereId(6)->first();

        return view('frontend.pages.donation', compact('hero'));
    }

}
