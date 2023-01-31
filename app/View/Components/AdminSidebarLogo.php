<?php

namespace App\View\Components;

use App\Models\Institute;
use Illuminate\View\Component;

class AdminSidebarLogo extends Component {
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct() {
    //
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render() {
    $data['c_logo'] = '';
    if (auth()->user()->institute_id) {
      $data['c_logo'] = Institute::where('id', auth()->user()->institute_id)->value('photo');
    }
//      \Log::debug("C_ Logo", [$data]);;
    return view('components.admin-sidebar-logo', $data);
  }
}
