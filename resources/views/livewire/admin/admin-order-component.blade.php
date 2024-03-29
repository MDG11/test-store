@section('title','Orders')
<div class="main" style="margin: 15vh 0;">
    <style>
        nav svg{
            height: 20px;
        }
        nav .hidden{
            display: block !important;
        }
    </style>
    <div>
        <div class="container" style="padding:30px 0">
            <div class="row">
                <div class="com-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All Orders
                        </div>
                        <div class="panel-body">
                            <div class="table table-striped">
                                @if (Session::has('order_message'))
                                    <div role="alert" class="alert alert-success">{{ Session::get('order_message') }}</div>
                                @endif
                             <table>
                                <thead>
                                    <tr>
                                        <th>OrderId</th>
                                        <th>Subtotal</th>
                                        <th>Discount</th>
                                        <th>Tax</th>
                                        <th>Total</th>
                                        <th>FIrst Name</th>
                                        <th>Last Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Zipcode</th>
                                        <th>Status</th>
                                        <th>Order Date</th>
                                        <th colspan="2" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->subtotal }}</td>
                                            <td>{{ $order->discount }}</td>
                                            <td>{{ $order->tax }}</td>
                                            <td>{{ $order->total }}</td>
                                            <td>{{ $order->firstname }}</td>
                                            <td>{{ $order->lastname }}</td>
                                            <td>{{ $order->mobile }}</td>
                                            <td>{{ $order->email }}</td>
                                            <td>{{ $order->zipcode }}</td>
                                            <td>{{ $order->status }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>
                                                <a class="btn btn-info btn-sm" href="{{ route('admin.orderdetails', ['order_id' => $order->id]) }}">Details</a>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success button-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                                        <span class="caret">Status</span></button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="" wire:click.prevent="updateOrderStatus({{ $order->id }}, 'delivered')">Delivered</a></li>
                                                            <li><a href="" wire:click.prevent="updateOrderStatus({{ $order->id }}, 'cancelled')">Cancelled</a></li>
                                                        </ul>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $orders->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
