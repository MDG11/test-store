<?php

namespace App\Http\Controllers;

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
        dd($cat);
        return view('product.show', compact('product'));
    }
}
