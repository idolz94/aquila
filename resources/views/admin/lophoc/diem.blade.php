
@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"> 
                    <h4>Danh sách điểm</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Điểm </li>
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
                        <form  id="lophoc_form" action="{{route('admin.lophoc.diem.lydo')}}"  role="form" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Danh sách lớp</label>
                                <select id="filter_lophoc" name="lop_hoc_id"  class="form-control">
                                    <option class="opt_rm" value="#" onclick="event.preventDefault();">Vui lòng chọn lớp học</option>
                                    @foreach($lops as $lop)
                                        <option value="{{$lop->id}}">{{$lop->ma_lop_hoc}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Danh sách lý do điểm</label>
                                <select id="filter_lophoc_lido" name="ly_do_id"  class="form-control" disabled>
                                    <option  onclick="event.preventDefault();">Vui lòng chọn lý do điểm</option>
                                    @foreach($ly_dos as $lydo)
                                        <option value="{{$lydo->id}}">{{$lydo->ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-none" id="filter-table">
              <div class="card">
                <div class="card-body">
                    <table id="hv_table" class="table table-bordered table-responsive-md table-responsive-sm">
                        <thead class="text-center">                  
                            <tr>
                                <th width="20px">Stt</th>
                                <th>Mã học viên</th>
                                <th>Ảnh học viên</th>
                                <th>Học viên</th>
                                <th>Điểm số</th>
                            </tr>
                        </thead>
                        <tbody class="filter_show text-center">
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

            /* select2 lophoc */
            $('#filter_lophoc').select2();
            $('#filter_lophoc').on('change', function(){
                let lophoc_id = $(this).val();
                if( lophoc_id != '#' ){
                    $('#filter_lophoc_lido').removeAttr('disabled');
                    $('.opt_rm').remove();
                }
            });

            /* filter lophoc diem li do */
            $('#filter_lophoc_lido').on('change', function() {
                let lophoc_id = $('#filter_lophoc').val(),
                    lido_diem = $(this).val();

                let url_filter = $('#lophoc_form').attr('action');
                $.ajax({
                    url: url_filter,
                    type: 'POST',
                    data: { 
                        lop_hoc_id: lophoc_id,
                        ly_do_id:lido_diem,
                        
                    },
                    beforeSend: function() {
                        $('.lds-ellipsis').show();
                    },
                    complete: function() {
                        $('.lds-ellipsis').hide();
                    },
                    success: function(result) {
                        console.log(result);
                        if( result.length){
                            console.log('success');
                            filterClass(result[0]);
                            $('#filter-table').removeClass('d-none');
                            $('#filter-table').addClass('d-block');
                        } else{
                            Swal.fire({
                                type: 'warning',
                                title: 'Hiện tại chưa có điểm cho lớp học này!'
                            })
                        }
                        
                    },
                    error: function(xhr, thrownError) {
                        if (xhr.status == 500) {
                            $('.card-error').removeClass('d-none');
                            $('.card-success-data').addClass('d-none');
                        }
                    }
                });
            });

            function filterClass(dataset) {
                let tbody = $('.filter_show');
                let arr_lh = '';
             
                let stt = 0;
                if (tbody.empty()) {
                    let stt= 1;
                    dataset.forEach(element => {
                        let arr_diem = '';

                        element.diem.forEach(diem =>{
                            arr_diem+=`
                                <li>${diem}</li>
                            `;
                        });
                        arr_lh += `<tr>
                        <td class="align-middle">
                            ${stt++ }
                        </td>
                        <td class="align-middle">${element.ma_hoc_vien}</td>
                        <td class="align-middle">
                            <img class="profile-user-img img-fluid img-circle user_avatar" src="/admin_assets/images/logo/logo-aq-h.png" data-src-image="${element.avatar_url}" />
                        </td>
                        <td class="align-middle">${element.ten}</td>
                        <td class="text-left align-top">
                            <strong>${arr_diem}</strong>
                        </td>
                    </tr>`;
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