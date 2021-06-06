@extends('layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="/styles/categories.css">
<link rel="stylesheet" type="text/css" href="/styles/categories_responsive.css">
@endsection
@section('custom-js')
<script src="/js/categories.js"></script>
@endsection




@section('title', 'Головна')
@section('content')
	<!-- Home -->

	<div class="home">
		<div class="home_container">
			<div class="home_background" style="background-image:url({{ $category->image }})"></div>
			<div class="home_content_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="home_content">
								<div class="home_title">{{ $category->title }}<span>.</span></div>
								<div class="home_text"><p>{{$category->desc}}</p></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Products -->

	<div class="products">
		<div class="container">
			<div class="row">
				<div class="col">

					<!-- Product Sorting -->
					<div class="col-md-12">

            <form method="get" action="{{ route('showCategory', ['cat'=>$category->alias]) }}">
            <div class="form-row">
           
        
            </div>


                <div class="form-row">
                <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="search" name="search_field" placeholder="Пошук">
                    </div>
                    <div class="form-group col-md-2">
                        <button type="submit" class="btn btn-dark btn-block">Пошук</button>
                    </div>
                </div>

            </form>

        </div>
                    <!-- Product Sorting -->
				</div>
			</div>
			<div class="row">
				<div class="col">

					<div class="product_grid">

                    @foreach($products as $product)
						@php
						    $image = '';
						    if(count($product->images)>0){

								$image = $product->images[0]['img'];
							} else $image = 'No_img.png'
						@endphp
						<!-- Product -->
						<div class="product">
							<div class="product_image"><img src="/images/{{$image}}" alt="{{ $product->title }}"></div>
							<div class="product_extra product_new"><a href="{{route('showCategory', ['cat'=>$product->category['alias']])}}">{{$product->category['title']}}</a></div>
							<div class="product_content">
								<div class="product_title"><a href="{{route('showProduct',['cat'=>$product->category->alias, 'alias'=>$product->alias])}}">{{ $product->title }}</a></div>
								@if($product->new_price != null)
								<div style="text-decoration: line-through; color: red;padding-top:5%;">${{ $product->price}}</div>
								<div class="product_price">${{ $product->new_price}}</div>
								@else
								<div class="product_price">${{ $product->price}}</div>
								@endif
							</div>
						</div>
						@endforeach
                        

					</div>
					<div class="product_pagination">
						{{ $products->withQueryString()->links() }}
					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- Icon Boxes -->

	<div class="icon_boxes">
		<div class="container">
			<div class="row icon_box_row">

				<!-- Icon Box -->
				<div class="col-lg-4 icon_box_col">
					<div class="icon_box">
						<div class="icon_box_image"><img src="images/icon_1.svg" alt=""></div>
						<div class="icon_box_title">Free Shipping Worldwide</div>
						<div class="icon_box_text">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
						</div>
					</div>
				</div>

				<!-- Icon Box -->
				<div class="col-lg-4 icon_box_col">
					<div class="icon_box">
						<div class="icon_box_image"><img src="images/icon_2.svg" alt=""></div>
						<div class="icon_box_title">Free Returns</div>
						<div class="icon_box_text">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
						</div>
					</div>
				</div>

				<!-- Icon Box -->
				<div class="col-lg-4 icon_box_col">
					<div class="icon_box">
						<div class="icon_box_image"><img src="images/icon_3.svg" alt=""></div>
						<div class="icon_box_title">24h Fast Support</div>
						<div class="icon_box_text">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_border"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="newsletter_content text-center">
						<div class="newsletter_title">Subscribe to our newsletter</div>
						<div class="newsletter_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros</p></div>
						<div class="newsletter_form_container">
							<form action="#" id="newsletter_form" class="newsletter_form">
								<input type="email" class="newsletter_input" required="required">
								<button class="newsletter_button trans_200"><span>Subscribe</span></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
	