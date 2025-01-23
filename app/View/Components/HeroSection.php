<?php

namespace App\View\Components;

use Illuminate\View\Component;

class HeroSection extends Component
{
    public $title;
    public $subtitle;
    public $image;
    public $button;
    public $youtube;
    public $image2;

    // Constructor to accept the passed data
    public function __construct($title, $subtitle, $image, $image2, $button, $youtube)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->image = $image;
        $this->button = $button;
        $this->youtube = $youtube;
        $this->image2 = $image2;
    }

    // Render method to return the Blade view
    public function render()
    {
        return view('components.hero-section');
    }
}
