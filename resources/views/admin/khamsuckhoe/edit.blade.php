@extends('admin.layouts.index')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4>Sửa thông tin sức khoẻ học viên</h4>
                </div>
                <div class="col-lg-12 mt-2">
                    <a  href="{{ URL::previous() }}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-body box-profile">
                            <div class="detail-profile">
                                <div class="text-center">
                                    <img id="user_avatar" class="profile-user-img img-fluid img-circle"  src="" alt="User profile picture" data-src-image="{{$hocvien->avatar_url}}">
                                </div>
                                <h3 class="profile-username text-center">{{$hocvien->ten}}</h3>
                            </div>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('admin.khamsuckhoe.update',$khamsuckhoes->id)}}"  role="form" method="post" class="mt-3">
                                @csrf
                                <input name="_method" type="hidden" value="PUT">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="mb-2">I. Toàn thân</h5>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Toàn thân(Da, Niêm mạc, Hệ thống hạch,...)</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="toan_than" value="{{$khamsuckhoes->toan_than}}">
                                        </div>
                                    </div> 
                                    <div class="col-md-4 form-group">
                                        <label>Mạch</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="mach" value="{{$khamsuckhoes->mach}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Huyết áp </label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="huyet_ap" value="{{$khamsuckhoes->huyet_ap}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Nhiệt độ</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="nhiet_do" value="{{$khamsuckhoes->nhiet_do}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Cân nặng</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="can_nang" value="{{$khamsuckhoes->can_nang}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Nhịp thở</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="nhip_tho" value="{{$khamsuckhoes->nhip_tho}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="mb-2">II. Các cơ quan</h5>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Hô hấp</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="ho_hap" value="{{$khamsuckhoes->ho_hap}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Tuần hoàn</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="tuan_hoan" value="{{$khamsuckhoes->tuan_hoan}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Tiêu hoá</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="tieu_hoa" value="{{$khamsuckhoes->tieu_hoa}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Thận - tiết niệu, sinh dục</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="tiet_nieu_sinh_duc" value="{{$khamsuckhoes->tiet_nieu_sinh_duc}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Mắt</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="mat" value="{{$khamsuckhoes->mat}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="mb-2"> III. Tâm thần</h5>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Biểu hiện chung</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="bieu_hien_chung" value="{{$khamsuckhoes->bieu_hien_chung}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Biểu hiện khác</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="bieu_hien_khac" value="{{$khamsuckhoes->bieu_hien_khac}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="mb-2">IV. Xét nghiệm ma tuý trong nước tiểu & tóm tắt bệnh án</h5>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Xét nghiệm ma tuý trong nước tiểu</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="test_nhanh" value="{{$khamsuckhoes->test_nhanh}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Tóm tắt bệnh án</label>
                                        <div class="input-group mb-3">
                                            <textarea name="noi_dung" id="event_content" class="form-control" rows="4">{{$khamsuckhoes->noi_dung}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-default mr-2"><i class="fas fa-times"></i> Huỷ bỏ</button>
                                    <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Lưu thông tin</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                
                </div>
                <div class="col-lg-12 mb-4 text-right">
                    
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    {{ Html::script(mix('admin/khamsuckhoe.js')) }}
    <script>
        $(function() {
        let user_avatar = $('#user_avatar');
        // show image avatar
        let url_image = user_avatar.attr('data-src-image');
        let dir_path
        if(url_image == ""){
            dir_path = window.location.origin + "/admin_assets/images/logo/logo-aq-h.png";
        }else{
            dir_path =  window.location.origin + "/storage/uploads/user_avatar/icon128/" + url_image;
        }
        user_avatar.attr("src", dir_path);   
        }); 
    </script>   
@endsection