<?php

namespace App\Http\Controllers;

use App\Mail\MyDemoMail;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;
use Mail;

class DepositeMailController extends Controller
{


    public static function sendbasicemail() {
        Mail::to('tiarmancr@gmail.com')
            ->send('tiarmancr@gmail.com');
        Mail::to('tiarmancr@gmail.com')
            ->send('tiarmancr@gmail.com');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function deposit_send_notify()
    {
        $mailData = [
            'title' => 'Mail from ItSolutionStuff.com',
            'url' => 'https://www.itsolutionstuff.com'
        ];

        Mail::to('tiarmancr@gmail.com')->send(new MyDemoMail($mailData));

        dd("Email is sent successfully.");
    }
}
