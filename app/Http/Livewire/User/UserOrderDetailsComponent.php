<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class UserOrderDetailsComponent extends Component
{
    public $order_id;

    public function mount($order_id){
        $this->order_id = $order_id;
    }
    public function render()
    {
        $order = Order::where('user_id',Auth::user()->id)->where('id',$this->order_id)->first();
        $transaction = Transaction::where('order_id',$order->id)->where('user_id',Auth::user()->id)->first();
        return view('livewire.user.user-order-details-component',['order' => $order,'transaction' => $transaction])->extends('layouts.main')->section('content');
    }
}
