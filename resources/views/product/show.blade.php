@extends('layouts.main')
@section('custom-css')
    <link rel="stylesheet" type="text/css" href="/styles/product.css">
    <link rel="stylesheet" type="text/css" href="/styles/product_responsive.css">
    <link rel="stylesheet" type="text/css" href="/styles/product_comments.css">
@endsection
@section('custom-js')
    <script src="/js/product.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#tabs").tabs();
        });
        $(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(
                                placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#images_load').on('change', function() {
                imagesPreview(this, 'div.gallery');
            });
        });

    </script>
@endsection




@section('title', 'Головна')
@section('content')
    <!-- Home -->

    <div class="home">
        <div class="home_container">
            <div class="home_background" style="background-image:url(/images/categories.jpg)"></div>
            <div class="home_content_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="home_content">
                                <div class="home_title">Smart Phones<span>.</span></div>
                                <div class="home_text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus.
                                        Sed nec molestie eros. Sed viverra velit venenatis fermentum luctus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details -->
    @if (Session::has('success'))

        <div class="container">
            <div class="alert alert-success">

                {{ Session::get('success') }}

                @php
                    
                    Session::forget('success');
                    
                @endphp

            </div>
        </div>
    @endif

    <div class="product_details">
        <div class="container">
            <div class="row details_row">

                <!-- Product Image -->
                @php
                    $image = '';
                    if (count($product->images) > 0) {
                        $image = $product->images[0]['img'];
                    } else {
                        $image = 'No_img.png';
                    }
                @endphp
                <div class="col-lg-6">
                    <div class="details_image">
                        <div class="details_image_large"><img src="/storage/uploads/productImages/{{ $image }}"
                                alt="{{ $product->title }}">
                            <div class="product_extra product_new"><a href="/categories.html">New</a></div>
                        </div>
                        <div class="details_image_thumbnails d-flex flex-row align-items-start justify-content-between">
                            @if ($image == 'No_img.png')
                            @else
                                @foreach ($product->images as $img)
                                    @if ($loop->first)
                                        <div class="details_image_thumbnail active"
                                            data-image="/storage/uploads/productImages/{{ $img['img'] }}"><img
                                                src="/storage/uploads/productImages/{{ $img['img'] }}"
                                                alt="{{ $product->title }}"></div>
                                    @else
                                        <div class="details_image_thumbnail"
                                            data-image="/storage/uploads/productImages/{{ $img['img'] }}"><img
                                                src="/storage/uploads/productImages/{{ $img['img'] }}"
                                                alt="{{ $product->title }}"></div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Product Content -->
                <div class="col-lg-6">
                    <div class="details_content">
                        <div class="details_name">{{ $product->title }}</div>
                        @if ($product->new_price != null)
                            <div class="details_discount">${{ $product->price }}</div>
                            <div class="details_price">${{ $product->new_price }}</div>
                        @else
                            <div class="details_price">${{ $product->price }}</div>
                        @endif

                        <!-- In Stock -->
                        <div class="in_stock_container">
                            <div class="availability">Availability:</div>
                            @if ($product->in_stock == 1)
                                <span>In Stock</span>
                            @else
                                <span style="color:red;">Out of stock</span>
                            @endif
                        </div>
                        <div class="details_text">
                            <p>{{ $product->description }}</p>
                        </div>

                        <!-- Product Quantity -->
                        <form method="POST" id="addcart-form"
                            action="{{ route('cart.store', ['product_id' => $product->id]) }}">
                            @csrf
                            <div class="product_quantity_container">
                                <div class="product_quantity clearfix">
                                    <span>Qty</span>
                                    <input id="quantity_input" name="qty" type="text" pattern="[0-9]*" value="1" required>
                                    <div class="quantity_buttons">
                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i
                                                class="fa fa-chevron-up" aria-hidden="true"></i></div>
                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i
                                                class="fa fa-chevron-down" aria-hidden="true"></i></div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success"
                                    style="height: 6vh; width:10vw; margin-left:3vw; font-size:24px">Add to cart</button>
                            </div>
                        </form>
                        <!-- Share -->
                        <div class="details_share">
                            <span>Share:</span>
                            <ul>
                                <li><a href="/#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                <li><a href="/#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="/#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="/#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row description_row">
                <div class="col">
                    <div id="tabs" class="description_title_container">
                        <div class="row">
                            <ul>
                                <li style="float: left;" ;>
                                    <div class="description_title"><a style="text-decoration: none; color:#6c6a74;"
                                            href="#tabs-1">Description</a></div>
                                </li>
                                <li style="float: left;">
                                    <div class="reviews_title"><a href="#tabs-2">Reviews
                                            <span>({{ count($product->reviews) }})</span></a></div>
                                </li>
                            </ul>
                        </div>
                        <div id="tabs-1" class="description_text">
                            <p>{{ $product->description }}</p>
                        </div>
                        <div id="tabs-2">
                            @if (Session::has('comment-message'))
                                <div class="alert alert-success" role="alert">{{ Session::get('comment-message') }}</div>
                            @endif
                            @if (count($product->reviews))
                                <div class="container">
                                    <div class="be-comment-block">
                                        @foreach ($product->reviews as $review)
                                            <div class="be-comment">
                                                <div class="be-img-comment">
                                                    <p>
                                                        <img src="data:image/png;base64,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"
                                                            alt="" class="be-ava-comment">
                                                    </p>
                                                </div>
                                                <div class="be-comment-content">
                                                    <div class="be-comment-name">
                                                        <h2>{{ $review->username }}</h2>
                                                    </div>
                                                    <div class="be-comment-header">
                                                        <h3>{{ $review->header }}
                                                            @for ($i = 0; $i < $review->rate; $i++)
                                                                <i style="color:yellow"
                                                                    class="fa fa-star fa-sm pull-right"></i>
                                                            @endfor
                                                        </h3>
                                                    </div>
                                                    <div class="be-comment-rate">

                                                    </div>
                                                    <div class="be-comment-images">
                                                        @foreach ($review->images as $review_image)
                                                            <img onclick="window.open($(this)[0].src, '_blank')" style="padding-right:5px; cursor: pointer;" class="review_image"
                                                                src="/storage/uploads/reviewImages/{{ $review_image->img }}">
                                                        @endforeach
                                                    </div>
                                                    <p class="be-comment-text">
                                                        {{ $review->review_text }}
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                    @else
                                        <div>
                                            <h1 style="text-align: center;">No comments by now!</h1>
                                        </div>
                                    @endif
                            <form method="POST" action="{{ route('review.post', ['product_id' => $product->id]) }}"
                                style="padding-top:5vh;" class="form-block" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group fl_icon">
                                            <div class="icon"><i class="fa fa-user"></i></div>
                                            <input required name="username" class="form-input" type="text"
                                                placeholder="Your name">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 fl_icon">
                                        <div class="form-group">
                                            <input required name="header" class="form-input" type="text"
                                                placeholder="Review header">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <input name="images[]" class="form-input" id="images_load" type="file" multiple>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div id="loaded_images_preview">
                                        <div class="gallery"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea required name="body" class="form-input"
                                                placeholder="Your text"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" style="color: white;"
                                            class="btn btn-primary pull-right">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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
                <div class="col text-center">
                    <div class="products_title">Related Products</div>
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <div class="product_grid">
                        @for ($i=0;$i<4;$i++)
                        @php
                        if ($i==0) {
                            $id = rand(0 ,count($product->category->products)-4);
                        }
                        elseif($id<count($product->category->products)) {
                            $id++;
                        }
                        $similarProduct = $product->category->products[$id];
                        $image = '';
                            if (count($similarProduct->images) > 0) {
                                $image = $similarProduct->images[0]['img'];
                            } else {
                                $image = 'No_img.png';
                            }
                        @endphp
                        <!-- Product -->
                        <div class="product">
                            <div class="product_image"><img src="/storage/uploads/productImages/{{ $image }}" alt="{{ $similarProduct->title }}"></div>
                            <div class="product_extra product_new"><a href="{{ route('showCategory',['cat' => $similarProduct->category->alias]) }}">{{ $similarProduct->category->title }}</a></div>
                            <div class="product_content">
                                <div class="product_title"><a href="{{ route('showProduct',['cat' => $similarProduct->category->alias, 'alias' => $similarProduct->alias]) }}">{{ $similarProduct->title }}</a></div>
                                <div class="product_price">{{ $similarProduct->price }}</div>
                            </div>
                        </div>

                        @endfor
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
                        <div class="newsletter_text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec
                                molestie eros</p>
                        </div>
                        <div class="newsletter_form_container">
                            @if (Session::has('subscribed-message'))
                                <div class="alert alert-success">{{ Session::get('subscribed-message') }}</div>
                            @elseif (Session::has('subscriber'))
                                <div class="alert alert-danger">
                                    You are already subscribed, <a href="{{ route('subscription.stop', ['email' => Session::get('subscriber')]) }}">cancel subscription?</a>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('subscription.start') }}" id="newsletter_form" class="newsletter_form">
                                @csrf
                                <input type="email" name="email" class="newsletter_input" required>
                                <button class="newsletter_button trans_200" type="submit"><span>Subscribe</span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
