<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Đăng ký</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('page/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ asset('page/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">
    <!-- owl carousel-->
    <link rel="stylesheet" href="{{ asset('page/vendor/owl.carousel/assets/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('page/vendor/owl.carousel/assets/owl.theme.default.css') }}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('page/css/style.default.css') }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('page/css/custom.css') }}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <!-- Tweaks for older IEs-->
</head>

<body>
    <!-- <form method="POST" action="{{ route('login') }}">
        @csrf
        <h1>User</h1>
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Nhập mật khẩu">
        <button type="submit">Đăng nhập</button>
    </form> -->
    <div id="all">
        <div id="content">
            <div class="container" style="padding-top: 90px;">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="card-title"><a href="{{ url('/') }}"><img src="{{ asset('page/img/logo.png') }}" alt="Tẹt" height="48px"></a> <b style="color:#00c5c9;">Đăng ký</b></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box">
                                    <form action="customer-orders.html" method="post">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input id="name" type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input id="email" type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input id="password" type="password" class="form-control">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-user-md"></i> Đăng ký tài khoản</button>
                                        </div>
                                    </form>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="text-center text-muted">Đã có tài khoản? <u><a href="{{ route('login') }}">Đăng nhập</a></u></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ url('/') }}"><img src="{{ asset('page/img/slider1.jpg') }}" alt="" class="img-fluid" style="border-radius: 4px;"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('page/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('page/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('page/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('page/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('page/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.js') }}"></script>
    <script src="{{ asset('page/js/front.js') }}"></script>
</body>

</html>