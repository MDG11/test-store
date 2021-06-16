<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart_products = Cart::content();
        $cart_total = Cart::total();
        $products = Product::all();
        $pretotal = 0;
        foreach($cart_products as $product) $pretotal += $product->price;
        $pretotal = number_format($pretotal, 2, ',', '.');
        return view('cart.index', compact('cart_products','cart_total','pretotal','products'));
    }
    public function addToCart(Request $request, $product_id){
        $currentprod = Product::where('id',$product_id)->first();
        $price = 0;
        if(!isset($currentprod->new_price)){
            $price = $currentprod->price;
        } else $price = $currentprod->new_price;
        Cart::add($currentprod->id, $currentprod->title, $request->qty, $price, ['is_discounted' => false]);
        foreach(Cart::content() as $cartItem)
        {
            $coupon = Coupon::find($cartItem->options->coupon_id);
        if($coupon){
            if($coupon->type == 'percent' && $cartItem->options->is_discounted == true){
                Cart::update($cartItem->rowId, ['price' => (($cartItem->price/(100-$coupon->value))*100), 'options'=>['is_discounted' => false]]);
                }elseif($cartItem->options->is_discounted == true)
                {
                Cart::update($cartItem->rowId, ['price' => ($cartItem->price+$coupon->value), 'options'=>['is_discounted' => false]]);
                }
            }
        }
        return redirect()->back()->with(['success' => 'Product Added To Cart Successfully']);

    }
    public function clearCart(){
        Cart::destroy();
        return redirect()->back()->with(['success' => 'Product Added To Cart Successfully']);
    }
    public function deleteFromCart($cart_product_id)
    {
        $cart_items = Cart::content();
        $cart_row = $cart_items->where('id',basename($_SERVER['REQUEST_URI']))->first()->rowId;
        Cart::remove($cart_row);
        return redirect()->back();
    }
}
