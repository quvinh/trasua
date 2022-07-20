@extends('user.layouts.master')

@section('title')
Danh mục
@endsection

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
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
                            @if(isset($idCategory))
                            @php
                            $products = DB::table('products')->where([['visible', '=', 1], ['image', '<>', ''], ['id_category', '=', $idCategory]])->paginate(12);
                                $getCategory = DB::table('categories')->where('id_category', $idCategory)->pluck('name');
                                @endphp
                                <li class="breadcrumb-item"><a href="{{ route('category') }}">Danh mục</a></li>
                                <li aria-current="page" class="breadcrumb-item active">{{ $getCategory[0] }}</li>
                                @else
                                @php
                                $products = DB::table('products')->where([['visible', '=', 1], ['image', '<>', '']])->paginate(12);
                                    @endphp
                                    <li aria-current="page" class="breadcrumb-item active">Danh mục</li>
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
                                @foreach($categories as $category)
                                @php
                                $list = DB::table('products')->where([['id_category', '=', $category->id_category], ['visible', '=', 1]])->orderByDesc('name');
                                $count = $list->count();
                                @endphp
                                <li><a href="{{ route('get-category', $category->id_category) }}" class="nav-link @php if(isset($idCategory)){if($idCategory == $category->id_category){echo 'active';}} @endphp"><small><b style="text-transform: none;">{{ $category->name }}</b></small> <span class="badge badge-secondary">{{ $count }}</span></a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="card sidebar-menu mb-4">
                        <div class="card-header">
                            <h3 class="h4 card-title">Size <a href="#" class="btn btn-sm btn-danger pull-right"><i class="fa fa-times-circle"></i> Reset</a></h3>
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
                                            <input type="checkbox" value="{{ $size->id_size }}" @if($count==0) {{ 'disabled' }} @endif> {{ $size->name }} ({{ $count }})
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <button class="btn btn-default btn-sm btn-primary"><i class="fa fa-pencil"></i> Duyệt</button>
                            </form>
                        </div>
                    </div>
                    <!-- *** MENUS AND FILTERS END ***-->
                    <div class="banner"><a href="#"><img src="{{ asset('page/img/slider1.jpg') }}" alt="sales" class="img-fluid"></a></div>
                </div>
                <div class="col-lg-9">
                    <!-- <div class="box">
                        <h1>Ladies</h1>
                        <p>In our Ladies department we offer wide selection of the best products we have found and carefully selected worldwide.</p>
                    </div> -->
                    <div class="box info-bar">
                        <div class="row">
                            <div class="col-md-12 col-lg-4 products-showing">Hiển thị <strong>{{$products->count()}}</strong> trên <strong>{{$products->total()}}</strong> products</div>
                            <div class="col-md-12 col-lg-7 products-number-sort">
                                <form class="form-inline d-block d-lg-flex justify-content-between flex-column flex-md-row">
                                    <!-- <div class="products-number"><strong>Show</strong><a href="#" class="btn btn-sm btn-primary">12</a><a href="#" class="btn btn-outline-secondary btn-sm">24</a><a href="#" class="btn btn-outline-secondary btn-sm">All</a><span>products</span></div> -->
                                    <!-- <div class="products-sort-by mt-2 mt-lg-0"><strong>Sort by</strong>
                                        <select name="sort-by" class="form-control">
                                            <option>Price</option>
                                            <option>Name</option>
                                            <option>Sales first</option>
                                        </select>
                                    </div> -->
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row products">
                        @foreach($products as $product)
                        <div class="col-lg-4 col-md-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front"><a href="{{ route('get-product', $product->id_product) }}"><img src="{{ asset('images/product/'.$product->image) }}" alt="" class="img-fluid"></a></div>
                                        <div class="back"><a href="{{ route('get-product', $product->id_product) }}"><img src="{{ asset('images/product/'.$product->image) }}" alt="" class="img-fluid"></a></div>
                                    </div>
                                </div><a href="{{ route('get-product', $product->id_product) }}" class="invisible"><img src="{{ asset('images/product/'.$product->image) }}" alt="" class="img-fluid"></a>
                                <div class="text">
                                    <h3><a href="{{ route('get-product', $product->id_product) }}">{{ $product->name }}</a></h3>
                                    <p class="price">
                                        <del>@if($product->promotional_price > 0){{ number_format($product->promotional_price, 0, '', ',').' đ' }}@endif</del>{{ number_format($product->price, 0, '', ',').' đ' }}
                                    </p>
                                    <p class="buttons"><a href="{{ route('get-product', $product->id_product) }}" class="btn btn-outline-secondary">Chi tiết</a><button class="btn btn-primary btn-order" value="{{ $product->id_product }}"><i class="fa fa-shopping-cart"></i>Giỏ hàng</button></p>
                                </div>
                                <!-- /.text-->
                            </div>
                            <!-- /.product            -->
                            <div class="ribbon gift">
                                <div class="theribbon">GIFT</div>
                                <div class="ribbon-background"></div>
                            </div>
                            <!-- /.ribbon-->
                        </div>
                        @endforeach
                        <!-- /.products-->
                    </div>

                    <div class="pages">
                        <p class="loadMore"><a href="#" class="btn btn-primary btn-lg"><i class="fa fa-chevron-down"></i> Load more</a></p>
                        {{ $products->render('user.components.paginator') }}
                    </div>
                </div>
                <!-- /.col-lg-9-->
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.btn-order').on('click', function() {
            let Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            const id = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/gio-hang',
                data: {
                    call: 'api',
                    id_product: id,
                },
                dataType: 'json',
                success: function(res) {
                    // console.log(res);
                    Toast.fire({
                        icon: res.status,
                        title: res.message,
                    });
                    $('#cart-shop').text(res.count);
                },
                error: function(e) {
                    console.log(e);
                    Toast.fire({
                        icon: 'error',
                        title: 'Error',
                    });
                }
            })
        })
    })
</script>
@endsection