<?php

namespace App\View\Components;

use App\Models\Plan;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class adminLayout extends Component
{
    /**
     * Create a new component instance.
     */

     public $plans,$statistics,$admin;
    public function __construct()
    {
        $this->plans = Plan::all();
        $this->admin = Auth::guard("admin")->user();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.admin');
    }
}
