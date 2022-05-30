@extends('admin.layouts.app')

@section('css')
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
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
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
                    phẩm chờ thanh toán <b class="badge badge-primary" id="query-product"
                        style="font-size:16px;"></b></button>
            </div>
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                        <li class="pt-2 px-3">
                            <h3 class="card-title"><i class="fas fa-table"></i></h3>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-table" data-toggle="pill" href="#tab-table1" role="tab"
                                aria-controls="tab-table1" aria-selected="true">Sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-table-config" data-toggle="pill" href="#tab-table2" role="tab"
                                aria-controls="tab-table2" aria-selected="false">
                                Thiết lập
                                <!-- <span class="badge badge-danger" style="position:absolute;">10</span> -->
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-two-tabContent">
                        <div class="tab-pane fade show active" id="tab-table1" role="tabpanel"
                            aria-labelledby="tab-table">
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
                                        <input type="text" class="form-control form-control-sm" id="search-product"
                                            placeholder="Tìm sản phẩm">
                                        <div class="input-group-prepend">
                                            <button type="button" class="button-search btn btn-success btn-sm"><i
                                                    class="fas fa-search"></i></button>
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
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Danh sách <small>Sản phẩm</small></h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <label>(*) Thêm bàn</label>
                                    <ul id="error-store"></ul>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control" id="name"
                                                    placeholder="Nhập tên bàn">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="number" min="0" max="20" name="amount" class="form-control"
                                                    id="amount" placeholder="Số chỗ">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" id="button-store" class="btn btn-primary"><i
                                                    class="fas fa-plus-circle"></i> Thêm mới</button>
                                        </div>
                                    </div>
                                    <label>- Danh sách</label>
                                    <table id="table2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 5px;">STT</th>
                                                <th>ID</th>
                                                <th>Tên</th>
                                                <th>Số chỗ</th>
                                                <th>Hiển thị</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="width: 5px;">STT</th>
                                                <th>ID</th>
                                                <th>Tên</th>
                                                <th>Số chỗ</th>
                                                <th>Hiển thị</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
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
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Update software</td>
                                    <td>SIZE M</td>
                                    <td>15000</td>
                                    <td><input type="number" class="form-control" min="1" max="100" value="1"></td>
                                    <td>75000</td>
                                    <td><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Update software</td>
                                    <td>Update software</td>
                                    <td>Update software</td>
                                    <td>Update software</td>
                                    <td><span class="badge bg-danger">55%</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/fly/flyto.js') }}"></script>
<script>
    $(document).ready(function () {
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
                success: function (res) {
                    $('#list-product').html('');
                    $.each(res.product, function (index, item) {
                        let img = 'system/No_image_available.png';
                        if (item.image != '') img = 'product/' + item.image;
                        $('#list-product').append(
                            '<div class="col-lg-3 col-6">\
                                <div class="card card-warning card-outline">\
                                    <div class="card-header" style="background-color:rgb(128, 198, 255);">\
                                        <div class="row"><div class="card-title col-11" style="white-space: nowrap;width: 100%;overflow: hidden;text-overflow: ellipsis;"><b>'+ item.name + '</b></div>\
                                        <div class="col-1" style="float:right;"><i class="fas fa-info-circle" style="cursor: pointer;" onclick="alert($(window).width());"></i></div>\
                                    </div></div>\
                                    <div class="item-body card-body" style="background-color:rgb(185, 253, 255);">\
                                        <div class="thumb-holder" style="text-align:center;">\
                                            <img src="/images/'+ img + '" alt="Ảnh <3" height="' + $(window).width() / 7 + 'px" style="border-radius: 4px;max-width:100%;">\
                                        </div>\
                                        <div style="text-align: center;">\
                                            <h4><i>'+ (item.price).toLocaleString('it-IT', {style: 'currency', currency: 'VND'}) + '</i></h4>\
                                        </div>\
                                        <button class="btn btn-primary add-item" type="button" value="'+ item.id_product + '|`|' + item.name + '|`|' + item.price + '|`|' + item.size + '"\
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

        $(document).on('change', '#select-category', function (event) {
            event.preventDefault();
            showData($('#select-category').val(), $('#search-product').val().trim());
        })
        $(document).on('click', '.button-search', function (event) {
            event.preventDefault();
            showData($('#select-category').val(), $('#search-product').val().trim());
        })
        $(document).on('click', '.add-item', function (event) {
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

        $(document).on('click', '#product-payment', function (event) {
            event.preventDefault();
            $('#modal-product-payment').modal('show');
        })

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
                success: function (res) {
                    $('#list-product').html('');
                    $.each(res.product, function (index, item) {
                        let img = 'system/No_image_available.png';
                        if (item.image != '') img = 'product/' + item.image;
                        $('#list-product').append(
                            '<div class="col-lg-3 col-6">\
                                <div class="card card-warning card-outline">\
                                    <div class="card-header" style="background-color:rgb(128, 198, 255);">\
                                        <div class="row"><div class="card-title col-11" style="white-space: nowrap;width: 100%;overflow: hidden;text-overflow: ellipsis;"><b>'+ item.name + '</b></div>\
                                        <div class="col-1" style="float:right;"><i class="fas fa-info-circle" style="cursor: pointer;" onclick="alert($(window).width());"></i></div>\
                                    </div></div>\
                                    <div class="item-body card-body" style="background-color:rgb(185, 253, 255);">\
                                        <div class="thumb-holder" style="text-align:center;">\
                                            <img src="/images/'+ img + '" alt="Ảnh <3" height="' + $(window).width() / 7 + 'px" style="border-radius: 4px;max-width:100%;">\
                                        </div>\
                                        <div style="text-align: center;">\
                                            <h4><i>'+ (item.price).toLocaleString('it-IT', {style: 'currency', currency: 'VND'}) + '</i></h4>\
                                        </div>\
                                        <button class="btn btn-primary add-item" type="button" value="'+ item.id_product + '|`|' + item.name + '|`|' + item.price + '"\
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
        window.addEventListener('resize', function (event) {
            console.log($(window).width())
            fetchData();
        }, true);
    });
</script>
@endsection
