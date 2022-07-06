@extends('admin.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm công thức</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Thêm công thức</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thêm <small>công thức</small></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
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
                                setTimeout(timedOut, 3000);
                            </script>
                            @endif
                            <form action="{{ route('admin.store-formula') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div style="text-align: right;">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
                                </div>
                                <div class="form-group">
                                    <label for="">Nhập tên công thức</label>
                                    @php
                                    $category = DB::table('categories')->get();
                                    $size = DB::table('sizes')->get();
                                    $unit = DB::table('units')->get();
                                    @endphp
                                    <div class="row">
                                        <div class="col-md-9">
                                            <input type="text" name="nameFormula" class="form-control" id="nameFormula" placeholder="Tên công thức sản phẩm" required>
                                        </div>
                                        <div class="col-md-3" style="text-align: center;">
                                            <select class="form-control select2bs4" style="width: 100%;"
                                                name="id_category">
                                                <option value="">--Loại--</option>
                                                @foreach($category as $item)
                                                <option value="{{ $item->id_category }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9">
                                        <label for="">Nhập các thành phẩm<span class="text-danger" style="font-style: italic;"></span></label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="form-control select2bs4" style="width: 100%;" name="id_size">
                                                <option value="">--Size--</option>
                                                @foreach($size as $item)
                                                <option value="{{ $item->id_size }}">{{ $item->name }} - {{
                                                    $item->capacity
                                                    }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="list-structure">
                                    @for($i = 1; $i <= 5; $i++)
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="name[]" class="form-control" placeholder="Tên thành phẩm {{$i}}">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" name="capacity[]" class="form-control" placeholder="Dung tích {{$i}}">
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-control select2bs4" style="width: 100%;" name="id_unit[]">
                                                    <option value="">--ĐVT {{$i}}--</option>
                                                    @foreach($unit as $item)
                                                    <option value="{{ $item->id_unit }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>    
                                    @endfor
                                </div>
                                <div style="text-align: center;">
                                    <button type="button" id="btn-add-structure" class="btn btn-secondary"><i class="fas fa-plus-circle"></i> Thêm dòng</button>
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
@include('admin.layouts.scriptDataTable')
<!-- bs-custom-file-input -->
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(document).ready(function() {
        var num = 5;
        $('#btn-add-structure').on('click', function() {
            num += 1;
            $('#list-structure').append(
                '<div class="form-group"><div class="row"><div class="col-md-6">\
                    <input type="text" name="name[]" class="form-control" placeholder="Tên thành phẩm ' + num + '">\
                </div>\
                <div class="col-md-3">\
                    <input type="number" name="capacity[]" class="form-control" placeholder="Dung tích ' + num + '">\
                </div>\
                <div class="col-md-3">\
                    <select class="form-control select2bs4" style="width: 100%;" name="id_unit[]">\
                        <option>--ĐVT ' + num + '--</option>\
                        @foreach($unit as $item)\
                        <option value="{{ $item->id_unit }}">{{ $item->name }}</option>\
                        @endforeach\
                    </select>\
                </div></div></div>'
            );
        })
    })
</script>
@endsection