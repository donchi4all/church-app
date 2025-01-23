<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SermonCard extends Component
{
    public $title;
    public $date;
    public $pastor;
    public $image;
    public $description;
    public $link;

    // Constructor to accept data from the Blade view
    public function __construct($title, $date, $pastor, $image, $description, $link)
    {
        $this->title = $title;
        $this->date = $date;
        $this->pastor = $pastor;
        $this->image = $image;
        $this->description = $description;
        $this->link = $link;
    }

    // Render the view for the sermon card
    public function render()
    {
        return view('components.sermon-card');
    }
}
