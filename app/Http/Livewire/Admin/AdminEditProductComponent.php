<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class AdminEditProductComponent extends Component
{
    public $title;
    public $alias;
    public $description;
    public $price;
    public $new_price;
    public $stock;
    public $category_id;
    public $product_id;

    public function mount($product_alias){
        $product = Product::where('alias', $product_alias)->first();
        $this->title = $product->title;
        $this->alias = $product->alias;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->new_price = $product->new_price;
        $this->stock = $product->in_stock;
        $this->category_id = $product->category_id;
        $this->product_id = $product->id;
    }
    public function updateProduct(){
        $product = Product::find($this->product_id);
        $product->title = $this->title;
        $product->alias = $this->alias;
        $product->description = $this->description;
        $product->price = $this->price;
        $product->new_price = $this->new_price;
        $product->in_stock = $this->stock;
        $product->category_id = $this->category_id;
        $product->save();
        session()->flash('message','Product added successfully!');
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-edit-product-component',['categories'=>$categories])->extends('layouts.main')->section('content');
    }
}
