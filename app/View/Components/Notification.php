<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Notification extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
      $data['notifications'] = \App\Models\Notification::where('user_id', auth()->id())
//        ->where('is_read', false)
        ->orderby('id', 'DESC')->take(100)->get();
      $data['unReadNotification'] = \App\Models\Notification::where('user_id', auth()->id())->where('is_read', false)->count();
      return view('components.notification', $data);
    }
}
