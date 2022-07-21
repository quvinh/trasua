@extends('user.layouts.master')

@section('title')
Giỏ hàng
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
                            <li aria-current="page" class="breadcrumb-item active">Giỏ hàng</li>
                        </ol>
                    </nav>
                </div>
                <div id="basket" class="col-lg-9">
                    <div class="box">
                        <form method="post" action="{{ route('progress-order') }}">
                            @csrf
                            <h1>Giỏ hàng</h1>
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
                            <p class="text-muted">{{ $count }} sản phẩm trong giỏ hàng.</p>
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
                                                <input type="number" name="amount[]" value="{{ $order->amount }}" class="form-control">
                                                <input type="number" name="id_order[]" value="{{ $order->id_order }}" hidden>
                                                <input type="number" name="price[]" value="{{ $order->price }}" hidden>
                                            </td>
                                            <td>{{ number_format($order->price, 0, '', ',') }}</td>
                                            <td>0.00</td>
                                            <td>{{ number_format($total, 0, '', ',') }}</td>
                                            <td>
                                                <a href="{{ route('remove-order', $order->id_product) }}"><i class="fa fa-trash-o"></i></a>
                                            </td>
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
                            <div class="box-footer d-flex justify-content-between flex-column flex-lg-row">
                                <div class="left"><a href="{{ route('category') }}" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> Tiếp tục Shopping</a></div>
                                <div class="right">
                                    <button type="submit" class="btn btn-outline-secondary" name="action" value="update-order"><i class="fa fa-refresh"></i> Cập nhật giỏ hàng</button>
                                    <!-- <button type="submit" class="btn btn-primary" name="action" value="checkout">Thanh toán <i class="fa fa-chevron-right"></i></button> -->
                                    <a href="{{ route('checkout-order') }}" type="button" class="btn btn-primary">Thanh toán <i class="fa fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-->
                    <div class="row same-height-row">
                        <div class="col-lg-3 col-md-6">
                            <div class="box same-height">
                                <h3>Những sản phẩm bạn có thể thích</h3>
                            </div>
                        </div>
                        @php 
                        $products = DB::table('products')->orderByDesc('id_product')->take(3)->get();
                        @endphp
                        @foreach($products as $product)
                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front"><a href="{{ route('get-product', $product->id_product) }}"><img src="{{ asset('images/product/'.$product->image) }}" alt="" class="img-fluid"></a></div>
                                        <div class="back"><a href="{{ route('get-product', $product->id_product) }}"><img src="{{ asset('images/product/'.$product->image) }}" alt="" class="img-fluid"></a></div>
                                    </div>
                                </div><a href="{{ route('get-product', $product->id_product) }}" class="invisible"><img src="{{ asset('images/product/'.$product->image) }}" alt="" class="img-fluid"></a>
                                <div class="text">
                                    <h3>{{ $product->name }}</h3>
                                    <p class="price">{{ number_format($product->price, 0, '', ',').' đ' }}</p>
                                </div>
                            </div>
                            <!-- /.product-->
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.col-lg-9-->
                <div class="col-lg-3">
                    <div id="order-summary" class="box">
                        <div class="box-header">
                            <h3 class="mb-0">Đơn đặt hàng</h3>
                        </div>
                        <p class="text-muted">Tiền giao hàng và sản phẩm dựa trên giá trị bạn nhập vào giỏ hàng.</p>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Thành tiền</td>
                                        <th>{{ number_format($totalPrice, 0, '', ',').' đ' }}</th>
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
                                        <th style="color:brown;">{{ number_format(floatval($totalPrice + 10000), 0, '', ',').'đ' }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <h4 class="mb-0">Voucher code</h4>
                        </div>
                        <p class="text-muted">Nếu bạn có mã giảm giá, vui lòng điền vào form bên dưới.</p>
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Làm gì có..."><span class="input-group-append">
                                    <button type="button" class="btn btn-primary"><i class="fa fa-gift"></i></button></span>
                            </div>
                            <!-- /input-group-->
                        </form>
                    </div>
                </div>
                <!-- /.col-md-3-->
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
@endsection
