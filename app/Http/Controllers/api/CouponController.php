<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Coupon::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // [A-Z\d]{4}-[A-Z\d]{4}-[A-Z\d]{4}-[A-Z\d]{4}             REGEXP FOR CODE(DDDD-DDDD-DDDD-DDDD)
        // ([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))       DATE REGEXP(YYYY-MM-DD)
        $input = $request->validate([
            'code' => array(
                'required',
                'regex:/[A-Z\d]{4}-[A-Z\d]{4}-[A-Z\d]{4}-[A-Z\d]{4}/u'
            ),
            'type' => array(
                'required',
                'regex: /(fixed)|(percent)/u'
            ),
            'expiry_date' => array(
                'required',
                'regex: /([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/u'
            ),
            'value' => array(
                'required',
                'regex: /^\d+([,.]\d{1,2})?$/u'
            ),
            'cart_value' => array(
                'required',
                'regex: /^\d+([,.]\d{1,2})?$/u'
            )
        ]);
        $coupon = new Coupon($input);
        $coupon->save();
        return $coupon;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Coupon::find($id);
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
            'code' => array(
                'regex:/[A-Z\d]{4}-[A-Z\d]{4}-[A-Z\d]{4}-[A-Z\d]{4}/u'
            ),
            'type' => array(
                'regex: /(fixed)|(percent)/u'
            ),
            'expiry_date' => array(
                'regex: /([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/u'
            ),
            'value' => array(
                'regex: /^\d+([,.]\d{1,2})?$/u'
            ),
            'cart_value' => array(
                'regex: /^\d+([,.]\d{1,2})?$/u'
            )
        ]);
        $coupon = Coupon::find($id);
        $coupon->update($input);
        return $coupon;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return (Coupon::destroy($id)) ? 'Has been deleted successfully!' : 'Something went wrong, check credentials.';

    }
}
