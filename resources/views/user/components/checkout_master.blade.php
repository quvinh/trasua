@extends('user.layouts.master')

@section('title')
Thanh toán
@endsection

@section('all')
<div id="all">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- breadcrumb-->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
                            <li aria-current="page" class="breadcrumb-item active">Thanh toán - @yield('checkout')</li>
                        </ol>
                    </nav>
                </div>
                @yield('checkout-content')
                <!-- /.col-lg-9-->
                <div class="col-lg-3">
                    <div id="order-summary" class="box">
                        <div class="box-header">
                            <h3 class="mb-0">Đơn đặt hàng</h3>
                        </div>
                        <p class="text-muted">Tiền giao hàng và sản phẩm dựa trên giá trị bạn nhập vào giỏ hàng.</p>
                        <div class="table-responsive">
                            @php 
                            $order = DB::table('online_orders')
                                ->join('orders', 'online_orders.id_order', '=', 'orders.id_order')
                                ->join('products', 'online_orders.id_product', '=', 'products.id_product')
                                ->select(DB::raw('SUM(orders.amount * products.price) as total'))
                                ->where([['orders.created_by', '=', Auth::user()->id], ['orders.status', '=', 0]])
                                ->pluck('total');
                            @endphp
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Thành tiền</td>
                                        <th>{{ number_format($order[0], 0, '', ',').' đ' }}</th>
                                    </tr>
                                    <tr>
                                        <td>Giao hàng</td>
                                        <th>10,000 đ</th>
                                    </tr>
                                    <tr>
                                        <td>VAT</td>
                                        <th>0.00</th>
                                    </tr>
                                    <tr class="total">
                                        <td>Tổng</td>
                                        <th style="color:brown;">{{ number_format(floatval($order[0] + 10000), 0, '', ',').'đ' }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-3-->
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js" integrity="sha512-jTgBq4+dMYh73dquskmUFEgMY5mptcbqSw2rmhOZZSJjZbD2wMt0H5nhqWtleVkyBEjmzid5nyERPSNBafG4GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('#phone').inputmask({'mask' : '999 999 9999'});
    })
</script>
@endsection