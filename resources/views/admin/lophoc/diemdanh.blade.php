
@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"> 
                    <h4>Danh sách điểm danh lớp</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Điểm danh </li>
                    </ol>
                </div> 
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form id="lophoc_form" action="{{route('admin.lophoc.diemdanh.list')}}"  role="form" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Danh sách lớp</label>
                                <select id="filter_lophoc" name="id"  class="form-control">
                                    <option onclick="event.preventDefault();">Vui lòng chọn lớp học</option>
                                    @foreach($lops as $lop)
                                        <option value="{{$lop->id}}">{{$lop->ma_lop_hoc}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-none" id="hv_table_wrapper">
                <div class="card">
                    <div class="card-body">
                        <table id="hv_table" class="table table_filter table-bordered table-responsive-md table-responsive-sm">
                            <thead>                  
                                <tr>
                                    <th width="20px" class="align-middle text-center">Stt</th>
                                    <th class="align-middle text-center">Mã học viên</th>
                                    <th class="align-middle text-center">Ảnh học viên</th>
                                    <th class="align-middle text-center">Học viên</th>
                                    <th class="align-middle text-center">Tổng số điểm danh</th>
                                    <th class="align-middle text-center">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody class="filter_show">
                                    <tr>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="lds-ellipsis d-none"><div></div><div></div><div></div><div></div></div>
    <div class="mess-data"
        data-url-filter="{{ route('admin.lophoc.filter') }}"
        >
    </div>
@endsection
@section('scripts')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let url_filter = $('#lophoc_form').attr('action');
            let id = location.search.split('?')[1];
            console.log(id);
            if(id !== undefined){
                $.ajax({
                    url: url_filter,
                    type: 'POST',
                    data: { 
                        id: id,
                    },
                    beforeSend: function() {
                        $('.lds-ellipsis').show();
                    },
                    complete: function() {
                        $('.lds-ellipsis').hide();
                    },
                    success: function(result) {
                   
                        if (result.message.length > 0) {
                            filterClass(result.message);
                            $('#hv_table').removeClass('d-none');
                            $('#table_wrapper').addClass('d-none');
                            $('#table_filter').addClass('d-block');
                        } else {
                            Swal.fire({
                                type: 'warning',
                                title: 'Hiện tại chưa có điểm danh cho lớp học này !'
                            })
                        }
                    },
                    error: function(xhr, thrownError) {
                        if (xhr.status == 500) {
                            $('.card-error').removeClass('d-none');
                            $('.card-success-data').addClass('d-none');
                        }
                        console.log(thrownError);
                    }
                });
            }
            let table_id = '';
            /* select2 lophoc */
            $('#filter_lophoc').select2();
            /* filter lophoc */
            $('#filter_lophoc').on('change', function() {
                let lophoc_id = $(this).val();

                $.ajax({
                    url: url_filter,
                    type: 'POST',
                    data: { 
                        id: lophoc_id,
                    },
                    beforeSend: function() {
                        $('.lds-ellipsis').show();
                    },
                    complete: function() {
                        $('.lds-ellipsis').hide();
                    },
                    success: function(result) {
                   
                        if (result.message.length > 0) {
                            filterClass(result.message);
                            $('#hv_table_wrapper').removeClass('d-none');
                            $('#table_wrapper').addClass('d-none');
                            $('#hv_table_wrapper').addClass('d-block');
                        } else {
                            Swal.fire({
                                type: 'warning',
                                title: 'Hiện tại chưa có điểm danh cho lớp học này !'
                            })
                        }
                    },
                    error: function(xhr, thrownError) {
                        if (xhr.status == 500) {
                            $('.card-error').removeClass('d-none');
                            $('.card-success-data').addClass('d-none');
                        }
                        console.log(thrownError);
                    }
                });
            });

            function filterClass(dataset) {
                let tbody = $('.filter_show');
                let arr_lh = '';
                let count = 1;
                if (tbody.empty()) {
                    dataset.forEach(element => {
                        arr_lh += `<tr>
                        <td class="align-middle text-center">${count++}</td>
                        <td class="align-middle text-center">${element.ma_hoc_vien}</td>
                        <td class="align-middle text-center">
                            <img class="profile-user-img img-fluid img-circle user_avatar" src="/admin_assets/images/logo/logo-aq-h.png" data-src-image="${element.avatar_url}" />
                        </td>
                        <td class="align-middle text-center">${element.ten}</td>
                        <td class="align-middle text-center">${element.diem_danh}</td>
                        <td class="align-middle text-center">
                            <a href="/lophoc/diemdanh/show/${element.id}/${element.lop_hoc_id}" class="btn btn-info"> <i class="fas fa-info-circle"></i> Xem chi tiết</a>
                        </td>
                    </tr>`;
                    // xem chi tiet diem danh vao route
                    //  admin.lophoc.diemdanh.show',idhocvien,idlophoc
                    });
                    tbody.append(arr_lh);                   
                };
                let user_avatar = $('.user_avatar');
                // show image avatar
                for( let i=0; i< user_avatar.length; i++){
                    let url_image = user_avatar[i].getAttribute('data-src-image');
                    let dir_path = ''
                    if( url_image !== 'null' ){
                        dir_path =  window.location.origin + "/storage/uploads/user_avatar/icon128/" + url_image;
                        user_avatar[i].setAttribute("src", dir_path);
                    }  
                }
            };
        });
    </script>
@endsection