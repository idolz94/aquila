@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Danh sách học viên thuộc hướng nghiệp: <strong>{{$huongnghiep->ten}}</strong> </h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Hướng nghiệp</li>
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
                        <div id="listhv_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <table id="list_hv" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Mã Học Viên</th>
                                        <th>Tên Học Viên</th>
                                        <th>Ảnh Học Viên</th>
                                        <th>Ngày Vào nhóm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($huongnghiep->hocvien as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->ma_hoc_vien}}</td>
                                            <td>{{$item->ten}}</td>
                                            <td><img class="user_avatar profile-user-img img-fluid img-circle" src="" data-src-image="{{$item->avatar_url}}" /></td>
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
            let user_avatar = $('.user_avatar');
            // show image avatar
            for( let i=0; i< user_avatar.length; i++){
                let url_image = user_avatar[i].getAttribute('data-src-image');
                let dir_path = ''
                if(url_image == ""){
                    dir_path = window.location.origin + "/admin_assets/images/logo/logo-aq-h.png"
                }else{
                    dir_path =  window.location.origin + "/storage/uploads/user_avatar/icon128/" + url_image;
                }
                user_avatar[i].setAttribute("src", dir_path);
            }

            // data table
            let dataTable = $('#list_hv').DataTable({
                "language": {
                    "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
                },
                "columnDefs": [
                    {
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