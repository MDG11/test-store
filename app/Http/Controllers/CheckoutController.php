<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
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
        $subtotal = floatval(str_replace(',','',Cart::subtotal())); // convert cart subtotal to comparable float 
        
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

        if($request->payment_method == 'card'){
            return view('checkout.card', compact('total','subtotal','order'));
        }

        Cart::destroy();
    }
    public function proceed_payment(Request $request, $order_id){
        $order = Order::find($order_id);
        $request->validate([
            "name" => "required",
            "number" => "required|numeric",
            "month" => "required|numeric",
            "year" => "required|numeric",
            "cvv" => "required|numeric",
        ]);
        $stripe = Stripe::make(env('STRIPE_KEY'));
        
        
        try{
            $token = $stripe->tokens()->create([
                'card'=>[
                    "name" => $request->name,
                    "number" => $request->number,
                    "exp_month" => $request->month,
                    "exp_year" => $request->year,
                    "cvc" => $request->cvv,
                ]
            ]);

            if(!isset($token['id'])){
                redirect()->back()->with('stripe_error','The stripe token was not generated correctly!');
            }

            $customer = $stripe->customers()->create([
                'name' => $request->name,
                'email' => $order->email,
                'address' => [
                    'line1' => $order->adress_line_1,
                    'line2' => $order->adress_line_2,
                    'postal_code' => $order->zipcode,
                    'city' => $order->city,
                    'state' => $order->province,
                    'country' => $order->country,
                ],
                'shipping' => [
                    'name' => $request->name,
                    'address' => [
                        'line1' => $order->adress_line_1,
                        'line2' => $order->adress_line_2,
                        'postal_code' => $order->zipcode,
                        'city' => $order->city,
                        'state' => $order->province,
                        'country' => $order->country,
                    ],
                ],
                'source' => $token['id']
            ]);
        $total = floatval(str_replace(',','',Cart::total())); // convert cart total to comparable float 

            $charge = $stripe->charges()->create([
                'customer' => $customer['id'],
                'currency' => 'USD',
                'amount' => $total,
                'description' => 'Payment for order #'.$order_id,
            ]);
            if($charge['status'] == 'succeeded'){
                $transaction = new Transaction();
                $transaction->user_id = Auth::user()->id;
                $transaction->order_id = $order_id;
                $transaction->mode = 'card';
                $transaction->status = 'approved';
                $transaction->save();
                Cart::destroy();
                return redirect(route('thankyou'));
            }
            else{
                return redirect(route('cart.index'))->with('stripe_error', 'Payment didn`t succedd?)');
            }  
        }
        catch(Exception $e){
            return redirect(route('cart.index'))->with('stripe_error',$e->getMessage());
        }
    }
    public function thank(){
        return view('checkout.thank-you');
    }
    public function index(Request $request){
        if(!Cart::instance('delivery')->content()->first())
        Cart::instance('delivery')->add('delivery','delivery',1,$request->delivery);
        else{
        Cart::instance('delivery')->update(Cart::instance('delivery')->content()->first()->rowId, ['price'=>$request->delivery]);
        }
        if(Cart::content()->first() != null)
        return view('checkout.index');
        else
        return redirect()->back()->with('message','No items in cart!');
    }
    public function card(){
        return view('checkout.card');
    }
}
