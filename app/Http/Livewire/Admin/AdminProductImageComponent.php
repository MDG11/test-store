<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProductImage;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductImageComponent extends Component
{
    use WithPagination;
    public function deleteProductImage($id){
        $productImage = ProductImage::find($id);
        $productImage->delete();
        session()->flash('message','Product has been deleted successfully!');
    }
    public function render()
    {
        $images = ProductImage::paginate(10);
        return view('livewire.admin.admin-product-image-component',['images' => $images])->extends('layouts.main')->section('content');
    }
}
