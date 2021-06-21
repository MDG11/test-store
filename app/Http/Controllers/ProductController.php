<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilter;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductReview as Review;
use App\Models\ProductReview;
use App\Models\ProductReviewImage as ReviewImage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jorenvh\Share\Share;

class ProductController extends Controller
{
    public function postReview(Request $request, $product_id){
        if(!Auth::check()){
            return redirect(route('login'));
        } 
        $review = new Review();
        $review->product_id = $product_id;
        $review->user_id = Auth::user()->id;
        $review->header = $request->header;
        $review->rate = $request->rate;
        $review->review_text = $request->body;
        $review->username = $request->username;
        $review->save();
        foreach($request->images as $index=>$image){
            $review_image = new ReviewImage();
            $review_image->product_review_id = $review->id;
            $imageName = Carbon::now()->timestamp.'_'.$index.'.'.$request->file('images')[$index]->extension();
            $image->storeAs('public/uploads/reviewImages', $imageName);
            $review_image->img = $imageName;
            $review_image->save();
        }
        return redirect()->back()->with('comment-message','Your comment was uploaded successfully!');
    }
    public function show($cat, $alias)
    {
        $users = User::all();
        $product = Product::where('alias', $alias)->first();
        return view('product.show', compact('product','users'));
    }
    public function showProducts(ProductFilter $request)
    {
        $category = Category::all();
        $products = Product::filter($request)->paginate(16);
        return view('allproducts.index', compact('category', 'products'));
    }
    public function showCategory(ProductFilter $request, $cat)
    {
        $category = Category::where('alias', $cat)->first();
        $file = $category->image;
        $file_headers = @get_headers($file);
        if (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
            $exists = false;
        } else {
            $exists = true;
        }
        $products = Product::filter($request)->where('category_id', $category->id)->paginate(16);
        return view('category.index', compact('category', 'products','exists'));
    }
    public function commentDelete($id)
    {   
        ProductReview::destroy($id);
        return back()->with('comment-message', 'Comment deleted successfully!');
    }
}
