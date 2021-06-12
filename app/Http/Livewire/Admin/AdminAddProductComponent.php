<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class AdminAddProductComponent extends Component
{
    public $title;
    public $alias;
    public $description;
    public $price;
    public $new_price;
    public $stock;
    public $category_id;

    public function addProduct(){
        $product = new Product();
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
        return view('livewire.admin.admin-add-product-component',['categories' => $categories])->extends('layouts.main')->section('content');
    }
}
