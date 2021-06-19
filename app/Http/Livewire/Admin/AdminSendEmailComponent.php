<?php

namespace App\Http\Livewire\Admin;

use App\Models\NewsSubscriber;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class AdminSendEmailComponent extends Component
{
    public $subject;
    public $mail;

    public function sendEmail(){
        $sub_list = NewsSubscriber::all(); 
        foreach($sub_list as $subscriber){
        Mail::send('email.default', array(
            'subject' => $this->subject,
            'mail' => $this->mail,
        ), function($message) use ($subscriber){
            $message->from('admin@admin.com');
            $message->to($subscriber->email)->subject($this->subject);
        });
        session()->flash('message', 'Emai sent successfully!');
    }



    }
    public function render()
    {
        return view('livewire.admin.admin-send-email-component')->extends('layouts.main')->section('content');
    }
}
