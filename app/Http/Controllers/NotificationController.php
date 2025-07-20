<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Services\TwilioService;

class NotificationController extends Controller
{
    protected $twilio;

    public function __construct(TwilioService $twilio)
    {
        $this->twilio = $twilio;
    }

    public function index()
    {
        return view('notifications.index');
    }

    public function send(Request $request)
    {
        $message = $request->input('message');
        $phone = $request->input('phone');
        $email = $request->input('email');

        if ($phone) {
            $this->twilio->sendWhatsAppMessage($phone, $message);
        }

        if ($email) {
            Mail::raw($message, function ($msg) use ($email) {
                $msg->to($email)->subject('Notification');
            });
        }

        return redirect()->back()->with('success', 'Notification sent!');
    }
}
