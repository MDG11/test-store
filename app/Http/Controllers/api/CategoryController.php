<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'alias' => 'required',
            'title' => 'required',
            'desc' => 'required',
            'image' => 'required|image',
        ]);
        $imageName = Carbon::now()->timestamp.'.'.$input['image']->extension();
        $input['image']->storeAs('public/uploads/categoryImages', $imageName);
        $input['image'] = $imageName;
        $category = new Category($input);
        $category->save();
        return $category;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Category::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input=$request->validate([
            'alias' => 'filled',
            'title' => 'filled',
            'desc' => 'filled',
            'image' => 'image',  
        ]);
        $category = Category::find($id);
        $category->update($input);
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return (Category::destroy($id)) ? 'Has been deleted successfully!' : 'Something went wrong, check credentials.';
    }
}
