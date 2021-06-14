<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function applyCoupon(Request $request){
        $total = floatval(str_replace(',','',Cart::subtotal())); // convert cart total to comparable float 
        $coupon = Coupon::where('code','=',$request->couponCode)->where('cart_value','<=',$total)->first();
        if(!$coupon){
            return redirect()->back()->with('coupon_message','Invalid code!');
        }
        foreach(Cart::content() as $cartItem){
            if($cartItem->options->is_discounted){
                if($coupon->type == 'percent' && $cartItem->options->is_discounted == true){
                    Cart::update($cartItem->rowId, ['price' => (($cartItem->price/(100-$coupon->value))*100), 'options'=>['is_discounted' => false]]);
                    }elseif($cartItem->options->is_discounted == true)
                    {
                    Cart::update($cartItem->rowId, ['price' => ($cartItem->price+$coupon->value), 'options'=>['is_discounted' => false]]);
                    }
            }
            if($coupon->type == 'percent' && $cartItem->options->is_discounted != true){
            Cart::update($cartItem->rowId, ['price' => ($cartItem->price-(($cartItem->price*$coupon->value)/100)), 'options'=>['is_discounted' => true, 'coupon_id' => $coupon->id]]);
            }elseif($cartItem->options->is_discounted != true)
            {
            Cart::update($cartItem->rowId, ['price' => ($cartItem->price-$coupon->value), 'options'=>['is_discounted' => true, 'coupon_id' => $coupon->id]]);
            }
        }
        return redirect()->back()->with('coupon_success_message','Coupon applied successfully!');
    }
    public function cancelCoupon(Request $request){
        $coupon_id = $request->coupon_id;
        $coupon = Coupon::find($coupon_id);
        foreach(Cart::content() as $cartItem){
            if($coupon->type == 'percent' && $cartItem->options->is_discounted == true){
            Cart::update($cartItem->rowId, ['price' => (($cartItem->price/(100-$coupon->value))*100), 'options'=>['is_discounted' => false]]);
            }elseif($cartItem->options->is_discounted == true)
            {
            Cart::update($cartItem->rowId, ['price' => ($cartItem->price+$coupon->value), 'options'=>['is_discounted' => false]]);
            }
        }
        return redirect()->back()->with('coupon_success_message','Coupon cancelled successfully!');
    }
}
