<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Models\Contact;

class ContactController extends Controller
{
    // public function contactUs(Request $request)
    // {
        //     $validatedData = $request->validate([
            //         'name' => 'required',
            //         'email' => 'required',
            //         'phoneno' => 'required',
            //         'message' => 'required',
            //     ]);

            //     //Send Mail
            //     Mail::to('eadeseye@gmail.com')->send(new ContactMail($validatedData));
            //     // Mail::to('awoyemibabajide06@gmail.com')->send(new ContactMail($validatedData));
            //     return redirect()->back()->with('success', 'Your message has been sent successfully!');
            // }
            public function contactUs(Request $request)
            {
                $request->validate([
                    'name' => 'required',
                    'email' => 'required',
                    'phoneno' => 'required',
                    'message' => 'required',
                ]);

                Contact::create($request->all());

                return redirect()->back()
                ->with(['success' => 'Thank you for contact us. we will contact you shortly.']);
            }
        }
