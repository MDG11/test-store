<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function placeOrder(Request $request){
        $request->validate([
            "f_name" => "required",
            "l_name" => "required",
            "checkout_country" => "required",
            "checkout_address" => "required",
            "zipcode" => "required",
            "checkout_city" => "required",
            "checkout_province" => "required",
            "phone" => "required|numeric",
            "email" => "required|email",
            "payment_method" => "required",
        ]);
        $total = floatval(str_replace(',','',Cart::total())); // convert cart total to comparable float 
        $subtotal = floatval(str_replace(',','',Cart::subtotal())); // convert cart total to comparable float 
        
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->subtotal = $subtotal;
        if(isset(Cart::content()->first()->options)){
            if(Cart::content()->first()->options->is_discounted){
            $discount = Coupon::find(Cart::content()->first()->options->coupon_id);
            $order->discount = $discount->value;
        }}else
        $order->discount = 0;
        $order->total = $total;
        $order->firstname = $request->f_name;
        $order->lastname = $request->l_name;
        $order->mobile = $request->phone;
        $order->email = $request->email;
        $order->adress_line_1 = $request->checkout_address;
        $order->adress_line_2 = $request->checkout_address_2;
        $order->city = $request->checkout_city;
        $order->province = $request->checkout_province;
        $order->country = $request->checkout_country;
        $order->zipcode = $request->zipcode;
        $order->save();


        foreach(Cart::content() as $cartItem){
            $orderItem = new OrderItem;
            $orderItem->product_id = $cartItem->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $cartItem->price;
            $orderItem->quantity = $cartItem->qty;
            $orderItem->save();
        }


        if($request->payment_method == 'cod'){
            $transaction = new Transaction();
            $transaction->user_id = Auth::user()->id;
            $transaction->order_id = $order->id;
            $transaction->mode = 'cod';
            $transaction->status = 'pending';
            $transaction->save();
            Cart::destroy();
            return redirect()->route('cart.index');
        }

        Cart::destroy();
    }
    public function index(){
        if(Cart::content()->first() != null)
        return view('checkout.index');
        else
        return redirect()->back()->with('message','No items in cart!');
    }
}
