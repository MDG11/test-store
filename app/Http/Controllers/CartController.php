<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart_products = Cart::content();
        $cart_total = Cart::total();
        $pretotal = 0;
        foreach($cart_products as $product) $pretotal += $product->price;
        $pretotal = number_format($pretotal, 2, ',', '.');
        return view('cart.index', compact('cart_products','cart_total','pretotal'));
    }
    public function addToCart($product_id){
        $currentprod = Product::where('id',$product_id)->first();
        $price = 0;
        if(!isset($currentprod->new_price)){
            $price = $currentprod->price;
        } else $price = $currentprod->new_price;
        Cart::add($currentprod->id, $currentprod->title, 1, $price);

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
