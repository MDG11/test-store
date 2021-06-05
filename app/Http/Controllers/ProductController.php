<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilter;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($cat, $alias)
    {
        $product = Product::where('alias', $alias)->first();
        return view('product.show', compact('product'));
    }
    public function showProducts(ProductFilter $request)
    {
        $category = Category::all();
        $products = Product::filter($request)->paginate(16);
        return view('allproducts.index', compact('category', 'products'));
    }
    public function showCategory(ProductFilter $request, $cat)
    {
        $category = Category::where('alias',$cat)->first();
        $products = Product::filter($request)->where('category_id',$category->id)->paginate(16);
        return view('category.index', compact('category', 'products'));
    }
}
