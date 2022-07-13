@extends('user.layouts.master')

@section('title')
Trà sữa Tẹt
@endsection

@section('all')
<div id="all">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="main-slider" class="owl-carousel owl-theme">
                        <div class="item"><img src="{{ asset('page/img/slider1.jpg') }}" alt="" class="img-fluid"></div>
                        <div class="item"><img src="{{ asset('page/img/slider2.jpg') }}" alt="" class="img-fluid"></div>
                        <div class="item"><img src="{{ asset('page/img/slider3.jpg') }}" alt="" class="img-fluid"></div>
                        <div class="item"><img src="{{ asset('page/img/slider4.jpg') }}" alt="" class="img-fluid"></div>
                    </div>
                    <!-- /#main-slider-->
                </div>
            </div>
        </div>
        <!--
        *** ADVANTAGES HOMEPAGE ***
        _________________________________________________________
        -->
        <div id="advantages">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                            <div class="icon"><i class="fa fa-heart"></i></div>
                            <h3><a href="#">We love our customers</a></h3>
                            <p class="mb-0">We are known to provide best possible service ever</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                            <div class="icon"><i class="fa fa-tags"></i></div>
                            <h3><a href="#">Best prices</a></h3>
                            <p class="mb-0">You can check that the height of the boxes adjust when longer text like this one is used in one of them.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                            <div class="icon"><i class="fa fa-thumbs-up"></i></div>
                            <h3><a href="#">100% satisfaction guaranteed</a></h3>
                            <p class="mb-0">Free returns on everything for 3 months.</p>
                        </div>
                    </div>
                </div>
                <!-- /.row-->
            </div>
            <!-- /.container-->
        </div>
        <!-- /#advantages-->
        <!-- *** ADVANTAGES END ***-->
        <!--
        *** HOT PRODUCT SLIDESHOW ***
        _________________________________________________________
        -->
        <div id="hot">
            <div class="box py-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="mb-0">Sản phẩm trong tuần</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                @php
                $products = DB::table('products')->where([['visible', '=', 1], ['image', '<>', '']])->take(8)->get();
                @endphp
                <div class="product-slider owl-carousel owl-theme">
                    @foreach($products as $key => $product)
                    <div class="item">
                        <div class="product">
                            <div class="flip-container">
                                <div class="flipper">
                                    <div class="front"><a href="#"><img src="{{ asset('images/product/'.$product->image) }}" alt="" class="img-fluid"></a></div>
                                    <div class="back"><a href="#"><img src="{{ asset('images/product/'.$product->image) }}" alt="" class="img-fluid"></a></div>
                                </div>
                            </div><a href="#" class="invisible"><img src="{{ asset('images/product/'.$product->image) }}" alt="" class="img-fluid"></a>
                            <div class="text">
                                <h3><a href="#">{{ $product->name }}</a></h3>
                                <p class="price">
                                    <del></del>{{ number_format($product->price, 0, '', ',').' đ' }}
                                </p>
                            </div>
                            <!-- /.text-->
                            <!-- <div class="ribbon sale">
                                <div class="theribbon">SALE</div>
                                <div class="ribbon-background"></div>
                            </div> -->
                            <!-- /.ribbon-->
                            @if($key == 0)
                            <div class="ribbon new">
                                <div class="theribbon">NEW</div>
                                <div class="ribbon-background"></div>
                            </div>
                            @endif
                            <!-- /.ribbon-->
                            <!-- <div class="ribbon gift">
                                <div class="theribbon">GIFT</div>
                                <div class="ribbon-background"></div>
                            </div> -->
                            <!-- /.ribbon-->
                        </div>
                        <!-- /.product-->
                    </div>
                    @endforeach
                    <!-- /.product-slider-->
                </div>
                <!-- /.container-->
            </div>
            <!-- /#hot-->
            <!-- *** HOT END ***-->
        </div>
        <!--
        *** GET INSPIRED ***
        _________________________________________________________
        -->
        <div class="container">
            <div class="col-md-12">
                <div class="box slideshow">
                    <h3>Tẹt</h3>
                    <p class="lead">Trà sữa Tẹt</p>
                    <div id="get-inspired" class="owl-carousel owl-theme">
                        <div class="item"><a href="#"><img src="{{ asset('page/img/footer-slider1.webp') }}" alt="Get inspired" class="img-fluid"></a></div>
                        <div class="item"><a href="#"><img src="{{ asset('page/img/footer-slider2.webp') }}" alt="Get inspired" class="img-fluid"></a></div>
                        <div class="item"><a href="#"><img src="{{ asset('page/img/footer-slider3.webp') }}" alt="Get inspired" class="img-fluid"></a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- *** GET INSPIRED END ***-->
        <!--
        *** BLOG HOMEPAGE ***
        _________________________________________________________
        -->
        <div class="box text-center">
            <div class="container">
                <div class="col-md-12">
                    <h3 class="text-uppercase">Bài đăng</h3>
                    <p class="lead mb-0">Đọc bài đăng về Trà sữa Tẹt? <a href="#">Vào bài đăng!</a></p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-md-12">
                <div id="blog-homepage" class="row">
                    <div class="col-sm-6">
                        <div class="post">
                            <h4><a href="post.html">Tẹt</a></h4>
                            <p class="author-category">By <a href="#">Boicudon</a></p>
                            <hr>
                            <p class="intro text-center">Hôm nay làm việc mệt rồi. Bên ly trà sữa, ta ngồi có đôi.</p>
                            <p class="read-more"><a href="post.html" class="btn btn-primary">Continue reading</a></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="post">
                            <h4><a href="post.html">Tà tưa</a></h4>
                            <p class="author-category">By <a href="#">FromChienThangwithLove</a></p>
                            <hr>
                            <p class="intro text-center">Xếp hàng chờ đợi đã lâu. Chờ ly trà sữa, chờ câu ân tình.</p>
                            <p class="read-more"><a href="post.html" class="btn btn-primary">Continue reading</a></p>
                        </div>
                    </div>
                </div>
                <!-- /#blog-homepage-->
            </div>
        </div>
        <!-- /.container-->
        <!-- *** BLOG HOMEPAGE END ***-->
    </div>
</div>
@endsection