@extends('user.layouts.master')

@section('title')
Danh mục
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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('category') }}">Danh mục</a></li>
                            @php
                            $product = DB::table('products')->where('id_product', $idProduct)->first();
                            $category = DB::table('products')
                            ->join('categories', 'products.id_category', '=', 'categories.id_category')
                            ->select('categories.name as name', 'categories.id_category as id_category', 'products.name
                            as nameProduct')
                            ->where('products.id_product', $idProduct)
                            ->first();
                            @endphp
                            @if($category)
                            <li class="breadcrumb-item"><a href="{{ route('get-category', $category->id_category) }}">{{
                                    $category->name }}</a></li>
                            <li aria-current="page" class="breadcrumb-item active">{{ $category->nameProduct }}</li>
                            @endif
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <!--
              *** MENUS AND FILTERS ***
              _________________________________________________________
              -->
                    <div class="card sidebar-menu mb-4">
                        <div class="card-header">
                            <h3 class="h4 card-title">Danh mục</h3>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills flex-column category-menu">
                                @php
                                $categories = DB::table('categories')->orderByDesc('name')->get();
                                @endphp
                                @foreach($categories as $item)
                                @php
                                $list = DB::table('products')->where([['id_category', '=', $item->id_category],
                                ['visible', '=', 1]])->orderByDesc('name');
                                $count = $list->count();
                                @endphp
                                <li><a href="{{ route('get-category', $item->id_category) }}"
                                        class="nav-link @php if(($category)){if($category->id_category == $item->id_category){echo 'active';}} @endphp"><small><b
                                                style="text-transform: none;">{{ $item->name }}</b></small> <span
                                            class="badge badge-secondary">{{ $count }}</span></a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="card sidebar-menu mb-4">
                        <div class="card-header">
                            <h3 class="h4 card-title">Size <a href="#" class="btn btn-sm btn-danger pull-right"><i
                                        class="fa fa-times-circle"></i> Reset</a></h3>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    @php
                                    $sizes = DB::table('sizes')->get();
                                    @endphp
                                    @foreach($sizes as $size)
                                    @php
                                    $count = DB::table('products')->where('id_size', $size->id_size)->count();
                                    @endphp
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="{{ $size->id_size }}" @if($count==0)
                                                {{ 'disabled' }} @endif> {{ $size->name }} ({{ $count }})
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <button class="btn btn-default btn-sm btn-primary"><i class="fa fa-pencil"></i>
                                    Duyệt</button>
                            </form>
                        </div>
                    </div>
                    <!-- *** MENUS AND FILTERS END ***-->
                    <div class="banner"><a href="#"><img src="{{ asset('page/img/slider1.jpg') }}" alt="sales"
                                class="img-fluid"></a></div>
                </div>

                <div class="col-lg-9 order-1 order-lg-2">
                    <div id="productMain" class="row">
                        <div class="col-md-6">
                            <div data-slider-id="1" class="owl-carousel shop-detail-carousel">
                                @if($product)
                                <div class="item"> <img src="{{ asset('images/product/'.$product->image) }}" alt="product" class="img-fluid"></div>
                                @endif
                            </div>
                            <!-- <div class="ribbon sale">
                                <div class="theribbon">SALE</div>
                                <div class="ribbon-background"></div>
                            </div> -->
                            <!-- /.ribbon-->
                            <!-- <div class="ribbon new">
                                <div class="theribbon">NEW</div>
                                <div class="ribbon-background"></div>
                            </div> -->
                            <!-- /.ribbon-->
                        </div>
                        <div class="col-md-6">
                            <div class="box">
                                <h1 class="text-center">{{ $product->name }}</h1>
                                <p class="goToDescription"><a href="#details" class="scroll-to">Xem thông tin sản phẩm {{ $product->name }}</a></p>
                                <p class="price">{{ number_format($product->price, 0, '', ',').' đ' }}</p>
                                <p class="text-center buttons"><a href="#" class="btn btn-primary"><i
                                            class="fa fa-shopping-cart"></i> Thêm giỏ hàng</a><a href="#"
                                        class="btn btn-outline-primary"><i class="fa fa-heart"></i> Yêu thích</a>
                                </p>
                            </div>
                            <div data-slider-id="1" class="owl-thumbs">
                                <button class="owl-thumb-item"><img src="{{ asset('images/product/'.$product->image) }}" alt="product"
                                        class="img-fluid"></button>
                                <!-- <button class="owl-thumb-item"><img src="" alt=""
                                        class="img-fluid"></button>
                                <button class="owl-thumb-item"><img src="" alt=""
                                        class="img-fluid"></button> -->
                            </div>
                        </div>
                    </div>
                    <div id="details" class="box">
                        <p></p>
                        {{ $product->description }}
                        <hr>
                        <div class="social">
                            <h4>Chia sẻ</h4>
                            <p><a href="#" class="external facebook"><i class="fa fa-facebook"></i></a><a href="#"
                                    class="external gplus"><i class="fa fa-google-plus"></i></a><a href="#"
                                    class="external twitter"><i class="fa fa-twitter"></i></a><a href="#"
                                    class="email"><i class="fa fa-envelope"></i></a></p>
                        </div>
                    </div>
                    <div class="row same-height-row">
                        <div class="col-md-3 col-sm-6">
                            <div class="box same-height">
                                <h3>Sản phẩm liên quan</h3>
                            </div>
                        </div>
                        @php
                        $relates = DB::table('products')->where([['id_category', '=', $category->id_category], ['id_product', '<>', $idProduct]])->orderByDesc('id_product')->take(3)->get();
                        @endphp
                        @foreach($relates as $item)
                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front"><a href="{{ route('get-product', $item->id_product) }}"><img src="{{ asset('images/product/'.$item->image) }}" alt=""
                                                    class="img-fluid"></a></div>
                                        <div class="back"><a href="{{ route('get-product', $item->id_product) }}"><img src="{{ asset('images/product/'.$item->image) }}" alt=""
                                                    class="img-fluid"></a></div>
                                    </div>
                                </div><a href="{{ route('get-product', $item->id_product) }}" class="invisible"><img src="{{ asset('images/product/'.$item->image) }}" alt=""
                                        class="img-fluid"></a>
                                <div class="text">
                                    <h3>{{ $item->name }}</h3>
                                    <p class="price">{{ number_format($item->price, 0, '', ',').' đ' }}</p>
                                </div>
                            </div>
                            <!-- /.product-->
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.col-md-9-->
            </div>
        </div>
    </div>
</div>
@endsection