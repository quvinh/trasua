@extends('user.components.customer_master')

@section('customer-content')
<div class="col-lg-9">
    <div class="box">
        <h1>Tài khoản của tôi</h1>
        <p class="lead">Thay đổi thôngn tin cá nhân hoặc mật khẩu đăng nhập ở đây.</p>
        <!-- <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p> -->
        @if(session()->has('success'))
        <div class="alert alert-success text-center" role="alert">
            {{ session()->get('success') }}
        </div>
        @elseif(session()->has('error'))
        <div class="alert alert-danger text-center" role="alert">
            {{ session()->get('error') }}
        </div>
        @endif
        <h3>Thay đổi mật khẩu đăng nhập</h3>
        <form method="post" action="{{ route('change-password') }}">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_old">Mật khẩu hiện tại</label>
                        <input id="password_old" name="password_old" type="password" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Mật khẩu mới</label>
                        <input id="password" name="password" type="password" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_confirmation">Nhập lại mật khẩu mới</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required>
                    </div>
                </div>
            </div>
            <!-- /.row-->
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu mật khẩu mới</button>
            </div>
        </form>
        <h3 class="mt-5">Thông tin cá nhân</h3>
        @php 
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        @endphp
        <form method="POST" action="{{ route('change-profile') }}">
            @csrf 
            @method('put')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        <input id="username" type="text" class="form-control" readonly value="{{ $user->username }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Họ và tên</label>
                        <input id="name" name="name" type="text" class="form-control" required value="{{ $user->name }}">
                    </div>
                </div>
            </div>
            <!-- /.row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" class="form-control" required value="{{ $user->email }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input id="phone" name="phone" type="text" class="form-control" required value="{{ $user->phone }}">
                    </div>
                </div>
            </div>
            <!-- /.row-->
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="form-group">
                        <label for="gender">Giới tính</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="" @if($user->gender == NULL) {{'selected'}} @endif>Giới tính</option>
                            <option value="1" @if($user->gender == 1) {{'selected'}} @endif>Nam</option>
                            <option value="0" @if($user->gender == 0) {{'selected'}} @endif>Nữ</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-lg-9">
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input id="address" name="address" class="form-control" required value="{{ $user->address }}">
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu thay đổi</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection