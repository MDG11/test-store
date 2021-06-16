@extends('layouts.main')

@section('title', 'Cart')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="styles/cart.css">
<link rel="stylesheet" type="text/css" href="styles/cart_responsive.css">
@endsection
@section('custom-js')
<script>
	var checkout_form = document.getElementById("delivery_form");

	document.getElementById("proceed_checkout").addEventListener("click", function () {
  		checkout_form.submit();
	});
</script>
<script src="js/cart.js"></script>
@endsection
@section('content')
	<!-- Home -->
	@if(Session::has('coupon_success__message'))
    	<div class="alert alert-success" role="alert">{{Session::get('coupon_success_message')}}</div>
    @endif
	@if (Session::has('stripe_error'))
		<div class="alert alert-danger" role="alert">{{ Session::get('stripe_error') }}</div>
	@endif
	
@if(count($cart_products))
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
										<li><a href="categories.html">Categories</a></li>
										<li>Shopping Cart</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Cart Info -->

	<div class="cart_info">
		<div class="container">
			<div class="row">
				<div class="col">
					<!-- Column Titles -->
					<div class="cart_info_columns clearfix">
						<div class="cart_info_col cart_info_col_product">Product</div>
						<div class="cart_info_col cart_info_col_price">Price</div>
						<div class="cart_info_col cart_info_col_quantity">Quantity</div>
						<div class="cart_info_col cart_info_col_total">Total</div>
					</div>
				</div>
			</div>

			@foreach($cart_products as $product)

			@php
					$image = '';
					if(isset($product->images)){
					$image = $product->images[0]['img'];
				} else $image = 'No_img.png'
			@endphp
			<div class="row cart_items_row">
				<div class="col">

					<!-- Cart Item -->
					<div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
						<!-- Name -->
						<div class="cart_item_product d-flex flex-row align-items-center justify-content-start">
							<div class="cart_item_image">
								<div><img src="/storage/uploads/productImages/{{ $image }}" alt=""></div>
							</div>
							<div class="cart_item_name_container">
								<div class="cart_item_name"><a href="{{ route('showProduct',['cat' => $products->find($product->id)->category->alias,'alias'=>$products->find($product->id)->alias]) }}">{{ $product->name }}</a></div>
								<div class="cart_item_edit"><a href="{{ route('cart.delete', ['cart_product_id' => $product->id]) }}">Delete Product</a></div>
							</div>
						</div>
						<!-- Price -->
						<div class="cart_item_price">{{ $product->price }}</div>
						<!-- Quantity -->
						<div class="cart_item_quantity">
							<div class="product_quantity_container">

									<div class="cart_item_price" style="margin-left: 6vw">{{ $product->qty }}</div>

							</div>
						</div>

						<!-- Total -->
						<div class="cart_item_total">{{ $product->price * $product->qty }}</div>
					</div>

				</div>

			</div>
			@endforeach
			<div class="row row_cart_buttons">
				<div class="col">
					<div class="cart_buttons d-flex flex-lg-row flex-column align-items-start justify-content-start">
						<div class="cart_buttons_right ml-lg-auto">
							<div class="button clear_cart_button"><a href="{{ route('clearCart') }}">Clear cart</a></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row row_extra">
				<div class="col-lg-4">

					<!-- Delivery -->
				<form method="POST" id="delivery_form" action="{{ route('checkout') }}">
					@csrf
					<div class="delivery">
						<div class="section_title">Shipping method</div>
						<div class="section_subtitle">Select the one you want</div>
						<div class="delivery_options">
							<label class="delivery_option clearfix">Next day delivery
								<input type="radio" value="4.99" name="delivery" required>
								<span class="checkmark"></span>
								<span class="delivery_price">$4.99</span>
							</label>
							<label class="delivery_option clearfix">Standard delivery
								<input type="radio" value="1.99" name="delivery">
								<span class="checkmark"></span>
								<span class="delivery_price">$1.99</span>
							</label>
							<label class="delivery_option clearfix">Personal pickup
								<input type="radio" value="0.00" checked="checked" name="delivery">
								<span class="checkmark"></span>
								<span class="delivery_price">Free</span>
							</label>
						</div>
					</div>
				</form>

					<!-- Coupon Code -->
					@if (!Cart::content()->first()->options->coupon_id)
						
					<div class="coupon">
						
						<div class="section_title">Coupon code</div>
						<div class="section_subtitle">Enter your coupon code</div>
						<div class="coupon_form_container">
						@if(Session::has('coupon_message'))
                            <div class="alert alert-danger" role="alert">{{Session::get('coupon_message')}}</div>
                        @endif
							<form action="{{ route('applyCoupon') }}" method="POST" id="coupon_form" class="coupon_form">
								@csrf
								<input type="text" name="couponCode" class="coupon_input" required="required">
								<button class="button coupon_button"><span>Apply</span></button>
							</form>
						</div>
					</div>
					@else
					<div class="coupon">
						
						<div class="section_title">Coupon code</div>
						<div class="section_subtitle">Your coupon code</div>
						<div class="coupon_form_container">
						@if(Session::has('coupon_message'))
                            <div class="alert alert-danger" role="alert">{{Session::get('coupon_message')}}</div>
                        @endif
							<form action="{{ route('cancelCoupon') }}" method="POST" id="coupon_form" class="coupon_form">
								@csrf

								<input readonly type="text" name="coupon_id" value="{{ Cart::content()->first()->options->coupon_id }}" class="coupon_input" required="required">
								<button class="button coupon_button"><span>Cancel coupon</span></button>
							</form>
						</div>
					</div>
					@endif
				</div>

				<div class="col-lg-6 offset-lg-2">
					<div class="cart_total">
						<div class="section_title">Cart total</div>
						<div class="section_subtitle">Final info</div>
						<div class="cart_total_container">
							<ul>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="cart_total_title">Tax</div>
									<div class="cart_total_value ml-auto">{{$cart_products->first()->taxRate}} %</div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
								<div class="cart_total_title">Pre-Total</div>
								<div class="cart_total_value ml-auto">{{$pretotal}}</div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="cart_total_title">Total</div>
									<div class="cart_total_value ml-auto">{{$cart_total}}</div>
								</li>
							</ul>
						</div>
						<div class="button checkout_button">
							@if (Auth::check())								
							<a id="proceed_checkout">Proceed to checkout</a>
							@else
							<a href="{{ route('login') }}">Proceed to checkout</a>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@else
	<div class="home">
		<div class="home_container">
			<div class="home_background" style="background-image:url(/images/cart.jpg)"></div>
			<div class="home_content_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="home_content">
								<div class="breadcrumbs">
									<ul>
										<li><a href="index.html">Home</a></li>
										<li><a href="categories.html">Categories</a></li>
										<li>Shopping Cart</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@if (!Session::has('stripe_success'))
	<h1 style="text-align:center;">No products in cart by now</h1>
	@else
	<h1 style="text-align:center;">Thank you for your order!</h1>
	@endif
	<div class="row row_cart_buttons">
				<div class="col">
					<div class="cart_buttons d-flex flex-lg-row flex-column align-items-start justify-content-start">
						<div class="button continue_shopping_button" style="margin-left:44vw;"><a href="{{route('showProducts')}}">Continue shopping</a></div>
						<div class="cart_buttons_right ml-lg-auto">
						</div>
					</div>
				</div>
			</div>
	@endif
@endsection
