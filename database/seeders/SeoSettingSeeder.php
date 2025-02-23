<?php

namespace Database\Seeders;

use App\Models\SeoSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeoSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $pages = [
            'home' => [
                'title' => 'Welcome to Grace Operated Life Ministry',
                'description' => 'Experience the presence of God and grow in faith with us at Grace Operated Life Ministry. Join our community and be blessed.',
                'keywords' => 'church, faith, grace, Christian community, worship, sermons',
                'image' => 'images/seo/home.jpg',
            ],
            'about' => [
                'title' => 'About Us - Grace Operated Life Ministry',
                'description' => 'Learn about our mission, vision, and beliefs at Grace Operated Life Ministry. Discover how we are transforming lives through faith.',
                'keywords' => 'about us, church mission, faith journey, Christian beliefs, ministry values',
                'image' => 'images/seo/about.jpg',
            ],
            'sermons' => [
                'title' => 'Inspirational Sermons - Grace Operated Life Ministry',
                'description' => 'Listen to powerful sermons and teachings that will deepen your faith and draw you closer to God. Explore our sermon archive.',
                'keywords' => 'sermons, gospel teachings, faith messages, Christian inspiration, Bible study',
                'image' => 'images/seo/sermons.jpg',
            ],
            'contact' => [
                'title' => 'Contact Us - Grace Operated Life Ministry',
                'description' => 'Reach out to us for prayer, support, or general inquiries. We are here to connect with you and support your faith journey.',
                'keywords' => 'contact church, prayer requests, Christian support, faith inquiries, ministry contact',
                'image' => 'images/seo/contact.jpg',
            ],
            'donation' => [
                'title' => 'Support Our Ministry - Grace Operated Life Ministry',
                'description' => 'Make a difference by supporting our mission. Your generous donation helps us reach more lives with the Gospel.',
                'keywords' => 'donate, church giving, Christian charity, tithes and offerings, ministry support',
                'image' => 'images/seo/donation.jpg',
            ],
            'ministry' => [
                'title' => 'Our Ministry - Grace Operated Life Ministry',
                'description' => 'Discover our ministries and how we serve our community through outreach, worship, and faith-based initiatives.',
                'keywords' => 'ministries, Christian service, outreach programs, church activities, faith community',
                'image' => 'images/seo/ministry.jpg',
            ],
            'prayer.form' => [
                'title' => 'Submit a Prayer Request - Grace Operated Life Ministry',
                'description' => 'Send us your prayer requests and let our prayer team stand in faith with you. Prayer changes things.',
                'keywords' => 'prayer request, faith support, intercession, spiritual breakthrough, Christian prayer',
                'image' => 'images/seo/prayer.jpg',
            ],
            'partnership' => [
                'title' => 'Partner with Us - Grace Operated Life Ministry',
                'description' => 'Join hands with us in spreading the Gospel. Partner with Grace Operated Life Ministry and be part of something bigger.',
                'keywords' => 'church partnership, faith collaboration, kingdom work, Christian missions, ministry partners',
                'image' => 'images/seo/partnership.jpg',
            ],
        ];

        foreach ($pages as $page => $data) {
            SeoSetting::updateOrCreate(
                ['page' => $page], // Match existing record by page
                [
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'keywords' => $data['keywords'],
                    // 'image' => $data['image'], // Ensure these images exist in storage/public
                ]
            );
        }

    }
}
