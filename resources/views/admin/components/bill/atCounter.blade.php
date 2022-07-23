@extends('admin.layouts.app')

@section('css')
@include('admin.layouts.css')
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Đặt tại quầy</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Đặt tại quầy</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-around" style="margin-bottom:2px;">
                <h5></h5>
                <h5></h5>
                <button class="btn btn-warning" id="product-payment"><i class="target fas fa-cart-arrow-down"></i> Sản
                    phẩm chờ thanh toán <b class="badge badge-primary" id="query-product" style="font-size:16px;"></b></button>
            </div>
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                        <li class="pt-2 px-3">
                            <h3 class="card-title"><i class="fas fa-table"></i></h3>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-table" data-toggle="pill" href="#tab-table1" role="tab" aria-controls="tab-table1" aria-selected="true">Sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-table-config" data-toggle="pill" href="#tab-table2" role="tab" aria-controls="tab-table2" aria-selected="false">
                                Đã bán
                                <!-- <span class="badge badge-danger" style="position:absolute;">10</span> -->
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-two-tabContent">
                        <div class="tab-pane fade show active" id="tab-table1" role="tabpanel" aria-labelledby="tab-table">
                            @php
                            $category = DB::table('categories')->get();
                            @endphp
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="select-category"><code>Hiển thị theo loại</code></label>
                                    <select class="custom-select custom-select-sm rounded-0" id="select-category">
                                        <option selected disabled>Hiển thị theo loại</option>
                                        @foreach($category as $item)
                                        <option value="{{ $item->id_category }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for=""><code>Tìm tên sản phẩm</code></label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control form-control-sm" id="search-product" placeholder="Tìm sản phẩm">
                                        <div class="input-group-prepend">
                                            <button type="button" class="button-search btn btn-success btn-sm"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <section class="items">
                                <div class="row" id="list-product"></div>
                            </section>
                        </div>
                        <!-- </div> -->
                        <div class="tab-pane fade" id="tab-table2" role="tabpanel" aria-labelledby="tab-table-config">
                            @php
                            $bills = DB::table('bills')->orderByDesc('created_at')->get();
                            @endphp
                            @foreach($bills as $key => $bill)
                            @php
                            $ldate = date('Y-m-d H:i:s');
                            $cdate = strtotime($ldate) - strtotime($bill->created_at);
                            $products = DB::table('bill_infos')
                            ->join('products', 'bill_infos.id_product', '=', 'products.id_product')
                            ->select('products.*', 'bill_infos.amount as amountProduct')
                            ->where('bill_infos.id_bill', $bill->id_bill)
                            ->get();
                            $date = '';
                            $m = (int)($cdate/60);
                            $h = (int)($cdate/(60*60));
                            $d = (int)($cdate/(60*60*24));
                            if($m > 0) {
                            $date = $m . ' phút trước';
                            if($h > 0) {
                            $date = $h . ' tiếng ' . ($m%60) . ' phút trước';
                            if($d > 0) {
                            $date = $d . ' ngày trước';
                            }
                            }
                            } else {
                            $date = 'Vài giây trước';
                            }
                            @endphp
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title" style="width:90%;">
                                        <div style="float:left;"><b>ID: {{$bill->id_bill}}</b> <span class="badge badge-primary"><i class="fas fa-check-circle"></i> {{$date}}</span></div>
                                        <div style="float:right;"><span class="badge badge-secondary">{{date('d/m/Y H:i:s', strtotime($bill->created_at))}}</span></div>
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table">
                                        <tbody>
                                            @foreach($products as $index => $product)
                                            <tr>
                                                <td>{{$index+1}}</td>
                                                <td><img src="{{asset('images/product/'.$product->image)}}" alt="IMAGE" height="30px"></td>
                                                <td>{{$product->name}}</td>
                                                <td>{{number_format($product->price, 0, '', ',')}}</td>
                                                <td>{{$product->amountProduct}} {{$product->unit}}</td>
                                                <td>{{number_format((float)$product->price*(float)$product->amountProduct, 0, '', ',')}}</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="5" class="text-right">Tổng tiền:</td>
                                                <td><b>{{number_format($bill->payment, 0, '', ',')}} đ</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
</div>
<div class="modal fade" id="modal-product-payment">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thanh toán</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sản phẩm đã chọn</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Size</th>
                                    <th>Giá</th>
                                    <th>SL</th>
                                    <th>Tiền</th>
                                    <th>Xoá</th>
                                </tr>
                            </thead>
                            <tbody id="table-item-selected">
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <form method="post" action="{{ route('admin.at-counter.save-bill') }}">
                @csrf
                <input type="text" id="id_product" name="id_product" value="" hidden required>
                <input type="text" id="amount_product" name="amount_product" value="" hidden required>
                <input type="number" id="payment" name="payment" value="0" hidden required>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ</button>
                    <button type="submit" class="btn btn-primary">Thanh toán</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
@include('admin.layouts.script')
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/fly/flyto.js') }}"></script>
<script>
    $(document).ready(function() {
        let itemSelected = [];
        let queryItem = 0;
        let Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        fetchData();

        function fetchData() {
            $.ajax({
                type: 'GET',
                url: 'order-product',
                datatype: 'json',
                success: function(res) {
                    $('#list-product').html('');
                    $.each(res.product, function(index, item) {
                        let img = 'system/No_image_available.png';
                        if (item.image != '') img = 'product/' + item.image;
                        $('#list-product').append(
                            '<div class="col-lg-3 col-6">\
                                <div class="card card-warning card-outline">\
                                    <div class="card-header" style="background-color:rgb(128, 198, 255);">\
                                        <div class="row"><div class="card-title col-11" style="white-space: nowrap;width: 100%;overflow: hidden;text-overflow: ellipsis;"><b>' + item.name + '</b></div>\
                                        <div class="col-1" style="float:right;"><i class="fas fa-info-circle" style="cursor: pointer;" onclick="alert($(window).width());"></i></div>\
                                    </div></div>\
                                    <div class="item-body card-body" style="background-color:rgb(185, 253, 255);">\
                                        <div class="thumb-holder" style="text-align:center;">\
                                            <img src="/images/' + img + '" alt="Ảnh <3" height="' + $(window).width() / 7 + 'px" style="border-radius: 4px;max-width:100%;">\
                                        </div>\
                                        <div style="text-align: center;">\
                                            <h4><i>' + (item.price).toLocaleString('it-IT', {
                                style: 'currency',
                                currency: 'VND'
                            }) + '</i></h4>\
                                        </div>\
                                        <button class="btn btn-primary add-item" type="button" value="' + item.id_product + '|`|' + item.name + '|`|' + item.price + '|`|' + item.size + '"\
                                            style="width: 100%;">\
                                            <i class="fas fa-cart-plus"></i>\
                                        </button>\
                                    </div>\
                                </div>\
                            </div>'
                        );
                    });
                    $('.items').flyto({
                        item: '.item-body',
                        target: '.target',
                        button: '.add-item'
                    });
                }
            })
        }

        $(document).on('change', '#select-category', function(event) {
            event.preventDefault();
            showData($('#select-category').val(), $('#search-product').val().trim());
        })
        $(document).on('click', '.button-search', function(event) {
            event.preventDefault();
            showData($('#select-category').val(), $('#search-product').val().trim());
        })
        $(document).on('click', '.add-item', function(event) {
            event.preventDefault();
            var vals = ($(this).val()).split('|`|');

            if (itemSelected.length > 0) {
                if (itemSelected.filter(item => item.id_product === vals[0]).length !== 0) {
                    let dataPush = itemSelected.filter(item => item.id_product === vals[0]);
                    let dataSelected = itemSelected.filter(item => item.id_product !== vals[0]);
                    let count = parseInt(dataPush[0].amount) + 1;
                    itemSelected = [
                        ...dataSelected,
                        {
                            id_product: dataPush[0].id_product,
                            name: dataPush[0].name,
                            price: dataPush[0].price,
                            size: dataPush[0].size,
                            amount: count
                        }
                    ];
                } else {
                    itemSelected.push({
                        id_product: vals[0],
                        name: vals[1],
                        price: vals[2],
                        size: vals[3],
                        amount: 1
                    })
                }
            } else {
                itemSelected.push({
                    id_product: vals[0],
                    name: vals[1],
                    price: vals[2],
                    size: vals[3],
                    amount: 1
                })
            }
            console.log(itemSelected);
            $('#query-product').text(itemSelected.length);
        })

        $(document).on('click', '#product-payment', function(event) {
            event.preventDefault();
            loadTableItemSelected();
            $('#modal-product-payment').modal('show');
        })

        $(document).on('click', '.remove-item-selected', function(event) {
            event.preventDefault();
            var id_product = $(this).attr('value');
            itemSelected = [...itemSelected.filter(item => item.id_product != id_product)];
            loadTableItemSelected();
            $('#query-product').text(itemSelected.length);
            if (itemSelected.length === 0) $('#modal-product-payment').modal('hide');
        })

        $(document).on('keyup', '.amount-item-selected', function(event) {
            event.preventDefault();
            var id_product = $(this).attr('id');
            var amount_selected = $(this).val();
            var itemChanged = itemSelected.filter(item => item.id_product === id_product);
            itemSelected.forEach(item => {
                if (item.id_product === id_product) item.amount = amount_selected;
            });
            loadTableItemSelected();
        })

        function loadTableItemSelected() {
            var html = '';
            var idProduct = '';
            var amountProduct = '';
            var totalPrice = 0;
            $('#table-item-selected').html('');
            itemSelected && itemSelected.map((item, index) => {
                idProduct += item.id_product + '|`|';
                amountProduct += item.amount + '|`|';
                totalPrice += parseFloat(item.amount) * parseFloat(item.price);
                html += '<tr>\
                    <td>' + parseInt(index + 1) + '</td>\
                    <td>' + item.name + '</td>\
                    <td>' + item.size + '</td>\
                    <td>' + (parseFloat(item.price)).toLocaleString() + '</td>\
                    <td><input type="number" class="amount-item-selected form-control" min="1" max="100" value="' + item.amount + '" id="' + item.id_product + '"></td>\
                    <td><span id="total' + item.id_product + '">' + (parseFloat(item.amount) * parseFloat(item.price)).toLocaleString() + '</span></td>\
                    <td><button class="remove-item-selected btn btn-danger btn-sm" value="' + item.id_product + '"><i class="fas fa-trash"></i></button></td>\
                </tr>'
            })
            html += '<tr>\
                <td colspan="6" style="text-align:right">Thành tiền: <b>' + totalPrice.toLocaleString() + '</b></td>\
                <td>đồng</td>\
            </tr>'
            $('#table-item-selected').append(html);
            $('#id_product').attr('value', idProduct);
            $('#amount_product').attr('value', amountProduct);
            $('#payment').attr('value', totalPrice);
            // Math.ceil(totalPrice/1000)*1000
        }

        function showData(id_category, name) {
            var data = {
                id_category: id_category,
                name: name,
            };
            $.ajax({
                type: 'GET',
                url: 'search-product',
                datatype: 'json',
                data: data,
                success: function(res) {
                    $('#list-product').html('');
                    $.each(res.product, function(index, item) {
                        let img = 'system/No_image_available.png';
                        if (item.image != '') img = 'product/' + item.image;
                        $('#list-product').append(
                            '<div class="col-lg-3 col-6">\
                                <div class="card card-warning card-outline">\
                                    <div class="card-header" style="background-color:rgb(128, 198, 255);">\
                                        <div class="row"><div class="card-title col-11" style="white-space: nowrap;width: 100%;overflow: hidden;text-overflow: ellipsis;"><b>' + item.name + '</b></div>\
                                        <div class="col-1" style="float:right;"><i class="fas fa-info-circle" style="cursor: pointer;" onclick="alert($(window).width());"></i></div>\
                                    </div></div>\
                                    <div class="item-body card-body" style="background-color:rgb(185, 253, 255);">\
                                        <div class="thumb-holder" style="text-align:center;">\
                                            <img src="/images/' + img + '" alt="Ảnh <3" height="' + $(window).width() / 7 + 'px" style="border-radius: 4px;max-width:100%;">\
                                        </div>\
                                        <div style="text-align: center;">\
                                            <h4><i>' + (item.price).toLocaleString('it-IT', {
                                style: 'currency',
                                currency: 'VND'
                            }) + '</i></h4>\
                                        </div>\
                                        <button class="btn btn-primary add-item" type="button" value="' + item.id_product + '|`|' + item.name + '|`|' + item.price + '"\
                                            style="width: 100%;">\
                                            <i class="fas fa-cart-plus"></i>\
                                        </button>\
                                    </div>\
                                </div>\
                            </div>'
                        );
                    });
                    $('.items').flyto({
                        item: '.item-body',
                        target: '.target',
                        button: '.add-item'
                    });
                }
            })
        }
        window.addEventListener('resize', function(event) {
            console.log($(window).width())
            fetchData();
        }, true);
    });
</script>
@if(session()->has('success'))
<!-- <div id="alert-success">
    <div class="alert alert-success" style="text-align: center; font-size: 20px; font-weight: bold;">
        {{ session()->get('success') }}
    </div>
</div>
<script>
    function timedOut() {
        document.getElementById("alert-success").innerHTML = "";
    }
    // set a timer
    setTimeout(timedOut, 3000);
</script> -->
<script>
    var title = "{{ session()->get('success') }}";
    $(document).ready(function() {
        let Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        Toast.fire({
            icon: 'success',
            title: title,
        });
    })
</script>
@endif
@endsection