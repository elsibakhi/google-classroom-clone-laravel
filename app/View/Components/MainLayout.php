<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainLayout extends Component
{
    /**
     * Create a new component instance.
     */

protected $title; // if we set title to public instead of protected you can use title var in view without send it in view method bellow

    public function __construct($title="Classroom")
    {
      $this->title=$title; //to send attributes 
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.main',["title"=>$this->title]); // ---// if we set title to public instead of protected you can use title var in view without send it in view method bellow
    }
}
