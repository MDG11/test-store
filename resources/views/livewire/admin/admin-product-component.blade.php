<main style="margin-top:15vh;">
    <div>
        <style>
            nav svg{
                height: 20px;
            }
            nav .hidden{
                display: block !important;
            }
        </style>
        <div class="container" style="padding:30px 0;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="col-md-6">All Products</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <a href="{{ route('admin.addproduct') }}" class="btn btn-success pull-right">Add New</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                            @endif
                            <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Alias</th>
                                <th>Price</th>
                                <th>New Price</th>
                                <th>Description</th>
                                <th>Category name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->alias }}</td>
                                    <td>{{ $product->price}}</td>
                                    <td>
                                    @if (@isset($product->new_price))
                                       {{ $product->new_price}}
                                    @else
                                        No discount
                                    @endif
                                    </td>
                                    <td>{{ substr($product->description, 0, 50)}} ...</td>
                                    <td>{{ $product->category->title}}</td>
                                    <td>
                                            <a href="{{ route('admin.editproduct', ['product_alias'=> $product->alias]) }}"><i class="fa fa-edit fa-2x"></i></a>
                                            <a href="#" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click.prevent="deleteProduct({{ $product->id }})" style="margin-left: 10px;"><i class="fa fa-times fa-2x text-danger"></i></a>
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                            {{$products->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>