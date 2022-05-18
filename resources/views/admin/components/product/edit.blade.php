@extends('admin.layouts.app')
@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm sản phẩm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Thêm sản phẩm</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div style="text-align: center;">
                        <a href="{{ route('admin.manage-product') }}" class="btn btn-outline-primary"><i class="fas fa-list"></i> Danh sách sản phẩm</a>
                    </div>
                    <br>
                </div>
                <div class="col-md-12">
                    @if(session()->has('success'))
                        <div id="alert-success">
                            <div class="alert alert-success" style="text-align: center; font-size: 20px; font-weight: bold;">
                                {{ session()->get('success') }}
                            </div>
                        </div>
                        <script>
                            function timedOut() {
                                document.getElementById("alert-success").innerHTML = "";
                            }
                            // set a timer
                            setTimeout( timedOut , 3000 );
                        </script>
                    @endif
                    <!-- jquery validation -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Thêm <small>Chức vụ mới</small></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @php
                            $category = DB::table('categories')->get();
                            $size = DB::table('sizes')->get();
                            $unit = DB::table('units')->get();
                        @endphp
                        <div class="card-body">
                            <form action="{{ route('admin.update-product', $product->id_product) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tên sản phẩm</label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Nhập tên sản phẩm" value="{{ $product->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Loại</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="id_category">
                                                <option>--Loại--</option>
                                                @foreach($category as $item)
                                                    @if($item->id_category!=$product->id_category)
                                                        <option value="{{ $item->id_category }}">{{ $item->name }}</option>
                                                    @else
                                                        <option value="{{ $item->id_category }}" selected>{{ $item->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kích thước</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="id_size">
                                                <option>--Kích thước--</option>
                                                @foreach($size as $item)
                                                    @if($item->id_size!=$product->id_size)
                                                        <option value="{{ $item->id_size }}">{{ $item->name }} - {{ $item->capacity }}</option>
                                                    @else
                                                        <option value="{{ $item->id_size }}" selected>{{ $item->name }} - {{ $item->capacity }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Đơn vị tính</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="unit">
                                                <option>--ĐVT--</option>
                                                @foreach($unit as $item)
                                                    @if($item->name!=$product->unit)
                                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                    @else
                                                        <option value="{{ $item->name }}" selected>{{ $item->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Đơn giá (VND)</label>
                                            <input type="number" min="0" name="price" class="form-control" id="price"
                                                placeholder="Nhập đơn giá" value="{{ $product->price }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="image">Chọn ảnh</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="image"
                                                        id="image" onchange="imageChange(event);">
                                                    <label class="custom-file-label" for="image">Chọn
                                                        ảnh</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="text-align: center;">
                                        @if($product->image!='')
                                        <img id="image-choosen" src="{{ asset('images/product/'.$product->image) }}" alt="IMAGE" width="128" style="border: 2px solid rgb(100, 66, 255); padding: 5px; border-radius: 4px;">
                                        @else
                                        <img id="image-choosen" src="{{ asset('images/system/No_image_available.png') }}" alt="IMAGE" width="128" style="border: 2px solid rgb(100, 66, 255); padding: 5px; border-radius: 4px;">
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label>Ghi chú</label>
                                        <textarea class="form-control" rows="3" placeholder="Ghi chú" name="description">{{ $product->description }}</textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Cập nhật</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })

        function imageChange(event) {
            const imageInput = document.getElementById('image-choosen');
            imageInput.src = URL.createObjectURL(event.target.files[0]);
            imageInput.onload = function() {
                URL.revokeObjectURL(imageInput.src) // free memory
            }
        }
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection
