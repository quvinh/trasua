@extends('user.components.customer_master')

@section('customer-content')
<div class="col-lg-9">
    <div class="box">
        <h1>My account</h1>
        <p class="lead">Change your personal details or your password here.</p>
        <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
        <h3>Change password</h3>
        <form>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_old">Old password</label>
                        <input id="password_old" type="password" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_1">New password</label>
                        <input id="password_1" type="password" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_2">Retype new password</label>
                        <input id="password_2" type="password" class="form-control">
                    </div>
                </div>
            </div>
            <!-- /.row-->
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save new password</button>
            </div>
        </form>
        <h3 class="mt-5">Personal details</h3>
        <form>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input id="firstname" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input id="lastname" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <!-- /.row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="company">Company</label>
                        <input id="company" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="street">Street</label>
                        <input id="street" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <!-- /.row-->
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="form-group">
                        <label for="city">Company</label>
                        <input id="city" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="form-group">
                        <label for="zip">ZIP</label>
                        <input id="zip" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="form-group">
                        <label for="state">State</label>
                        <select id="state" class="form-control"></select>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select id="country" class="form-control"></select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Telephone</label>
                        <input id="phone" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection