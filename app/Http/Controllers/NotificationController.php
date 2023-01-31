<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{



  /**
   * @param $id
   * @return string|void
   */
  public function ajaxUpdateAsRead($id = null) {
      $notification = Notification::where('id', $id)->where('user_id', auth()->id())->first();
      if ($notification && $notification->update(['is_read' => true])) {
        return "success";
      }
  }
}
