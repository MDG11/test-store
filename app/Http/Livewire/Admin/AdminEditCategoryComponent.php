<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class AdminEditCategoryComponent extends Component
{
    use WithFileUploads;
    public $category_slug;
    public $category_id;
    public $category_title;
    public $category_alias;
    public $category_desc;
    public $category_image;

    public function mount($category_slug)
    {
        $this->category_slug = $category_slug;
        $category = Category::where('alias', $category_slug)->first();
        $this->category_id = $category->id;
        $this->category_title = $category->title;
        $this->category_desc = $category->desc;
        $this->category_image = $category->image;
    }
    public function generateslug()
    {
        $this->slug = Str::slug($this->category_title);
    }
    public function updateCategory(){
        $category = Category::find($this->category_id);
        $category->title = $this->category_title;
        $category->alias = $this->category_slug;
        $category->desc = $this->category_desc;
        $format = $this->category_image->getClientOriginalExtension();
        $name = time().'.'.$format;
        $file = $this->category_image->storeAs('public/uploads/categoryImages', $name);
        $new_path = substr($file, strpos($file, '/', 1));
        $category->image = '/storage'.$new_path;
        $category->save();
        session()->flash('message', 'Category has been updated successfully');
    }

    public function render()
    {

        return view('livewire.admin.admin-edit-category-component')->extends('layouts.main')->section('content');
    }
}
