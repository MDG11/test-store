<main style="margin-top:15vh;">

    <div>
        <div class="container" style="padding: 30px 0;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    Add New Product Image
                                </div>
                                <div class="col-md-6">
                                    <a href="{{route('admin.productimages')}}" class="btn btn-success">All Product Images</a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                        @endif
                            <form class="form-horizontal" wire:submit.prevent="storeImage">
                            @csrf
                            <div class="form-group">
                                <label class="col-md-12 control-label">Product</label>
                                <div class="col-md-6">
                                    <select required class="form-control" wire:model="product_id">
                                        <option value="">Select Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Image</label>
                                <div class="col-md-4">
                                    <input type="file" name="image" placeholder="Category Image" class="form-control input-md" wire:model="image">
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" style="width:120px;"> 
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>