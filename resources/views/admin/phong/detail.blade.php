@extends('admin.layouts.index')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-lg-12 mb-2">
                    <h5 class="mb-2">Danh sách học viên phòng: <strong>{{$phong->ten_phong}}</strong> </h5>
                    @if($phong->truongphong !== NULL)
                        <h5>Trưởng phòng : <strong>{{$phong->truongphong->ten}}</strong> </h5>
                    @endif
                </div>
                <div class="col-lg-12">
                    <a  href="/phong" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
                <!-- ./col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
            <!-- col -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title flex-grow-1"><i class="fas fa-users"></i> Danh sách học viên</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="detail_phong" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Mã học viên</th>
                                        <th>Ảnh học viên</th>
                                        <th>Tên học viên</th>
                                        <th>Ngày vào phòng</th>
                                        <th>Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($phong->hocvien()->wherePivot('type',1)->get() as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>                                      
                                        <td>{{$item->ma_hoc_vien}}</td>
                                        <td>
                                            <img class="user_avatar" src="" data-src-image="{{$item->avatar_url}}" />
                                        </td>
                                        <td>{{$item->ten}}</td>
                                        <td>{{$item->pivot->created_at->format('d-m-Y')}}</td>
                                        <td>
                                            <button class="btn btn-default update_roomhv btn-block btn-sm"  data-id="{{$item->id}}">
                                                <i class="fas fa-sign-out-alt"></i> Chuyển phòng
                                            </button>
                                            <a href="{{route('admin.phong.show.hocvien',$item->id)}}" class="btn btn-info btn-block btn-sm">
                                                <i class="fas fa-info-circle"></i> Lịch sử chuyển
                                            </a>
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
    </section>
    <div class="mess_data"
        data-url-edit="#">
    </div>
    @component('admin.components.modals.edit-modal')
        @slot('title')
            Cập nhật chuyển phòng học viên
        @endslot
        @slot('form')
            <form 
                action="{{route('admin.phong.chuyenphong')}}" 
                id="move_student_room" 
                role="form" 
                method="post"
                data-url-index="#">
                @csrf
                <input type="hidden" name="phong_old" value="{{$phong->id}}">
                <input type="hidden" name="hoc_vien_id" value="">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group d-flex flex-column">
                                <label>Phòng mới <span class="text-danger">*</span></label>
                                <select name="phong_new" id="new_room" class="form-control select2_form">
                                    @foreach($phongAll as $phong)
                                        <option value="{{$phong->id}}">{{$phong->ten_phong}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" role="alert"></span>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Lí do chuyển phòng <span class="text-danger">*</span></label>
                                <input type="text" name="ly_do" class="form-control" placeholder="Lí do chuyển phòng ở" required>
                                <span class="text-danger" role="alert"></span>
                            </div>
                        </div>
                    </div>
                   <!-- end row -->
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Hủy bỏ</button>
                    <button type="submit" class="btn btn-success float-right comfirm_request"><i class="fas fa-save"></i> Lưu thông tin</button>
                </div>
            </form>
        @endslot
    @endcomponent
@endsection
@section('scripts')
    <script>
        $(function() {
            // select 2

            $('#new_room').select2();

            let user_avatar = $('.user_avatar');
            // show image avatar
            for( let i=0; i< user_avatar.length; i++){
                let url_image = user_avatar[i].getAttribute('data-src-image');
                let dir_path = window.location.origin + "/storage/uploads/user_avatar/icon128/" + url_image;
                user_avatar[i].setAttribute("src", dir_path);
            }
            
            
            // data table
            $('#detail_phong').DataTable({
                "language": {
                    "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
                },
                'columnDefs': [{
                        'targets': 0,
                        'sortable': false,
                        'class': 'text-center align-middle'
                    },
                    {
                        'targets': 1,
                        'class': 'text-center align-middle'
                    },
                    {
                        'targets': 2,
                        'class': 'text-center align-middle'
                    },
                    {
                        'targets': 3,
                        'class': 'text-center align-middle'
                    },
                    {
                        'targets': 4,
                        'class': 'text-center align-middle'
                    },
                    {
                        'targets': 5,
                        'class': 'text-center align-middle'
                    }
                ],
                "paging": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true
            });
        });

        // open modal update room
        $('body').on('click', '.update_roomhv', function(event) {
            event.preventDefault();
            let data = $(this).data('id');
            let url_update = $('.mess_data').data('url-edit');
            let random = Math.random().toString(36).substring(2) + (new Date()).getTime().toString();
            let random_string = `${random}_${data}`;
            $('input[name="hoc_vien_id"]').attr('value',random_string);
            $('#modal-edit').modal('show', { backdrop: 'true' });
        });
        /* edit */

        $('body').on('click', '#modal-edit .comfirm_request', e => {
            $('#move_student_room').submit();
        })
    </script>
@endsection