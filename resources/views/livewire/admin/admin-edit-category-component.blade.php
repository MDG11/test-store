@section('title','Edit Category')
<main style="margin-top:15vh;">

<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Edit Category <b>{{ $category_title }}</b>
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.categories')}}" class="btn btn-success">All Categories</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                    @endif
                        <form class="form-horizontal" wire:submit.prevent="updateCategory">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-4 control-label">Category Name</label>
                            <div class="col-md-4">
                                <input type="text" name="title" placeholder="Category Name" class="form-control input-md" wire:model="category_title" wire:keyup="generateslug" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Category Alias</label>
                            <div class="col-md-4">
                                <input type="text" name="alias" placeholder="Category Alias" class="form-control input-md" wire:title="category_alias">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Category Description</label>
                            <div class="col-md-4">
                                <textarea name="desc" placeholder="Category Desc" class="form-control input-md" wire:model="category_desc"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Category Image</label>
                            <div class="col-md-4">
                                <input type="file" name="image" placeholder="Category Image" class="form-control input-md" wire:model="category_image">
                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}" style="width:120px;"> 
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Update</button>
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