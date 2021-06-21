@section('title','Order {{ $order->id }} Details')
<main style="margin:15vh 0">
    <style>
        .panel-heading{
            text-decoration: underline;
        }
    </style>
    <div class="container" style="padding: 30px 0;">
        
        <div class="row">
            <div class="col-md-6">
                Ordered Items
            </div>
            <div class="col-md-6">
                <a href="{{ route('admin.orders') }}" class="btn btn-success pull-right">All orders</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 style="text-align: center;">Order Details</h1>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>Order Id</th>
                                <td>{{ $order->id }}</td>
                                <th>Order Date</th>
                                <td>{{ $order->created_at }}</td>
                                <th>Order Status</th>
                                <td>{{ $order->status }}</td>
                                @if ($order->status == "delivered")
                                <th>Order Delivered Date</th>
                                <td>{{ $order->delivered_date }}</td>
                                @elseif ($order->status =="cancelled")
                                <th>Order Cancelation Date</th>
                                <td>{{ $order->cancelled_date }}</td>
                                @endif
                            </tr>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 style="text-align: center;">Order Items</h1>
                    </div>
                    <div class="panel-body">
                        
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product Id</th>
                                        <th>Product Price</th>
                                        <th>Product Quantity</th>
                                        <th>Subtotal</th>
                                        <th>Discount</th>
                                        <th>Tax</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $orderItem)
                                        <tr>
                                            <td>{{ $orderItem->product->id }}</td>
                                            <td>{{ $orderItem->product->price }}</td>
                                            <td>{{ $orderItem->quantity }}</td>
                                            <td>{{ $orderItem->price*$orderItem->quantity }}</td>
                                            <td>{{ $orderItem->order->discount }}</td>
                                            <td>21%</td>
                                            <td>{{ round($orderItem->price*$orderItem->quantity+(($orderItem->price*$orderItem->quantity)*0.21),2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 style="text-align: center;">Billing details</h1>
                    </div>
                    <div class="visual-panel-body">
                        <table class="table">
                            <tr>
                                <th>First Name</th>
                                <td>{{ $order->firstname }}</td>
                                <th>Last Name</th>
                                <td>{{ $order->lastname }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $order->mobile }}</td>
                                <th>Email</th>
                                <td>{{ $order->email }}</td>
                            </tr>
                            <tr>
                                <th>Adress line 1</th>
                                <td>{{ $order->adress_line_1 }}</td>
                                <th>Line 2</th>
                                <td>{{ $order->adress_line_2 }}</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>{{ $order->city }}</td>
                                <th>Province</th>
                                <td>{{ $order->province }}</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>{{ $order->country }}</td>
                                <th>Zipcode</th>
                                <td>{{ $order->zipcode }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 style="text-align: center;">Transaction details</h1>
                </div>
                <div class="visual-panel-body">
                    <table class="table">
                        <tr>
                            <th>User Id</th>
                            <td>{{ $transaction->user_id }}</td>
                            <th>User Name</th>
                            <td>{{ $order->firstname.' '.$order->lastname }}</td>
                        </tr>
                        <tr>
                            <th>Mode</th>
                            <td>{{ $transaction->mode }}</td>
                            <th>Status</th>
                            <td>{{ $transaction->status }}</td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>{{ $transaction->created_at }}</td>
                            <th>Order Id</th>
                            <td>{{ $transaction->order_id}}</td>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>