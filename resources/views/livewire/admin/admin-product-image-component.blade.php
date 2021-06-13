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
                            <div class="col-md-6">All Product Images</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <a href="{{ route('admin.addproductimage') }}" class="btn btn-success pull-right">Add New</a>
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
                                <th>Image</th>
                                <th>Product</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($images as $image)
                                <tr>
                                    <td>{{ $image->id }}</td>
                                    <td><img style="width:200px;" src="/storage/uploads/productImages/{{ $image->img }}"></td>
                                    <td>{{ $image->product->title }}</td>
                                    <td>
                                            <a href="{{ route('admin.editproductimage', ['product_image_id'=> $image->id]) }}"><i class="fa fa-edit fa-2x"></i></a>
                                            <a href="#" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click.prevent="deleteProductImage({{ $image->id }})" style="margin-left: 10px;"><i class="fa fa-times fa-2x text-danger"></i></a>
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                            {{$images->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>