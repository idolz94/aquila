@extends('admin.layouts.index')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Cập nhật thông tin sức khoẻ học viên</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/khamsuckhoe">Khám sức khoẻ</a></li>
                        <li class="breadcrumb-item active"> Cập nhật sức khoẻ học viên</li>
                    </ol>
                </div> 
                <div class="col-lg-12 mt-2">
                    <a  href="{{ URL::previous() }}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
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
                            <form action="{{ route('admin.khamsuckhoe.store')}}"  role="form" method="post" class="mt-3">
                                @csrf
                                <input type="hidden" name="hoc_vien_id" value="{{$hocvien->id}}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="mb-2">I. Toàn thân</h5>
                                    </div>
                                    <div class=" col-md-4 form-group">
                                        <label>Toàn thân(Da, Niêm mạc, Hệ thống hạch, ...)</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="toan_than" placeholder="(da, niêm mạc, hệ thống hạch, tuyến giáp)">
                                        </div>
                                    </div> 
                                    <div class=" col-md-4 form-group">
                                        <label>Mạch</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="mach" placeholder="Lần/phút">
                                        </div>
                                    </div>
                                    <div class=" col-md-4 form-group">
                                        <label>Huyết áp </label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="huyet_ap" placeholder="mHg">
                                        </div>
                                    </div>
                                    <div class=" col-md-4 form-group">
                                        <label>Nhiệt độ</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="nhiet_do" placeholder="oC">
                                        </div>
                                    </div>
                                    <div class=" col-md-4 form-group">
                                        <label>Cân nặng</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="can_nang" placeholder="kg">
                                        </div>
                                    </div>
                                    <div class=" col-md-4 form-group">
                                        <label>Nhịp thở</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="nhip_tho" placeholder="lần/phút">
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
                                            <input type="text" class="form-control" name="ho_hap" placeholder="lần/phút">
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Tuần hoàn</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="tuan_hoan" placeholder="lần/phút">
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Tiêu hoá</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="tieu_hoa" placeholder="Tiêu hoá">
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Thận - tiết niệu, sinh dục</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="tiet_nieu_sinh_duc" placeholder="Thận - tiết niệu, sinh dục">
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Mắt</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="mat" placeholder="Mắt">
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
                                            <input type="text" class="form-control" name="bieu_hien_chung" placeholder="Biểu hiện chung(tỉnh táo, lẫn lộn, bực dọc, trầm cảm ...)">
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Biểu hiện khác</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="bieu_hien_khac" placeholder="Biểu hiện khác">
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
                                            <input type="text" class="form-control" name="test_nhanh" placeholder="Test nhanh" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Tóm tắt bệnh án</label>
                                        <div class="input-group mb-3">
                                            <textarea name="noi_dung" id="event_content" class="form-control" rows="4" placeholder="Tóm tắt bệnh án ..."></textarea>
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
        let dir_path = ""
        if(url_image == ""){
            dir_path = window.location.origin + "/admin_assets/images/logo/logo-aq-h.png";
        }else{
            dir_path =  window.location.origin + "/storage/uploads/user_avatar/icon128/" + url_image;
        }
        user_avatar.attr("src", dir_path);   
        }); 
    </script>
@endsection