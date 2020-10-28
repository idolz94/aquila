@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Chi tiết nhóm</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Nhóm</li>
                    </ol>
                </div> 
                <div class="col-12 mt-2">
                    <a  href="{{ URL::previous() }}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Nhóm</h6>
                                <p class="text-muted">
                                    {{$nhom->ten}}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <h6>Trưởng nhóm</h6>
                                <p class="text-muted">{{$nhom->truongnhom->ten}}</p>
                            </div>
                            <div class="col-md-4">
                                <h6>Ngày bắt đầu - Ngày kết thúc</h6>
                                <p class="text-muted">
                                    {{$nhom->ngay_bat_dau}} -/- {{$nhom->ngay_ket_thuc}}
                                </p>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <h6>Ghi chú</h6>
                                <p class="text-muted">{{$nhom->ghi_chu}}</p>
                                <h6>Kết quả</h6>
                                <p class="text-muted">{{$nhom->ket_qua}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title flex-grow-1"><i class="fas fa-users"></i> Danh sách học viên</h3>
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <table id="list_hv" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mã học viên</th>
                                        <th>Tên học viên</th>
                                        <th>Ảnh học viên</th>
                                        <th>Ngày vào nhóm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hocviens as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->ma_hoc_vien}}</td>
                                            <td>{{$item->ten}}</td>
                                            <td>
                                            @if($item->avatar_url !== NULL)
                                                <img class="profile-user-img img-circle" src="{{"/storage/uploads/user_avatar/icon128/".$item->avatar_url}}" alt=""></td>
                                            @else 
                                                <img class="profile-user-img img-circle" src="/admin_assets/images/logo/logo-aq-h.png" alt=""></td>
                                            @endif    
                                            </td>
                                            <td>{{$item->pivot->created_at->format('d-m-Y')}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                  
            </div>
        </div>
     
    </section>

@endsection
@section('scripts')
<script>
        $(function() {
            // data table
            let dataTable = $('#list_hv').DataTable({
                "language": {
                    "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
                },
                "columnDefs": [{
                        'targets': 0,
                        'class': "text-center align-middle"
                    },{
                        'targets': 1,
                        'class': "text-center align-middle"
                    },
                    {
                        'targets': 2,
                        'class': "text-center align-middle"
                    },
                    {
                        'targets': 3,
                        'class': "text-center align-middle",
                        'sortable': false
                    },
                    {
                        'targets': 4,
                        'class': "text-center align-middle",
                        'sortable': false
                    }
                ],
                "paging": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true
            });

            dataTable.on( 'order.dt search.dt', function () {
                dataTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        });
    </script>
@endsection