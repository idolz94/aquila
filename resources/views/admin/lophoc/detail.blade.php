
@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"> 
                    <h4>Danh sách học viên lớp: <strong>{{$lophoc->ma_lop_hoc}}</strong></h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Học viên </li>
                    </ol>
                </div> 
                <div class="col-12 mt-2">
                <a  href="{{route('admin.lophoc.index')}}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header justify-content-between align-items-center">
                        <h3 class="card-title flex-grow-1"><i class="fas fa-users"></i> Ảnh quá trình lớp học</h3>
                        <div class="col-12 d-flex ">
                            @foreach ($lophoc->anhlophoc as $image)
                             
                            <img src="{{asset(show_original_img(Config::get('images.paths.image_lophoc'),$image->anh_lop_hoc))}}" alt="">
                            @endforeach
                        </div>
                      
                    </div>

                    <div class="card-header">
                        <h3 class="card-title flex-grow-1"><i class="fas fa-users"></i> Danh sách học viên</h3>

                    </div>
                    <div class="card-body">
                        <div class="dataTables_wrapper dt-bootstrap4">
                            <table id="hv_table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Mã học viên</th>
                                        <th>Ảnh học viên</th>
                                        <th>Tên học viên</th>
                                        <th>Ngày sinh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lophoc->hocvien as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->ma_hoc_vien}}</td>
                                            <td>
                                                @if($item->avatar_url !== NULL)
                                                    <img class="profile-user-img img-fluid img-circle" src="{{"/storage/uploads/user_avatar/icon128/".$item->avatar_url}}" alt=""></td>
                                                @else 
                                                    <img class="profile-user-img img-fluid img-circle" src="/admin_assets/images/logo/logo-aq-h.png" alt=""></td>
                                                @endif
                                            <td>{{$item->ten}}</td>
                                            <td>{{date("d-m-Y", strtotime($item->ngay_sinh))}}</td>
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
            let dataTable = $('#hv_table').DataTable({
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
                        'class': "text-center align-middle",
                        'sortable': false
                    },
                    {
                        'targets': 3,
                        'class': "text-center align-middle"
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