@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Thêm học viên vào hướng nghiệp: <strong>{{$huongnghiep->ten}}</strong> </h4>
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
                <form action=""  id="frm-addhv"  role="form" method="post" data-id="{{$huongnghiep->id}}">
                    @csrf
                <input type="hidden" name="id" value="{{$huongnghiep->id}}">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-users"></i> Danh sách học viên</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="hv_table" class="table table-bordered">
                                                <thead>                  
                                                    <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>Mã học viên</th>
                                                        <th>Ảnh học viên</th>
                                                        <th>Học viên</th>
                                                        <th>Thêm Học Viên</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($hocviens as $hocvien)
                                                        @if(count($hocvien->huongnghiep()->wherePivot('huong_nghiep_id',$huongnghiep->id)->get()) == 0)
                                                        <tr>
                                                            <td></td>
                                                            <td>{{$hocvien->ma_hoc_vien}}</td>
                                                            <td>
                                                                <img class="user_avatar profile-user-img img-fluid img-circle" src="" data-src-image="{{$hocvien->avatar_url}}" />
                                                            </td>
                                                            <td>{{$hocvien->ten}}</td>
                                                            <td> 
                                                                {{$hocvien->id}}
                                                            </td>
                                                        </tr>
                                                        @endif
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
                        <a href="{{ URL::previous() }}" class="btn btn-default mr-2"><i class="fas fa-times"></i> Huỷ bỏ</a>
                        <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Lưu thông tin</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div class="mess-data"
        data-url-add="{{ route('admin.huongnghiep.post.hv','ID_REPLY_IN_URL') }}"
        >
    </div>
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
                        'sortable': false,
                        'checkboxes': {
                            'selectRow': true
                        },
                    }
                ],
                'select': {
                    'style': 'multi'
                },
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

            // form add hoc vien
            let lophoc_id = $('#frm-addhv').data('id');
            let url_add = $('.mess-data').data('url-add').replace('ID_REPLY_IN_URL', lophoc_id);

            $('#frm-addhv').on('submit',function(e){
                e.preventDefault();
                let rows_selected = dataTable.column(4).checkboxes.selected();
                let list_hv_id=[];

                $.each(rows_selected, function(index, rowId){
                    // push id to array
                    list_hv_id.push(rowId);
                });

                $.ajax({
                    url: url_add,
                    type: 'POST',
                    data: {
                        hoc_vien_id: list_hv_id 
                    },
                    success: result => {
                        Swal.fire({
                            title: 'Thành công!',
                            text: 'Bấm "OK" để chuyển hướng về danh sách học viên!',
                            type: 'success',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                            }).then((result) => {
                            if (result.value) {
                                window.location = `/huongnghiep-hocvien-list/${lophoc_id}`; 
                            }
                        });
                        
                    },
                    error: data => {
                        console.log(data);
                        return;
                        if (data.status == 422) {
                            showMessErrForm(data.responseJSON.errors);
                        }   
                    },
                    // xhr: progressUpload,
                })

            });
        });
    </script>
@endsection