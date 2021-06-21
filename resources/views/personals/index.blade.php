@extends('layouts.main')
@section('title', 'Edit Profile')
@section('content')
<main style="margin: 15vh 0">
    <div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 style="text-align: center">Edit User Personals</h1>
        </div>
        <div class="panel-body">
            @if (Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
            @if(auth()->user()->personal != null)
            <form action="{{ route('profile.update') }}" method="POST">
                @method('PUT')
                @else
            <form action="{{ route('profile.create') }}" method="POST">
                @endif
                @csrf
                <div class="form-group">
                    <label class="col-md-12 control-label">First Name</label>
                    <div class="col-md-12">
                        <input  name="firstname" type="text" placeholder="{{ (auth()->user()->personal == null) ? 'First Name' : auth()->user()->personal->first()->firstname }}" 
                        value="{{ (auth()->user()->personal == null) ? '' : auth()->user()->personal->first()->firstname }}" class="form-control input-md">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 control-label">Last Name</label>
                    <div class="col-md-12">
                        <input  name="lastname" type="text" placeholder="{{ (auth()->user()->personal == null) ? 'Last Name' : auth()->user()->personal->first()->lastname }}" 
                        value="{{ (auth()->user()->personal == null) ? '' : auth()->user()->personal->first()->lastname }}" class="form-control input-md">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 control-label">Mobile</label>
                    <div class="col-md-12">
                        <input  name="mobile" type="text" placeholder="{{ (auth()->user()->personal == null) ? 'Phone' : auth()->user()->personal->first()->mobile }}"
                        value="{{ (auth()->user()->personal == null) ? '' : auth()->user()->personal->first()->mobile }}" class="form-control input-md">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 control-label">E-Mail</label>
                    <div class="col-md-12">
                        <input  name="email" type="email" placeholder="{{ (auth()->user()->personal == null) ? 'Email' : auth()->user()->personal->first()->email }}"
                        value="{{ (auth()->user()->personal == null) ? '' : auth()->user()->personal->first()->email }}" class="form-control input-md">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 control-label">Adress line 1</label>
                    <div class="col-md-12">
                        <input  name="adress_line_1" type="text" placeholder="{{ (auth()->user()->personal == null) ? 'Adress' : auth()->user()->personal->first()->adress_line_1 }}"
                        value="{{ (auth()->user()->personal == null) ? '' : auth()->user()->personal->first()->adress_line_1 }}" class="form-control input-md">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 control-label">Adress line 2</label>
                    <div class="col-md-12">
                        <input  name="adress_line_2" type="text" placeholder="{{ (auth()->user()->personal == null) ? '' : auth()->user()->personal->first()->adress_line_2 }}"
                        value="{{ (auth()->user()->personal == null) ? '' : auth()->user()->personal->first()->adress_line_2 }}" class="form-control input-md">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 control-label">City</label>
                    <div class="col-md-12">
                        <input  name="city" type="text" placeholder="{{ (auth()->user()->personal == null) ? 'City' : auth()->user()->personal->first()->city }}"
                        value="{{ (auth()->user()->personal == null) ? '' : auth()->user()->personal->first()->city }}" class="form-control input-md">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 control-label">Province</label>
                    <div class="col-md-12">
                        <input  name="province" type="text" placeholder="{{ (auth()->user()->personal == null) ? 'Province' : auth()->user()->personal->first()->province }}"
                        value="{{ (auth()->user()->personal == null) ? '' : auth()->user()->personal->first()->province }}" class="form-control input-md">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 control-label">Country</label>
                    <div class="col-md-12">
                        <input  name="country" type="text" placeholder="{{ (auth()->user()->personal == null) ? 'Country' : auth()->user()->personal->first()->country }}"
                        value="{{ (auth()->user()->personal == null) ? '' : auth()->user()->personal->first()->country }}" class="form-control input-md">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 control-label">Zipcode</label>
                    <div class="col-md-12">
                        <input  name="zipcode" type="numeric" placeholder="{{ (auth()->user()->personal == null) ? 'Name' : auth()->user()->personal->first()->zipcode }}"
                        value="{{ (auth()->user()->personal == null) ? '' : auth()->user()->personal->first()->zipcode }}" class="form-control input-md">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 control-label"></label>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primaty">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</main>
@endsection