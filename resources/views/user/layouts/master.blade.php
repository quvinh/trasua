<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
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
    @yield('css')
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
    <!-- navbar-->
    <header class="header mb-5">
        <!--
      *** TOPBAR ***
      _________________________________________________________
      -->
        <div id="top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offer mb-3 mb-lg-0">
                        <!-- <a href="#" class="btn btn-success btn-sm">Offer of the day</a><a href="#" class="ml-1">Get flat 35% off on orders over $50!</a> -->
                    </div>
                    <div class="col-lg-6 text-center text-lg-right">
                        <ul class="menu list-inline mb-0">
                            @if(Route::has('login'))
                            @auth
                            <li class="list-inline-item"><a href="{{ route('orders-history') }}"><i class="fa fa-user"></i> {{ Auth::user()->username }}</a>
                            </li>
                            <li class="list-inline-item"><a href="{{ route('logout') }}">????ng xu???t</a></li>
                            @else
                            <li class="list-inline-item"><a href="{{ route('login') }}">????ng nh???p</a></li>
                            <li class="list-inline-item"><a href="{{ route('register') }}">????ng k??</a></li>
                            @endauth
                            @endif
                            <li class="list-inline-item"><a href="contact.html">Li??n h???</a></li>
                            <li class="list-inline-item"><a href="#">M???c ???? xem</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- *** TOP BAR END ***-->
        </div>
        <nav class="navbar navbar-expand-lg">
            <div class="container"><a href="{{ url('/') }}" class="navbar-brand home"><img src="{{ asset('page/img/logo.png') }}" alt="TrasuaTet logo" class="d-none d-md-inline-block"><img src="{{ asset('page/img/logo.png') }}" width="84px" alt="TrasuaTet logo" class="d-inline-block d-md-none"><span class="sr-only">TraSuaTet - go to
                        homepage</span></a>
                <div class="navbar-buttons">
                    <button type="button" data-toggle="collapse" data-target="#navigation" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle
                            navigation</span><i class="fa fa-align-justify"></i></button>
                    <button type="button" data-toggle="collapse" data-target="#search" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></button><a href="{{ route('order') }}" class="btn btn-outline-secondary navbar-toggler"><i class="fa fa-shopping-cart"></i></a>
                </div>
                <div id="navigation" class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Trang ch???</a></li>
                        <li class="nav-item"><a href="{{ route('category') }}" class="nav-link">?????t h??ng</a></li>
                        <li class="nav-item"><a href="{{ route('order') }}" class="nav-link">Gi??? h??ng</a></li>
                    </ul>
                    <div class="navbar-buttons d-flex justify-content-end">
                        <!-- /.nav-collapse-->
                        <div id="search-not-mobile" class="navbar-collapse collapse"></div><a data-toggle="collapse" href="#search" class="btn navbar-btn btn-primary d-none d-lg-inline-block"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></a>
                        <div id="basket-overview" class="navbar-collapse collapse d-none d-lg-block">
                            <a href="{{ route('order') }}" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i>
                                <span id="cart-shop">
                                @if(Route::has('login'))
                                @auth
                                @php 
                                $cart = DB::table('orders')->select(DB::raw('SUM(amount) as amount'))->where([['created_by', '=', Auth::user()->id], ['status', '=', 0]])->first()->amount;
                                @endphp
                                {{$cart}}
                                @else
                                {{0}}
                                @endauth
                                @endif
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div id="search" class="collapse">
            <div class="container">
                <form role="search" class="ml-auto" action="{{ url('/'.app('request')->route()->uri().'/search') }}" method="get">
                    @csrf
                    <div class="input-group">
                        <input type="text" placeholder="T??m ki???m t???i {{app('request')->route()->uri()}}" class="form-control" name="search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </header>
    @yield('all')
    <!--
    *** FOOTER ***
    _________________________________________________________
    -->
    <div id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <h4 class="mb-3">Trang website</h4>
                    <ul class="list-unstyled">
                        <li><a href="text.html">V??? c???a h??ng</a></li>
                        <li><a href="text.html">Ch??nh s??ch v?? ??i???u kho???n</a></li>
                        <li><a href="faq.html">C??u h???i th?????ng g???p</a></li>
                        <li><a href="contact.html">Li??n h??? c???a h??ng</a></li>
                    </ul>
                    <hr>
                    <h4 class="mb-3">Ng?????i d??ng</h4>
                    <ul class="list-unstyled">
                        @if(Route::has('login'))
                        @auth
                        <li><a><i class="fa fa-user"></i> {{ Auth::user()->username }}</a></li>
                        <li><a href="{{ route('logout') }}">????ng xu???t</a></li>
                        @else
                        <li><a href="{{ route('login') }}">????ng nh???p</a></li>
                        <li><a href="{{ route('register') }}">????ng k??</a></li>
                        @endauth
                        @endif
                    </ul>
                </div>
                <!-- /.col-lg-3-->
                <div class="col-lg-3 col-md-6">
                    <h4 class="mb-3">Menu ch??nh</h4>
                    <h5>Tr?? s???a</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Tr?? s???a tr??n ch??u n?????ng</a></li>
                        <li><a href="#">Tr?? s???a b??ch ngh???</a></li>
                        <li><a href="#">Tr?? s???a matcha</a></li>
                    </ul>
                    <h5>N?????c gi???i kh??t</h5>
                    <!-- <ul class="list-unstyled">
                        <li><a href="category.html">T-shirts</a></li>
                        <li><a href="category.html">Skirts</a></li>
                        <li><a href="category.html">Pants</a></li>
                        <li><a href="category.html">Accessories</a></li>
                    </ul> -->
                </div>
                <!-- /.col-lg-3-->
                <div class="col-lg-3 col-md-6">
                    <h4 class="mb-3">?????a ch???</h4>
                    <p><strong>Tr?? s???a T???t.</strong><br>Th??n C??n L??nh<br>X?? Chi???n Th???ng<br>Huy???n An L??o<br>TP H???i
                        Ph??ng<br><strong>Vi???t Nam</strong></p><a href="#">T???i trang li??n h???</a>
                    <hr class="d-block d-md-none">
                </div>
                <!-- /.col-lg-3-->
                <div class="col-lg-3 col-md-6">
                    <h4 class="mb-3">Gi???i thi???u</h4>
                    <p class="text-muted">Topping c???a T???t ch??a bao gi??? l??m b???n th???t v???ng nay l???i ???????c double lu??n!

                        Tr?? s???a ho?? quy???n c??ng kem ph?? mai b??o m???n v?? th??m tr??n ch??u s????ng mai gi??n dai, tr??n ch??u ho??ng
                        kim v?? tr??n ch??u s???i d???o th??m, c??c lo???i th???ch ??a d???ng c???a T???t??? ch???c h???n s??? khi???n c??c t??n ?????
                        topping xao xuy???n.</p>
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control"><span class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary">????ng k??!</button></span>
                        </div>
                        <!-- /input-group-->
                    </form>
                    <hr>
                    <h4 class="mb-3">Stay in touch</h4>
                    <p class="social"><a href="#" class="facebook external"><i class="fa fa-facebook"></i></a><a href="#" class="twitter external"><i class="fa fa-twitter"></i></a><a href="#" class="instagram external"><i class="fa fa-instagram"></i></a><a href="#" class="gplus external"><i class="fa fa-google-plus"></i></a><a href="#" class="email external"><i class="fa fa-envelope"></i></a></p>
                </div>
                <!-- /.col-lg-3-->
            </div>
            <!-- /.row-->
        </div>
        <!-- /.container-->
    </div>
    <!-- /#footer-->
    <!-- *** FOOTER END ***-->


    <!--
    *** COPYRIGHT ***
    _________________________________________________________
    -->
    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-2 mb-lg-0">
                    <p class="text-center text-lg-left">??2022 TrasuaTet.</p>
                </div>
                <div class="col-lg-6">
                    <p class="text-center text-lg-right">Template design by <a href="#">Zinh</a>
                        <!-- If you want to remove this backlink, pls purchase an Attribution-free License @ https://bootstrapious.com/p/obaju-e-commerce-template. Big thanks!-->
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- *** COPYRIGHT END ***-->
    <!-- <button type="button" data-toggle="collapse" data-target="#style-switch" id="style-switch-button" class="btn btn-primary btn-sm d-none d-lg-inline-block"><i class="fa fa-cog fa-2x"></i></button>
    <div id="style-switch" class="collapse">
        <h5>Select theme colour</h5>
        <form class="mb-3">
            <select name="colour" id="colour" class="form-control">
                <option value="">select colour variant</option>
                <option value="default">turquoise</option>
                <option value="pink">pink</option>
                <option value="green">green</option>
                <option value="violet">violet</option>
                <option value="sea">sea</option>
                <option value="blue">blue</option>
                <option value="red">red</option>
            </select>
        </form>
        <p><img src="https://d19m59y37dris4.cloudfront.net/obaju/2-1-1/img/template-mac.png" alt="" class="img-fluid"></p>
        <p class="text-muted text-small">Stylesheet switching is done via JavaScript and can cause a blink while page loads. This will not happen in your production code.</p>
    </div> -->
    <!-- JavaScript files-->
    <script src="{{ asset('page/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('page/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('page/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('page/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('page/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.js') }}"></script>
    <script src="{{ asset('page/js/front.js') }}"></script>
    @yield('script')
</body>

</html>