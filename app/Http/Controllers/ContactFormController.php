<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }
    public function post(Request $request)
    {
        $input = $request->validate([
            'f_name' => 'required',
            'l_name' => 'required',
            'subject' => 'required',
            'mail' => 'required',
            'email' => 'required|email'
        ]);
        $contact = new Contact($input);
        Mail::send('email.contactMail', array(
            'name' => $input['f_name'].$input['l_name'],
            'email' => $input['email'],
            'subject' => $input['subject'],
            'mail' => $input['mail'],
        ), function($message) use ($input){
            $message->from($input['email']);
            $message->to('admin@admin.com', 'Admin')->subject($input['subject']);
        });

        $contact->save;
        return back()->with('message', 'We`ve got your email, wait for answer soon!');
    }
}
