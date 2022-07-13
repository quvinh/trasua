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
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
                            <li aria-current="page" class="breadcrumb-item active">Danh mục</li>
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
                                $products = $list->take(10)->get();
                                @endphp
                                <li><a href="#" class="nav-link">{{ $category->name }} <span class="badge badge-secondary">{{ $count }}</span></a>
                                    <ul class="list-unstyled">
                                        @foreach($products as $product)
                                        <li><a href="#" class="nav-link">{{ $product->name }}</a></li>
                                        @endforeach
                                    </ul>
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
                                            <input type="checkbox" value="{{ $size->id_size }}" @if($count == 0) {{ 'disabled' }} @endif> {{ $size->name }} ({{ $count }})
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
                            <div class="col-md-12 col-lg-4 products-showing">Showing <strong>12</strong> of <strong>25</strong> products</div>
                            <div class="col-md-12 col-lg-7 products-number-sort">
                                <form class="form-inline d-block d-lg-flex justify-content-between flex-column flex-md-row">
                                    <div class="products-number"><strong>Show</strong><a href="#" class="btn btn-sm btn-primary">12</a><a href="#" class="btn btn-outline-secondary btn-sm">24</a><a href="#" class="btn btn-outline-secondary btn-sm">All</a><span>products</span></div>
                                    <div class="products-sort-by mt-2 mt-lg-0"><strong>Sort by</strong>
                                        <select name="sort-by" class="form-control">
                                            <option>Price</option>
                                            <option>Name</option>
                                            <option>Sales first</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row products">
                        @php
                        $products = DB::table('products')->where([['visible', '=', 1], ['image', '<>', '']])->take(8)->get();
                        @endphp
                        @foreach($products as $product)
                        <div class="col-lg-4 col-md-6">
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
                                        <del>{{ number_format($product->promotional_price, 0, '', ',').' đ' }}</del>{{ number_format($product->price, 0, '', ',').' đ' }}
                                    </p>
                                    <p class="buttons"><a href="#" class="btn btn-outline-secondary">Chi tiết</a><a href="#" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Giỏ hàng</a></p>
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
                        <div class="col-lg-4 col-md-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front"><a href="detail.html"><img src="{{ asset('page/img/product2.jpg') }}" alt="" class="img-fluid"></a></div>
                                        <div class="back"><a href="detail.html"><img src="{{ asset('page/img/product2_2.jpg') }}" alt="" class="img-fluid"></a></div>
                                    </div>
                                </div><a href="detail.html" class="invisible"><img src="{{ asset('page/img/product2.jpg') }}" alt="" class="img-fluid"></a>
                                <div class="text">
                                    <h3><a href="detail.html">White Blouse Armani</a></h3>
                                    <p class="price">
                                        <del>$280</del>$143.00
                                    </p>
                                    <p class="buttons"><a href="detail.html" class="btn btn-outline-secondary">View detail</a><a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a></p>
                                </div>
                                <!-- /.text-->
                                <div class="ribbon sale">
                                    <div class="theribbon">SALE</div>
                                    <div class="ribbon-background"></div>
                                </div>
                                <!-- /.ribbon-->
                                <div class="ribbon new">
                                    <div class="theribbon">NEW</div>
                                    <div class="ribbon-background"></div>
                                </div>
                                <!-- /.ribbon-->
                                <div class="ribbon gift">
                                    <div class="theribbon">GIFT</div>
                                    <div class="ribbon-background"></div>
                                </div>
                                <!-- /.ribbon-->
                            </div>
                            <!-- /.product            -->
                        </div>
                        <!-- /.products-->
                    </div>
                    <div class="pages">
                        <p class="loadMore"><a href="#" class="btn btn-primary btn-lg"><i class="fa fa-chevron-down"></i> Load more</a></p>
                        <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                            <ul class="pagination">
                                <li class="page-item"><a href="#" aria-label="Previous" class="page-link"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
                                <li class="page-item active"><a href="#" class="page-link">1</a></li>
                                <li class="page-item"><a href="#" class="page-link">2</a></li>
                                <li class="page-item"><a href="#" class="page-link">3</a></li>
                                <li class="page-item"><a href="#" class="page-link">4</a></li>
                                <li class="page-item"><a href="#" class="page-link">5</a></li>
                                <li class="page-item"><a href="#" aria-label="Next" class="page-link"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /.col-lg-9-->
            </div>
        </div>
    </div>
</div>

@endsection