<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\ProductImage;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddProductImageComponent extends Component
{
    use WithFileUploads;
    public $product_id;
    public $image;


    public function storeImage(){
        $this->validate([
        'product_id'=>'required',
        'image' => 'image',
        ]);
        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('public/uploads/productImages/', $imageName);
        $productImage = new ProductImage();
        $productImage->img = $imageName;
        $productImage->product_id = $this->product_id;
        $productImage->save();
        session()->flash('message', 'Image added successfully');
    }
    public function render()
    {
        $products = Product::all();
        return view('livewire.admin.admin-add-product-image-component',['products'=>$products])->extends('layouts.main')->section('content');
    }
}
