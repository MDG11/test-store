<?php

namespace App\Http\Controllers;

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
    public function showCategory($cat)
    {
        $category = Category::where('alias',$cat)->first();
        $products = Product::paginate(1);
        return view('category.index', compact('category', 'products'));
    }
}
