<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\NotificationHelper;
use App\Helper\RedirectHelper;
use App\Models\BackgroundImage;
use App\Models\District;
use App\Models\Division;
use App\Models\JobEvent;
use App\Models\jobFairHasParticipant;
use App\Models\Notification;
use App\Models\PostHasStudent;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SiteController extends Controller
{
  public function home()
  {

//      return $datas;
    return view('site.index');
  }



}
