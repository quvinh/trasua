@extends('user.components.checkout_master')

@section('checkout')
Tổng quan
@endsection

@section('checkout-content')
<div id="checkout" class="col-lg-9">
    <div class="box">
        <form method="post" action="{{ route('progress-order') }}">
            @csrf
            <h1>Thanh toán - Tổng quan</h1>
            <div class="nav flex-column flex-md-row nav-pills text-center"><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-map-marker"> </i>Địa chỉ</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-truck"> </i>Giao hàng</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-money"> </i>Thanh toán</a><a href="#" class="nav-link flex-sm-fill text-sm-center active"> <i class="fa fa-eye"> </i>Tổng quan</a></div>
            <div class="content">
                @php
                $totalPrice = 0;
                $count = DB::table('orders')->select(DB::raw('SUM(amount) as amount'))->where([['created_by', '=', Auth::user()->id], ['status', '=', 0]])->first()->amount;
                $orders = DB::table('online_orders')
                ->join('orders', 'online_orders.id_order', '=', 'orders.id_order')
                ->join('products', 'online_orders.id_product', '=', 'products.id_product')
                ->select('products.id_product as id_product', 'products.image as image', 'products.name as name', 'orders.amount as amount', 'orders.id_order as id_order', 'products.price as price')
                ->where([['orders.created_by', '=', Auth::user()->id], ['orders.status', '=', 0]])
                ->get();
                @endphp
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2">Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Giảm giá</th>
                                <th colspan="2">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            @php
                            $total = floatval($order->amount) * floatval($order->price);
                            $totalPrice += floatval($total);
                            @endphp
                            <tr>
                                <td><a href="#"><img src="{{ asset('images/product/'.$order->image) }}" alt="IMAGE"></a></td>
                                <td><a href="#">{{ $order->name }}</a></td>
                                <td>
                                    {{ $order->amount }}
                                    <input type="number" name="amount[]" value="{{ $order->amount }}" hidden>
                                    <input type="number" name="id_order[]" value="{{ $order->id_order }}" hidden>
                                    <input type="number" name="price[]" value="{{ $order->price }}" hidden>
                                </td>
                                <td>{{ number_format($order->price, 0, '', ',') }}</td>
                                <td>0.00</td>
                                <td colspan="2">{{ number_format($total, 0, '', ',') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5">Tổng tiền</th>
                                <th colspan="2">{{ number_format($totalPrice, 0, '', ',').' đ' }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.table-responsive-->
            </div>
            <!-- /.content-->
            <div class="box-footer d-flex justify-content-between"><a href="{{ route('checkout-payment') }}" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i>Trở lại Thanh toán</a>
                <button type="submit" name="action" value="checkout" class="btn btn-primary">Đặt hàng<i class="fa fa-chevron-right"></i></button>
            </div>
        </form>
    </div>
    <!-- /.box-->
</div>
@endsection