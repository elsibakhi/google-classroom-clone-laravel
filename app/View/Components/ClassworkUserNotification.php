<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class ClassworkUserNotification extends Component
{
    /**
     * Create a new component instance.
     */

    public $notifications , $unreadNotificationsNumber;
    public function __construct()
    {
       $this->notifications = Auth::user()->notifications()->limit(5)->get();
        $this->unreadNotificationsNumber = Auth::user()->unReadNotifications()->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.classwork-user-notification');
    }
}
