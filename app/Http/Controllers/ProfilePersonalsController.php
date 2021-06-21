<?php

namespace App\Http\Controllers;

use App\Models\UserPersonal;
use Illuminate\Http\Request;

class ProfilePersonalsController extends Controller
{
    public function index()
    {
        return view('personals.index');
    }
    public function create(Request $request)
    {
        $personal = new UserPersonal($request->only(['firstname', 'lastname', 'mobile', 'email', 'adress_line_1', 'adress_line_2', 'province', 'country', 'zipcode']));
        $personal->user_id = auth()->id();
        $personal->save();
        return back()->with('message', 'Your profile was updated successfully!');
    }
    public function update(Request $request)
    {
        $input =$request->only(['firstname', 'lastname', 'mobile', 'email', 'adress_line_1', 'adress_line_2', 'province', 'country', 'zipcode']);
        $personal = UserPersonal::where('user_id', auth()->id())->first();
        $personal->update($input);
        return back()->with('message', 'Your profile was updated successfully!');
    }
}
