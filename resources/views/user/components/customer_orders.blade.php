@extends('user.components.customer_master')

@section('customer-content')
@php 
$bills = DB::table('order_bills')
    ->join('orders', 'order_bills.id_order', '=', 'orders.id_order')
    ->select('order_bills.id_bill as id_bill')
    ->groupBy('id_bill')
    ->where('orders.created_by', Auth::user()->id)
    ->orderByDesc('id_bill')
    ->pluck('id_bill');
@endphp
<div id="customer-orders" class="col-lg-9">
    <div class="box">
        <h1>Đơn hàng của tôi</h1>
        <p class="lead">Hiển thị tất cả các đơn bạn đã đặt.</p>
        <p class="text-muted">Nếu bạn có bất kỳ câu hỏi nào, xin liên hệ tới <a href="#">contact us</a>, đơn vị của chúng tôi hoạt động 24/7.</p>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Đơn</th>
                        <th>Ngày</th>
                        <th>Thành tiền</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bills as $id)
                    @php 
                    $bill = DB::table('bills')->where('id_bill', $id)->first();
                    @endphp
                    <tr>
                        <th># {{ $bill->id_bill }}</th>
                        <td>{{ date("d/m/Y", strtotime($bill->created_at)) }}</td>
                        <td>{{ number_format($bill->payment, 0, '', ',').' đ' }}</td>
                        @if($bill->status == 0)
                        <td><span class="badge badge-warning">Chờ xác nhận</span></td>
                        @elseif($bill->status == 1)
                        <td><span class="badge badge-info">Đang giao</span></td>
                        @elseif($bill->status == 2)
                        <td><span class="badge badge-success">Hoàn thành</span></td>
                        @elseif($bill->status == 3)
                        <td><span class="badge badge-danger">Đã hủy</span></td>
                        @endif
                        <td><a href="{{ route('order-history', $bill->id_bill) }}" class="btn btn-primary btn-sm">Xem</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection