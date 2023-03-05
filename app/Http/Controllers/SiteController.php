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
use App\Models\Marquee;
use App\Models\Notification;
use App\Models\Payment;
use App\Models\PostHasStudent;
use App\Models\User;
use App\Models\Withdraw;
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

  public function withdraw()
  {
      $data['datas'] = Payment::orderby('id', 'desc')->get();
      $wid['wid'] = Withdraw::get();
//      return $wid;

      return view('admin.cash.withdraw', $data, $wid);
  }


  public function marquee(){
      $data['datas'] = Marquee::get();
//      return $data;
      return view('layout.admin', $data);
  }



}
