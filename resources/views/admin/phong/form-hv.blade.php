@extends('admin.layouts.index')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-6 mb-3">
                    <h1>Thêm học viên vào phòng: {{$phong->ten_phong}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Phòng ở</li>
                    </ol>
                </div>
                <div class="col-lg-12">
                    <a  href="{{ URL::previous() }}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
                <!-- ./col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <form action="" id="frm-addhv"  role="form" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title flex-grow-1"><i class="fas fa-users"></i> Danh sách học viên</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" value="{{$phong->id}}" name="id"  id="id">
                                <div class="row">
                                    <div class="col-md-12">
                                        <br>
                                        <table class="table table-bordered" id="list_hv">
                                            <thead>                  
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>Mã học viên</th>
                                                    <th>Ảnh học viên</th>
                                                    <th>Họ và tên học viên</th>
                                                    <th>Tích thêm học viên</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($hocviens as $item)
                                                    <tr>
                                                        <td></td>
                                                        <td>{{$item->ma_hoc_vien}}</td>
                                                        <td>
                                                        @if($item->avatar_url !== NULL)
                                                            <img class="profile-user-img img-fluid img-circle" src="{{"/storage/uploads/user_avatar/icon128/".$item->avatar_url}}" alt=""></td>
                                                        @else 
                                                            <img class="profile-user-img img-fluid img-circle" src="/admin_assets/images/logo/logo-aq-h.png" alt=""></td>
                                                        @endif
                                                        </td>
                                                        <td>{{$item->ten}}</td>
                                                        <td data-id="{{$item->id}}" class="hv_item"> 
                                                            {{$item->id}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-4 text-right">
                        <a href="{{ URL::previous() }}"  class="btn btn-default mr-2"><i class="fas fa-times"></i> Huỷ bỏ</a>
                        <button type="submit" class="btn btn-info btn-updateForm"><i class="fas fa-save"></i> Lưu thông tin</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div class="mess-data"
        data-url-add="{{ route('admin.phong.post.hv') }}">
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

            let user_avatar = $('.user_avatar');
            // show image avatar

            for( let i=0; i< user_avatar.length; i++){
                let url_image = user_avatar[i].getAttribute('data-src-image');
                let dir_path = window.location.origin + "/storage/uploads/user_avatar/icon128/" + url_image;
                user_avatar[i].setAttribute("src", dir_path);
            }   

            // data table
            let dataTable = $('#list_hv').DataTable({
                "language": {
                    "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
                },
                "columnDefs": [{
                        'targets': 0,
                        'class': "text-center align-middle",
                        'width':'20%'
                    },{
                        'targets': 1,
                        'class': "text-center align-middle",
                        'width':'20%'
                    },
                    {
                        'targets': 2,
                        'class': "text-center align-middle",
                        'width':'20%',
                        'sortable': false
                    },
                    {
                        'targets': 3,
                        'class': "text-center align-middle",
                        'width':'20%'
                    },
                    {
                        'targets': 4,
                        'class': "text-center align-middle",
                        'width':'20%',
                        'checkboxes': {
                            'selectRow': true
                        },
                        'sortable': false
                    }
                ],
                'select': {
                    'style': 'multi'
                },
                'order': [[1, 'asc']],
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
            $('#frm-addhv').on('submit',function(e){

                e.preventDefault();
                let url_add = $('.mess-data').data('url-add'); 
                let id = $('#id').val(); 
                let rows_selected = dataTable.column(4).checkboxes.selected();
                console.log(rows_selected);
                let list_hv_id=[];

                $.each(rows_selected, function(index, rowId){
                    // push id to array
                    list_hv_id.push(rowId);
                });

                console.log(list_hv_id);

                $.ajax({
                    url: url_add,
                    type: 'POST',
                    data: {
                        hoc_vien_id: list_hv_id,
                        id:id
                    },
                    success: result => {
                        Swal.fire({
                            title: 'Thêm thành công!',
                            text: 'Chuyển sang danh sách học viên.',
                            type: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                            }).then((result) => {
                            if (result.value) {
                                window.location.href = `/phong/${id}`; 
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