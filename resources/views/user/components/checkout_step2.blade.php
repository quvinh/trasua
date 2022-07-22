@extends('user.components.checkout_master')

@section('checkout')
Phương thức giao hàng
@endsection

@section('checkout-content')
<div id="checkout" class="col-lg-9">
    <div class="box">
        <form>
            <h1>Thanh toán - Phương thức giao hàng</h1>
            <div class="nav flex-column flex-md-row nav-pills text-center"><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-map-marker"> </i>Địa chỉ</a><a href="#" class="nav-link flex-sm-fill text-sm-center active"> <i class="fa fa-truck"> </i>Giao hàng</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-money"> </i>Thanh toán</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-eye"> </i>Tổng quan</a></div>
            <div class="content py-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box shipping-method">
                            <h4>Giao Nhanh</h4>
                            <p>Nhận hàng trong vòng 15p - có thể nhanh hơn.</p>
                            <div class="box-footer text-center">
                                <input type="radio" name="delivery" value="delivery1" checked>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer d-flex justify-content-between"><a href="{{ route('checkout-order') }}" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i>Trở lại Địa chỉ</a>
                <!-- <button type="submit" class="btn btn-primary">Continue to Payment Method<i class="fa fa-chevron-right"></i></button> -->
                <a href="{{ route('checkout-payment') }}" class="btn btn-primary">Tiếp tục đến Thanh toán<i class="fa fa-chevron-right"></i></a>
            </div>
        </form>
    </div>
    <!-- /.box-->
</div>
@endsection