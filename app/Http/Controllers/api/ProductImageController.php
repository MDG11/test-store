<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductImage::all();
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
            'img' => 'required|image',
            'product_id' => 'required|numeric'
        ]);
        $imageName = Carbon::now()->timestamp.'.'.$input['img']->extension();
        $input['img']->storeAs('public/uploads/productImages', $imageName);
        $input['img'] = $imageName;
        $image = new ProductImage($input);
        $image->save();
        return $image;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ProductImage::find($id);
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
        $input = $request->validate([
            'img' => 'filled',
            'product_id' => 'numeric'
        ]);
        if(isset($input['img'])){
        $imageName = Carbon::now()->timestamp.'.'.$input['img']->extension();
        $input['img']->storeAs('public/uploads/productImages', $imageName);
        $input['img'] = $imageName;
        }
        $image = ProductImage::find($id);
        $image->update($input);
        return $image;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return (ProductImage::destroy($id)) ? 'Has been deleted successfully!' : 'Something went wrong, check credentials.';
    }
}
