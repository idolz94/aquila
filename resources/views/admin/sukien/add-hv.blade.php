@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm học viên vào sự kiện</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Sự kiện</li>
                    </ol>
                </div> 
                <div class="col-12 mt-3">
                    <a  href="{{ URL::previous() }}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <section class="content">
        <div class="row">
           
            <div class="col-12">
                <form action="{{route('admin.sukien.hocvien.post')}}"  role="form" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$sukien->id}}">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="card-title flex-grow-1"><i class="fas fa-users"></i> Danh Sách Học Viên</h3>
                                    <div class="dt-buttons btn-group flex-wrap">
                                        <button class="btn btn-info mr-2" id="select_all"><i class="fas fa-check"></i> Chọn tất cả</button>
                                        <button class="btn btn-secondary" id="unselect_all"><i class="fas fa-times"></i> Bỏ chọn tất cả</button> 
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <table id="hv_table" class="table table-bordered">
                                                <thead>                  
                                                    <tr>
                                                        <th style="width: 10px">Stt</th>
                                                        <th>Mã học viên</th>
                                                        <th>Ảnh học viên</th>
                                                        <th>Học viên</th>
                                                        <th>Tích chọn thêm học viên</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($hocviens as $hocvien)
                                                        <tr>
                                                            <td></td>
                                                            <td>{{$hocvien->ma_hoc_vien}}</td>
                                                            <td>
                                                            @if($hocvien->avatar_url !== NULL)
                                                                <img class="user_avatar profile-user-img img-fluid img-circle" src="" data-src-image="{{$hocvien->avatar_url}}" />
                                                            </td>
                                                            @else 
                                                                <img src="/admin_assets/images/logo/logo-aq-h.png" class="user_avatar profile-user-img img-fluid img-circle" alt=""></td>
                                                            @endif
                                                            </td>
                                                            <td>{{$hocvien->ten}}</td>
                                                            <td> 
                                                                <input type="checkbox" name="hoc_vien_id[]" value="{{$hocvien->id}}" class="select">
                                                            </td>
                                                        </tr>
                                                    
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./card-body -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-4 text-right">
                        <button type="submit" class="btn btn-default mr-2"><i class="fas fa-times"></i> Huỷ bỏ</button>
                        <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Lưu thông tin</button>
                    </div>
                </form>
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
            
            $('#select_all').on('click', function(event){
                event.preventDefault();
                let select_all = $('input[name="hoc_vien_id[]"]');
                for(let i = 0; i< select_all.length; i++){
                    select_all[i].checked = true;
                }
            });
            // un select all
            $('#unselect_all').on('click', function(event){
                event.preventDefault();
                let select_all = $('input[name="hoc_vien_id[]"]');
                for(let i = 0; i< select_all.length; i++){
                    select_all[i].checked = false;
                }
            });
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