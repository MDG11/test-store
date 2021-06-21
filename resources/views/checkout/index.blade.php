@extends('layouts.main')
@section('title', 'Checkout')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="styles/checkout.css">
<link rel="stylesheet" type="text/css" href="styles/checkout_responsive.css">
@endsection
@section('custom-js')
<script src="js/checkout.js"></script>  
@endsection
@section('content')
<div class="home">
    <div class="home_container">
        <div class="home_background" style="background-image:url(images/cart.jpg)"></div>
        <div class="home_content_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="home_content">
                            <div class="breadcrumbs">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="cart.html">Shopping Cart</a></li>
                                    <li>Checkout</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Checkout -->

<div class="checkout">
    <div class="container">
        <div class="row">

            <!-- Billing Info -->
            <div class="col-lg-6">
                <div class="billing checkout_section">
                    <div class="section_title">Billing Address</div>
                    <div class="section_subtitle">Enter your address info</div>
                    <div class="checkout_form_container">
                        <form action="{{ route('order.place') }}" method="POST" id="checkout_form" class="checkout_form">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <!-- Name -->
                                    <label for="checkout_name">First Name*</label>
                                    <input type="text" name="f_name" id="checkout_name" class="checkout_input" required
                                    value="{{ (auth()->user()->personal == null) ? '' : auth()->user()->personal->first()->firstname }}">
                                </div>
                                <div class="col-xl-6 last_name_col">
                                    <!-- Last Name -->
                                    <label for="checkout_last_name">Last Name*</label>
                                    <input type="text" name="l_name" id="checkout_last_name" class="checkout_input" required
                                    value="{{ (auth()->user()->personal == null) ? '' : auth()->user()->personal->first()->lastname }}">
                                </div>
                            </div>
                            <div>
                                <!-- Country -->
                                <label for="checkout_country">Country*</label>
                                <input type="text" name="checkout_country" id="checkout_country" class="checkout_input" required
                                value="{{ (auth()->user()->personal == null) ? '' : auth()->user()->personal->first()->country }}">
                            </div>
                            <div>
                                <!-- Address -->
                                <label for="checkout_address">Address*</label>
                                <input type="text" id="checkout_address" name="checkout_address" class="checkout_input" required
                                value="{{ (auth()->user()->personal == null) ? '' : auth()->user()->personal->first()->adress_line_1 }}">
                                <input type="text" id="checkout_address_2" name="checkout_address_2" class="checkout_input checkout_address_2"
                                value="{{ (auth()->user()->personal == null) ? '' : auth()->user()->personal->first()->adress_line_2 }}">
                            </div>
                            <div>
                                <!-- Zipcode -->
                                <label for="checkout_zipcode">Zipcode*</label>
                                <input type="text" id="checkout_zipcode" name="zipcode" class="checkout_input" required
                                value="{{ (auth()->user()->personal == null) ? '' : auth()->user()->personal->first()->zipcode }}">
                            </div>
                            <div>
                                <!-- City / Town -->
                                <label for="checkout_city">City/Town*</label>
                                <input type="text" name="checkout_city" id="checkout_city" class="checkout_input" required
                                value="{{ (auth()->user()->personal == null) ? '' : auth()->user()->personal->first()->city }}">
                            </div>
                            <div>
                                <!-- Province -->
                                <label for="checkout_province">Province*</label>
                                <input type="text" name="checkout_province" id="checkout_province" class="checkout_input" required
                                value="{{ (auth()->user()->personal == null) ? '' : auth()->user()->personal->first()->province }}">
                            </div>
                            <div>
                                <!-- Phone no -->
                                <label for="checkout_phone">Phone no*</label>
                                <input type="phone" name="phone" id="checkout_phone" class="checkout_input" required
                                value="{{ (auth()->user()->personal == null) ? '' : auth()->user()->personal->first()->mobile }}">
                            </div>
                            <div>
                                <!-- Email -->
                                <label for="checkout_email">Email Address*</label>
                                <input type="email" name="email" id="checkout_email" class="checkout_input" required
                                value="{{ (auth()->user()->personal == null) ? '' : auth()->user()->personal->first()->email }}">
                            </div>
                    </div>
                </div>
            </div>

            <!-- Order Info -->

            <div class="col-lg-6">
                <div class="order checkout_section">
                    <div class="section_title">Your order</div>
                    <div class="section_subtitle">Order details</div>

                    <!-- Order details -->
                    <div class="order_list_container">
                        <div class="order_list_bar d-flex flex-row align-items-center justify-content-start">
                            <div class="order_list_title">Product</div>
                            <div class="order_list_value ml-auto">Total</div>
                        </div>
                        <ul class="order_list">
                            @foreach (Cart::instance()->content() as $cartItem)
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="order_list_title">{{ $cartItem->name }}</div>
                                <div class="order_list_value ml-auto">$ {{ $cartItem->price }}</div>
                            </li>
                            @endforeach
                            
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="order_list_title">Subtotal</div>
                                <div class="order_list_value ml-auto">$ {{ Cart::subtotal() }}</div>
                            </li>
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="order_list_title">Total</div>
                                <div class="order_list_value ml-auto">$ {{ Cart::total() }}</div>
                            </li>
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="order_list_title">Delivery</div>
                                <div class="order_list_value ml-auto">$ {{ Cart::instance('delivery')->content()->first()->price }}</div>
                            </li>
                        </ul>
                    </div>

                    <!-- Payment Options -->
                    <div class="payment">
                        <div class="payment_options">
                            <label class="payment_option clearfix">Paypal
                                <input type="radio" value="paypal" name="payment_method" required>
                                <span class="checkmark"></span>
                            </label>
                            <label class="payment_option clearfix">Cach on delivery
                                <input type="radio" value="cod" name="payment_method">
                                <span class="checkmark"></span>
                            </label>
                            <label class="payment_option clearfix">Credit/Debit card
                                <input type="radio" value="card" name="payment_method">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    @if ($errors->any())
                             <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                 </ul>
                             </div>
                    @endif
                    <!-- Order Text -->
                    <div class="order_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra temp or so dales. Phasellus sagittis auctor gravida. Integ er bibendum sodales arcu id te mpus. Ut consectetur lacus.</div>
                    <button type="submit" class="order_button btn btn-success">Place Order</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection