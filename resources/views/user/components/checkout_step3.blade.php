@extends('user.components.checkout_master')

@section('checkout')
Phương thức thanh toán
@endsection

@section('checkout-content')
<div id="checkout" class="col-lg-9">
    <div class="box">
        <form method="get" action="">
            <h1>Thanh toán - Phương thức thanh toán</h1>
            <div class="nav flex-column flex-md-row nav-pills text-center"><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-map-marker"> </i>Địa chỉ</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-truck"> </i>Giao hàng</a><a href="#" class="nav-link flex-sm-fill text-sm-center active"> <i class="fa fa-money"> </i>Thanh toán</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-eye"> </i>Tổng quan</a></div>
            <div class="content py-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box payment-method">
                            <h4>Thanh toán khi giao hàng</h4>
                            <p>Bạn sẽ trả tiền khi nhận được sản phẩm.</p>
                            <div class="box-footer text-center">
                                <input type="radio" name="payment" value="payment3" checked>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row-->
            </div>
            <!-- /.content-->
            <div class="box-footer d-flex justify-content-between"><a href="{{ route('checkout-delivery') }}" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i>Trở về Giao hàng</a>
                <!-- <button type="submit" class="btn btn-primary">Continue to Order Review<i class="fa fa-chevron-right"></i></button> -->
                <a href="{{ route('checkout-review') }}" class="btn btn-primary">Tiếp tục đến Tổng quan<i class="fa fa-chevron-right"></i></a>
            </div>
        </form>
        <!-- /.box-->
    </div>
</div>
@endsection