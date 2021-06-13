<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\ProductImage;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditProductImageComponent extends Component
{
    use WithFileUploads;
    public $product_id;
    public $image;
    public $image_id;

    public function mount($product_image_id){
        $product_image = ProductImage::find($product_image_id);
        $this->product_id = $product_image->product_id;
        $this->image = $product_image->image;
        $this->image_id = $product_image_id;
    }
    public function updateImage(){
        $this->validate([
        'product_id'=>'required',
        'image' => 'image',
        ]);
        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('public/uploads/productImages/', $imageName);
        $productImage = ProductImage::find($this->image_id);
        $productImage->img = $imageName;
        $productImage->product_id = $this->product_id;
        $productImage->save();
        session()->flash('message', 'Image updated successfully');
    }
    public function render()
    {
        $products = Product::all();
        return view('livewire.admin.admin-edit-product-image-component',['products' => $products])->extends('layouts.main')->section('content');
    }
}
