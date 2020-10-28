@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm học viên</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active"> Thêm học viên</li>
                    </ol>
                </div>  
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-12">
                    <form role="form"
                        action=" {{ route('admin.hoc-vien.store') }} "
                        method="post"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-success card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="far fa-user"></i> Thông tin cá nhân <span class="text-danger">*</span></h3>
                                        <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">     
                                        <div class="row">
                                            <!-- ./ col   -->
                                            <div class="col-lg-4 offset-4 mb-3">
                                                <div class="show-fileiamge text-center d-none">
                                                    <img class="img-responsive profile-user-img img-fluid cus-avatar"
                                                    id="avatar"
                                                    src="">
                                                </div>
                                                <div class="form-group file-upload m-auto">
                                                    <label class="input-file-trigger" for="fileupload"><i class="fas fa-file-upload"></i> Tải ảnh <span class="text-danger">*</span></label>
                                                    <input type="file" class="form-control input-file" id="fileupload" placeholder="" name="avatar_hocvien">
                                                    @if($errors->has('avatar_hocvien'))
                                                        <span class="text-danger font-11" role="alert">{{ $errors->first('avatar_hocvien') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label>Họ & tên <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control text-capitalize" Name="ten" id="ipname" value="{{ old('ten') }}" placeholder="Họ và tên học viên" >
                                                            @if($errors->has('ten'))
                                                                <span class="text-danger font-11" role="alert">{{ $errors->first('ten') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label>Ngày sinh </label>
                                                            <input type="date" class="form-control" placeholder="" name="ngay_sinh" value="{{ old('ngay_sinh') }}" id="reservation">
                                                            {{-- @if($errors->has('ngay_sinh'))
                                                            <span class="text-danger font-11" role="alert">{{ $errors->first('ngay_sinh') }}</span>
                                                            @endif --}}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label>Ngày vào trung tâm </label>
                                                            <input type="date" class="form-control" placeholder="" name="ngay_vao" value="{{ old('ngay_vao') }}" id="reservation">
                                                            {{-- @if($errors->has('ngay_vao'))
                                                            <span class="text-danger font-11" role="alert">{{ $errors->first('ngay_vao') }}</span>
                                                            @endif --}}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label>Giới tính </label>
                                                            <select name="gioi_tinh" class="form-control">
                                                                <option value="Nam">Nam</option>
                                                                <option value="Nữ">Nữ</option>
                                                            </select>
                                                            {{-- @if($errors->has('gioi_tinh'))
                                                                <span class="text-danger font-11" role="alert">{{ $errors->first('gioi_tinh') }}</span> --}}
                                                            {{-- @endif --}}
                                                        </div>
                                                    </div>
                                                    <!-- ./ col -->

                                                </div>
                                                <!-- ./ row -->
                                            </div>
                                            <!-- ./ col   -->
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Số chứng minh nhân dân </label>
                                                <input type="number" class="form-control" placeholder="Số chứng minh nhân dân" value="{{ old('so_cmnd') }}" name="so_cmnd">
                                                {{-- @if($errors->has('so_cmnd'))
                                                <span class="text-danger font-11" role="alert">{{ $errors->first('so_cmnd') }}</span>
                                                @endif --}}
                                            </div>
                                            </div>
                                            <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Ngày cấp</label>
                                                <input type="date" class="form-control" placeholder="" name="ngay_cap_cmnd" id="reservation" value="{{ old('ngay_cap_cmnd') }}">
                                                {{-- @if($errors->has('ngay_cap_cmnd'))
                                                <span class="text-danger font-11" role="alert">{{ $errors->first('ngay_cap_cmnd') }}</span>
                                                @endif --}}
                                            </div>
                                            </div>
                                            <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nơi cấp</label>
                                                <input type="text" class="form-control text-capitalize" placeholder="Nơi cấp" name="noi_cap_cmnd" id="" value="{{ old('noi_cap_cmnd') }}">
                                                {{-- @if($errors->has('noi_cap_cmnd'))
                                                <span class="text-danger font-11" role="alert">{{ $errors->first('noi_cap_cmnd') }}</span>
                                                @endif --}}
                                            </div>
                                            </div>
                                            <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Trình độ văn hoá </label>
                                                <input type="text" class="form-control text-capitalize" placeholder="Trình độ văn hoá" name="trinh_do_van_hoa" id="" value="{{ old('trinh_do_van_hoa') }}">
                                            </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Trình trạng hôn nhân </label>
                                                    <select name="hon_nhan" class="form-control">
                                                        <option value="Chưa kết hôn">Chưa kết hôn</option>
                                                        <option value="Đã kết hôn">Đã kết hôn</option>
                                                        <option value="Ly hôn">Ly hôn</option>
                                                        <option value="Ly thân">Ly thân</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Tên vợ/ chồng</label>
                                                <input type="text" class="form-control text-capitalize" placeholder="Tên vợ/chồng" name="vo_chong" id="" value="{{ old('vo_chong') }}">
                                            </div>
                                            </div>
                                            <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Tên con (chia cách tên các con bằng dấu phẩy ) </label>
                                                <input type="text" class="form-control text-capitalize" placeholder="Con đầu,Con thứ" name="con_1" id="" value="{{ old('con_1') }}">
                                            </div>
                                            </div>
                                            <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nghề nghiệp </label>
                                                <input type="text" class="form-control text-capitalize" placeholder="Nghề nghiệp" name="nghe_nghiep" id="" value="{{ old('nghe_nghiep') }}">
                                            </div>
                                            </div>
                                            <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Tiền sử bệnh lý </label>
                                                <input type="text" class="form-control text-capitalize" placeholder="Tiền sử bệnh lý" name="tien_su_benh_ly" id="" value="{{ old('tien_su_benh_ly') }}">
                                              
                                            </div>
                                            </div>
                                            <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Chiều cao(cm)</label>
                                                <input type="number" class="form-control" placeholder="Chiều cao" name="chieu_cao" id="" value="{{ old('chieu_cao') }}">
                                              
                                            </div>
                                            </div>
                                            <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Cân nặng(kg)</label>
                                                <input type="number" class="form-control" placeholder="Cân nặng" name="can_nang" id="" value="{{ old('can_nang') }}">
                                              
                                            </div>
                                            </div>

                                        </div>
                                        
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- thong tin ca nhan -->

                                <div class="card card-info card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="far fa-user"></i> Thông tin người bảo hộ </h3>
                                        <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">     
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Họ & tên người bảo hộ<span class="text-danger">*</span> </label>
                                                <input type="text" class="form-control text-capitalize" name="ho_va_ten_nguoi_bao_ho" value="{{ old('ho_va_ten_nguoi_bao_ho') }}" placeholder="Họ và tên người bảo hộ">
                                                @if($errors->has('ho_va_ten_nguoi_bao_ho'))
                                                    <span class="text-danger font-11" role="alert">{{ $errors->first('ho_va_ten_nguoi_bao_ho') }}</span>
                                                @endif
                                            </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Số điện thoại người bảo hộ<span class="text-danger">*</span> </label>
                                                <input type="number" class="form-control" name="so_dien_thoai" value="{{ old('so_dien_thoai') }}" placeholder="Số điện thoại người bảo hộ">
                                                @if($errors->has('so_dien_thoai'))
                                                    <span class="text-danger font-11" role="alert">{{ $errors->first('so_dien_thoai') }}</span>
                                                @endif
                                            </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Email tên người bảo hộ </label>
                                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email tên người bảo hộ">
                                              
                                            </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Quan hệ với học viên </label>
                                                <input type="text" class="form-control text-capitalize" name="quan_he_hoc_vien" value="{{ old('quan_he_hoc_vien') }}" placeholder="Quan hệ người bảo hộ vs học viên">
                                              
                                            </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Địa chỉ <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control text-capitalize" name="dia_chi" placeholder="Địa chỉ" value="{{ old('dia_chi') }}" >
                                                @if($errors->has('dia_chi'))
                                                <span class="text-danger font-11" role="alert">{{ $errors->first('dia_chi') }}</span>
                                            @endif
                                            </div>
                                            </div>
                                            <!-- ./ col -->  
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- thong tin ca nhan nguoi bao ho -->

                                <!-- tien an tien su -->
                                <div class="card card-warning card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="far fa-sticky-note"></i> Tiền án & tiền sự</h3>
                                        <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Tình trạng hiện tại</label>
                                                <input type="text" class="form-control text-capitalize" placeholder="Tình trạng hiện tại" value="{{ old('tinh_trang') }}" name="tinh_trang" id="">
                                              
                                            </div>
                                            </div>
                                            <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="">Tiền án(Số lần)</label>
                                                <input type="text" class="form-control" placeholder="0" name="tien_an" id="" value="{{ old('tien_an') }}">
                                              
                                            </div>
                                            </div>
                                            <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="">Tiền sự(Số lần)</label>
                                                <input type="text" class="form-control" placeholder="0" name="tien_su" id="" value="{{ old('tien_su') }}">
                                              
                                            </div>
                                            </div>
                                            <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Về tội tiền án</label>
                                                <input type="text" class="form-control text-capitalize" placeholder="" name="ve_toi_tien_an" value="{{ old('ve_toi_tien_an') }}">
                                                
                                            </div>
                                            </div>
                                
                                            <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Về tội tiền sự</label>
                                                <input type="text" class="form-control text-capitalize" placeholder="" name="ve_toi_tien_su" id="" value="{{ old('ve_toi_tien_su') }}">
                                            </div>
                                            </div>
                                            <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Loại ma tuý </label>
                                                <input type="text" class="form-control text-capitalize" placeholder="Loại ma tuý" name="ma_tuy_su_dung" id="" value="{{ old('ma_tuy_su_dung') }}">
                                              
                                            </div>
                                            </div>
                                            <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Cách thức sử dụng </label>
                                                <input type="text" class="form-control text-capitalize" placeholder="Cách thức sử dụng" name="hinh_thuc_su_dung" id="" value="{{ old('hinh_thuc_su_dung') }}">
                                              
                                            </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="far fa-images"></i> Ảnh đơn đăng ký & đơn cam kết </h3>
                                        <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">     
                                        <div class="row">
                                        <!-- ./ col   -->
                                        <div class="col-lg-12">
                                            <div id="multipe_img" class="row">
                                            </div>
                                            <div class="form-group file-upload m-auto">
                                            <label class="input-file-trigger" for="multifileupload"><i class="fas fa-file-upload"></i> Tải ảnh ( Tối đa 5 ảnh) </label>
                                            <input type="file" multiple class="form-control input-file" id="multifileupload" placeholder="" name="images[]">
                                          
                                            </div>
                                        </div>
                                    
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- anh don dang ky -->
                            </div>

                            <div class="col-lg-12 mb-4 text-right">
                            <a  href="{{route('admin.hoc-vien.index')}}" class="btn btn-default mr-2"><i class="fas fa-times"></i> Huỷ bỏ</a>
                                <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Lưu thông tin</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
        <!-- Main row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
    <script>

    $('.btn-close-addnew').on('click',function(e){
        e.preventDefault();
        window.location.href = '/hoc-vien';
    })
    // show one image
    function readURL(input) {
        if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#avatar').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
            $('.show-fileiamge').removeClass('d-none');
        }
    }
    
    $("#fileupload").change(function(){
        readURL(this);
    });

    // show array image
    let parent_e = document.getElementById('multipe_img');
    function readArrURL(input,parent_e) {
    
        if (input.files) {
        let ip_length = input.files.length;
        for(let i=0; i<input.files.length; i++){
            var reader = new FileReader();
            reader.onload = function (e) {
            let block_img = `
                <div class="col-lg-3 mb-2">
                    <img width="100%" src=${e.target.result}>
                </div>
            `;
            $(block_img).appendTo(parent_e);
            }
            reader.readAsDataURL(input.files[i]);
        };
        }
    }
    
    $("#multifileupload").change(function(){
        readArrURL(this,parent_e);
    });


    </script>

  {{ Html::script(mix('admin/student.js')) }}
@endsection

