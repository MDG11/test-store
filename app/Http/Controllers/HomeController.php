<?php

namespace App\Http\Controllers;

use App\Models\NewsSubscriber;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function subscribe(Request $request){
        $validate = Validator::make($request->all(), [
            'email' => 'required|unique:news_subscribers,email'
        ]);
        if($validate->fails()){
        return redirect()->back()->with('subscriber',$request->email);
        } 
        $subscriber = new NewsSubscriber();
        $subscriber->email = $request->email;
        $subscriber->save();
        return redirect()->back()->with('subscribed-message','You`ve subscribed successfully.');
    }

    public function subscribeCancel($email){
        $subscriber = NewsSubscriber::where('email','=',$email)->first();
        $subscriber->delete();
        return redirect()->back()->with('subscribed-message','You`ve unsubscribed successfully.');
    }

    public function index() {
        $products = Product::orderBy('updated_at')->take(8)->get();
           
        return view('home.index', compact('products'));
    }
}
