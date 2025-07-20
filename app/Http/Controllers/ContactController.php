<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminNotification;
use App\Mail\UserConfirmation;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validate form input
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        // Prepare data
        $data = [
            'name'    => $request->input('name'),
            'email'   => $request->input('email'),
            'phone'   => $request->input('phone'),
            'message' => $request->input('message'),
        ];

        // Mail::to('shyamendrak5@gmail.com')->queue(new AdminNotification($data));
        // Mail::to($data['email'])->queue(new UserConfirmation($data));
        try {
        // Send mail to Admin
            Mail::to('shyamendrak5@gmail.com')->send(new AdminNotification($data));

            // Send confirmation to User
            Mail::to($data['email'])->send(new UserConfirmation($data));
            return back()->with('success', 'Your message has been sent successfully!');
        } catch (Exception $e) {
            return back()->with('error', 'Website mail is not configured properly yet. You can directly contact us by info@drbehlsisd.com!');
        }
        
    }
}

