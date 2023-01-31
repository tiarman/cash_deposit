<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\SendDemoMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendDemoMail(User $user)
    {
        $email = 'positronx@gmail.com';

        $maildata = [
            'title' => 'Laravel Mail Sending Example with Markdown',
            'url' => 'https://www.positronx.io'
        ];

        Mail::to($email)->send(new SendDemoMail($maildata));

     echo "Mail has been sent successfully". $user->email;
    }
}


//
//public function sendDemoMail()
//{
//    $email = 'positronx@gmail.com';
//
//    $maildata = [
//        'title' => 'Laravel Mail Sending Example with Markdown',
//        'url' => 'https://www.positronx.io'
//    ];
//
//    Mail::to($email)->send(new SendDemoMail($maildata));
//
//    echo "Mail has been sent successfully";
//}
