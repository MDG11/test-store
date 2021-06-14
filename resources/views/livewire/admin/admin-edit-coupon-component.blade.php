<main style="margin-top:15vh;">

    <div>
        <div class="container" style="padding: 30px 0;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    Edit Coupon
                                </div>
                                <div class="col-md-6">
                                    <a href="{{route('admin.coupons')}}" class="btn btn-success">All Coupons</a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                        @endif
                            <form class="form-horizontal" wire:submit.prevent="updateCoupon">
                            @csrf
                            <div class="form-group">
                                <label class="col-md-4 control-label">Coupon Code</label>
                                <div class="col-md-4">
                                    <input type="text" name="title" placeholder="Coupon Code" class="form-control input-md" wire:model="code">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <button class="btn btn-success col-md-12" wire:click.prevent="generateCouponCode">Generate Coupon Code</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Coupon Type</label>
                                <div class="col-md-4" wire:model="type">
                                    <select class="form-control">
                                        <option value="">Select</option>
                                        <option value="fixed">Fixed</option>
                                        <option value="percent">Percent</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Coupon Value</label>
                                <div class="col-md-4">
                                    <input type="text" name="title" placeholder="Coupon Value" class="form-control input-md" wire:model="value">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Cart Value</label>
                                <div class="col-md-4">
                                    <input type="text" name="title" placeholder="Cart Value" class="form-control input-md" wire:model="cart_value">
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