<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MinistryCard extends Component
{


    public $title;
    public $image;
    public $description;
    public $link;
    public $readmore;
    /**
     * Create a new component instance.
     */
    public function __construct($title, $readmore, $image, $description, $link)
    {
        $this->title = $title;
        $this->readmore = $readmore;
        $this->image = $image;
        $this->description = $description;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ministry-card');
    }
}
