@extends('user.components.customer_master')

@section('customer-content')
@php 
$orders = DB::table('order_bills')
    ->join('orders', 'order_bills.id_order', '=', 'orders.id_order')
    ->join('online_orders', 'order_bills.id_order', '=', 'online_orders.id_order')
    ->join('products', 'online_orders.id_product', '=', 'products.id_product')
    ->select('orders.*', 'products.name as name', 'products.price as price', 'products.id_product as id_product', 'products.image as image')
    ->where('order_bills.id_bill', $id_bill)
    ->get();
$bill = DB::table('bills')->where('id_bill', $id_bill)->first();
$status = 'Chờ xử lý';
if($bill->status == 1) {
    $status = 'Đang giao';
} else if($bill->status == 2) {
    $status = 'Hoàn thành';
} else if($bill->status == 3) {
    $status = 'Đã hủy';
}
@endphp
<div id="customer-order" class="col-lg-9">
    <div class="box">
        <h1>Đơn #{{ $id_bill }}</h1>
        <p class="lead">Đơn #{{ $id_bill }} đã đặt vào ngày <strong>{{ date("d/m/Y", strtotime($bill->created_at)) }}</strong> và trạng thái là <strong>{{ $status }}</strong>.</p>
        <p class="text-muted">Nếu bạn có bất kỳ câu hỏi nào, xin liên hệ tới <a href="#">contact us</a>, đơn vị của chúng tôi hoạt động 24/7.</p>
        <hr>
        <div class="table-responsive mb-4">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="2">Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Giảm giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td><a href="{{ route('get-product', $order->id_product) }}"><img src="{{ asset('images/product/'.$order->image) }}" alt="{{ $order->name }}"></a></td>
                        <td><a href="{{ route('get-product', $order->id_product) }}">{{ $order->name }}</a></td>
                        <td>{{ $order->amount }}</td>
                        <td>{{ number_format($order->price, 0, '', ',') }}</td>
                        <td>0.00</td>
                        <td>{{ number_format(floatval($order->price) * floatval($order->amount), 0, '', ',') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-right">Phí giao hàng</th>
                        <th>10,000 đ</th>
                    </tr>
                    <tr>
                        <th colspan="5" class="text-right">Tổng tiền</th>
                        <th>{{ number_format($bill->payment, 0, '', ',') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.table-responsive-->
        <!-- <div class="row addresses">
            <div class="col-lg-6">
                <h2>Invoice address</h2>
                <p>John Brown<br>13/25 New Avenue<br>New Heaven<br>45Y 73J<br>England<br>Great Britain</p>
            </div>
            <div class="col-lg-6">
                <h2>Shipping address</h2>
                <p>John Brown<br>13/25 New Avenue<br>New Heaven<br>45Y 73J<br>England<br>Great Britain</p>
            </div>
        </div> -->
    </div>
</div>
@endsection