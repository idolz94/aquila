@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm học viên vào nhóm</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Nhóm</li>
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
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title flex-grow-1"><i class="fas fa-users"></i> Danh sách học viên</h3>
                    </div>
                    <div class="card-body">
                        <form id="frm-addhv" role="form">
                            @csrf
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
                                            @foreach ($list_hv as $hocvien)
                                                <tr>
                                                    <td></td>
                                                    <td>{{$hocvien->ma_hoc_vien}}</td>
                                                    <td>
                                                    @if($hocvien->avatar_url !== NULL)
                                                        <img class="profile-user-img img-circle" src="{{"/storage/uploads/user_avatar/icon128/".$hocvien->avatar_url}}" alt=""></td>
                                                    @else 
                                                        <img class="profile-user-img img-circle" src="/admin_assets/images/logo/logo-aq-h.png" alt=""></td>
                                                    @endif
                                                    </td>
                                                    <td>{{$hocvien->ten}}</td>
                                                    <td> 
                                                        {{$hocvien->id}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                
                                </div>
                                <div class="col-lg-12 mb-4 text-right mt-3">
                                    <a href="{{ URL::previous() }}" class="btn btn-default mr-2"><i class="fas fa-times"></i> Huỷ bỏ</a>
                                    <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Lưu thông tin</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- ./card-body -->
                </div>
            </div>
        </div>
    </section>
    <div class="mess-data"
        data-url-add="{{ route('admin.nhom.hocvien.post', 'ID_REPLY_IN_URL') }}"
        data-nhom-id="{{$nhom->id}}"
        >
    </div>
@endsection
@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function() {
            
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
                        'checkboxes': {
                            'selectRow': true
                        },
                        'sortable': false
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
            let nhom_id = $('.mess-data').data('nhom-id');
            let url_add = $('.mess-data').data('url-add').replace('ID_REPLY_IN_URL', nhom_id);

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
                        id: nhom_id,
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
                                window.location = '/nhom'; 
                            }
                        });
                        
                    },
                    error: data => {
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