@extends('user.components.checkout_master')

@section('checkout')
Địa chỉ
@endsection

@section('checkout-content')
@php 
$user = DB::table('users')->find(Auth::user()->id);
@endphp
<div id="checkout" class="col-lg-9">
    <div class="box">
        <form method="post" action="{{ route('checkout-address') }}">
            @csrf 
            @method('put')
            <h1>Thanh toán - Địa chỉ</h1>
            <div class="nav flex-column flex-md-row nav-pills text-center"><a href="{{ route('checkout-order') }}" class="nav-link flex-sm-fill text-sm-center active"> <i class="fa fa-map-marker"> </i>Địa chỉ</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-truck"> </i>Giao hàng</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-money"> </i>Thanh toán</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-eye"> </i>Tổng quan</a></div>
            <div class="content py-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Họ và tên</label>
                            <input id="name" name="name" type="text" class="form-control" placeholder="Nhập tên..." value="{{ $user->name }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" class="form-control" placeholder="Nhập email..." value="{{ $user->email }}">
                        </div>
                    </div>
                </div>
                <!-- /.row-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">SĐT</label>
                            <input id="phone" name="phone" type="text" class="form-control" value="{{ $user->phone }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gender">Giới tính</label>
                            <!-- <input id="gender" name="gender" type="text" class="form-control"> -->
                            <select class="form-control" name="gender">
                                <option @if($user->gender == NULL) {{'selected'}} @endif>Giới tính</option>
                                <option value="1" @if($user->gender == 1) {{'selected'}} @endif>Nam</option>
                                <option value="0" @if($user->gender == 0) {{'selected'}} @endif>Nữ</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="city">Địa chỉ nhận hàng</label>
                            <!-- <input id="city" type="text" class="form-control"> -->
                            <textarea name="address" id="address" rows="2" class="form-control">{{ $user->address }}</textarea>
                        </div>
                    </div>
                </div>
                <!-- /.row-->
            </div>
            <div class="box-footer d-flex justify-content-between"><a href="{{ route('order') }}" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i>Trở lại Giỏ hàng</a>
                <button type="submit" class="btn btn-primary">Tiếp tục đến Phương thức giao hàng<i class="fa fa-chevron-right"></i></button>
            </div>
        </form>
    </div>
    <!-- /.box-->
</div>
@endsection