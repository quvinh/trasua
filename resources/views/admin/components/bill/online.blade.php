@extends('admin.layouts.app')

@section('css')
@include('admin.layouts.css')
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Đơn Online</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Đơn Online</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách đơn hàng</h3>
                </div>
                @if(session()->has('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session()->get('success') }}
                </div>
                @endif
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Đơn hàng</th>
                                <th>Tên đăng nhập</th>
                                <th>Khách hàng</th>
                                <th>Điện thoại</th>
                                <th>Ngày đặt</th>
                                <th>Thành tiền</th>
                                <th>Trạng thái</th>
                                <th style="max-width: fit-content;">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $bills = DB::table('order_bills')
                            ->join('orders', 'order_bills.id_order', '=', 'orders.id_order')
                            ->join('users', 'orders.created_by', '=', 'users.id')
                            ->select('order_bills.id_bill as id_bill', 'users.name as name', 'users.username as username', 'users.phone as phone')
                            ->orderByDesc('id_bill')
                            ->distinct()
                            ->get();
                            @endphp
                            @foreach($bills as $item)
                            @php
                            $bill = DB::table('bills')->where('id_bill', $item->id_bill)->first();
                            @endphp
                            <tr>
                                <th># {{ $bill->id_bill }}</th>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ date("d/m/Y H:i:s", strtotime($bill->created_at)) }}</td>
                                <td>{{ number_format($bill->payment, 0, '', ',').' đ' }}</td>
                                @if($bill->status == 0)
                                <td><span class="badge badge-warning">Chờ xác nhận</span></td>
                                <td>
                                    <a href="{{ route('admin.online.delivery', $item->id_bill) }}" class="btn btn-sm btn-info" title="Xác nhận và Giao hàng"><i class="fas fa-truck"></i> Xác nhận</a>
                                    <a href="{{ route('admin.online.cancle', $item->id_bill) }}" class="btn btn-sm btn-danger" title="Hủy đơn hàng"><i class="fas fa-times-circle"></i></a>
                                    <a href="{{ route('admin.online.undo', $item->id_bill) }}" class="btn btn-sm btn-secondary" title="Khôi phục đơn hàng"><i class="fas fa-undo"></i></a>
                                </td>
                                @elseif($bill->status == 1)
                                <td><span class="badge badge-info">Đang giao</span></td>
                                <td>
                                    <a href="{{ route('admin.online.complete', $item->id_bill) }}" class="btn btn-sm btn-success" title="Hoàn thành giao và đơn hàng"><i class="fas fa-check-square"></i> Hoàn thành</a>
                                    <a href="{{ route('admin.online.cancle', $item->id_bill) }}" class="btn btn-sm btn-danger" title="Hủy đơn hàng"><i class="fas fa-times-circle"></i></a>
                                    <a href="{{ route('admin.online.undo', $item->id_bill) }}" class="btn btn-sm btn-secondary" title="Khôi phục đơn hàng"><i class="fas fa-undo"></i></a>
                                </td>
                                @elseif($bill->status == 2)
                                <td><span class="badge badge-success">Hoàn thành</span></td>
                                <td>
                                    <a href="{{ route('admin.online.cancle', $item->id_bill) }}" class="btn btn-sm btn-danger" title="Hủy đơn hàng"><i class="fas fa-times-circle"></i></a>
                                    <a href="{{ route('admin.online.undo', $item->id_bill) }}" class="btn btn-sm btn-secondary" title="Khôi phục đơn hàng"><i class="fas fa-undo"></i></a>
                                </td>
                                @elseif($bill->status == 3)
                                <td><span class="badge badge-danger">Đã hủy</span></td>
                                <td>
                                    <a href="{{ route('admin.online.undo', $item->id_bill) }}" class="btn btn-sm btn-secondary" title="Khôi phục đơn hàng"><i class="fas fa-undo"></i></a>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                        <!-- <tfoot>
                        </tfoot> -->
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
@include('admin.layouts.script')
@include('admin.layouts.scriptDataTable')
<script>
    $(document).ready(function() {
        $("#table").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
    })
</script>
@endsection