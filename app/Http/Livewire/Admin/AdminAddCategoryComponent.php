<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class AdminAddCategoryComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $alias;
    public $desc;
    public $image;

    public function generateslug(){
        $this->alias = Str::slug($this->title);
    }
    public function storeCategory(){
        $this->validate([
            'title' => 'required',
            'image' => 'image',
            'desc' => 'required',
            'alias' => 'required',
        ]);
        $slug = Str::slug($this->alias);
        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('public/uploads/categoryImages', $imageName);
        $category = new Category();
        $category->title = $this->title;
        $category->alias = $slug;
        $category->desc = $this->desc;
        $category->image = $imageName;
        $category->save();
        session()->flash('message', 'Category added successfully');
    }
    public function render()
    {
        return view('livewire.admin.admin-add-category-component')->extends('layouts.main')->section('content');
    }
}
