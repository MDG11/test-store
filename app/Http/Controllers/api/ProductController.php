<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
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
            'price' => array(
                'required',
                'regex:/^\d+([,.]\d{1,2})?$/u'
            ),
            'new_price' => array(
                'regex:/^\d+([,.]\d{1,2})?$/u'
            ),
            'description' => 'required',
            'category_id' => 'required|numeric',
            'in_stock' => 'required|boolean',
        ]);
        $product = new Product($input);
        $product->save();
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
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
            'alias' => 'filled',
            'title' => 'filled',
            'price' => array(
                'regex:/^\d+([,.]\d{1,2})?$/u'
            ),
            'new_price' => array(
                'regex:/^\d+([,.]\d{1,2})?$/u'
            ),
            'description' => 'filled',
            'category_id' => 'numeric',
            'in_stock' => 'boolean',
        ]);
        $product = Product::find($id);
        $product->update($input);
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return (Product::destroy($id)) ? 'Has been deleted successfully!' : 'Something went wrong, check credentials.';
    }
}
