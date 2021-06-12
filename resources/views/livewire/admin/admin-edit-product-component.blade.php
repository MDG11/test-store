<main style="padding: 20vh 0px">
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if(Session::has('message'))
                                <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                            @endif
                        <div class="row">
                            <div class="col-md-6">
                                Edit Product
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.products') }}" class="btn btn-success pull-right">All products</a>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" enctype="multipart/form-data" wire:submit.prevent="updateProduct">
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Product Title</label>
                                        <div class="col-md-12">
                                            <input required type="text" placeholder="Product Title" class="form-control input-md" wire:model="title">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Product Alias</label>
                                        <div class="col-md-12">
                                            <input required type="text" placeholder="Product Alias" class="form-control input-md" wire:model="alias">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Description</label>
                                        <div class="col-md-12">
                                            <textarea required placeholder="Product Description" class="form-control input-md" wire:model="description"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Product Price</label>
                                        <div class="col-md-12">
                                            <input required type="text" placeholder="Product Price (Format: 9999.99)" pattern='^\d+(?:\.\d{0,2})$' class="form-control input-md" wire:model="price">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Sale price</label>
                                        <div class="col-md-12">
                                            <input required type="text" placeholder="Sale price (Format: 9999.99)" pattern='^\d+(?:\.\d{0,2})$' class="form-control input-md" wire:model="new_price">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Category</label>
                                        <div class="col-md-12">
                                            <select required class="form-control" wire:model="category_id">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">In stock</label>
                                        <div class="col-md-12">
                                            <select required class="form-control" wire:model="stock">
                                                <option value="1">InStock</option>
                                                <option value="0">Out of stock</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label"></label>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primaty">Update</button>
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
</main>