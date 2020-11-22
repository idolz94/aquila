@extends('admin.layouts.index')
@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Cập nhật thông tin học viên</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Chỉnh sửa học viên</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-12 mb-4">
          <a  href="{{ URL::previous() }}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
        </div>
        <!-- ./col -->
        <div class="col-lg-12">
          <form role="form"
            action=" {{ route('admin.hoc-vien.update', ['hoc_vien' => $hocVien->id]) }} "
            method="post"
            enctype="multipart/form-data"
          >
            @method('PUT')
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
                                    <div class="show-fileimage text-center">
                                        <img class="img-responsive profile-user-img img-fluid img-circle cus-avatar"
                                            id="avatar"
                                            src=""
                                            data-img-src="{{$hocVien->avatar_url}}">
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
                                                <input type="text" class="form-control text-capitalize" Name="ten" id="ipname" value="{{ old('ten', $hocVien->ten) }}" placeholder="Họ và tên học viên" >
                                                @if($errors->has('ten'))
                                                    <span class="text-danger font-11" role="alert">{{ $errors->first('ten') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Ngày sinh <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" placeholder="" name="ngay_sinh" value="{{ old('ngay_sinh', $hocVien->ngay_sinh) }}" id="reservation">
                                                @if($errors->has('ngay_sinh'))
                                                <span class="text-danger font-11" role="alert">{{ $errors->first('ngay_sinh') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                          <div class="form-group">
                                              <label>Ngày vào trung tâm <span class="text-danger">*</span></label>
                                              <input type="date" class="form-control" placeholder="" name="ngay_vao" value="{{ old('ngay_vao',$hocVien->ngay_sinh) }}" id="reservation">
                                              @if($errors->has('ngay_vao'))
                                              <span class="text-danger font-11" role="alert">{{ $errors->first('ngay_vao') }}</span>
                                              @endif
                                          </div>
                                      </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Giới tính <span class="text-danger">*</span></label>
                                                <select name="gioi_tinh" class="form-control">
                                                    <option value="Nam" {{$hocVien->gioi_tinh == "NAM" ? "Selected" : " "}}>Nam</option>
                                                    <option value="Nữ" {{$hocVien->gioi_tinh == "Nữ" ? "Selected" : " "}} >Nữ</option>
                                                </select>
                                                @if($errors->has('gioi_tinh'))
                                                    <span class="text-danger font-11" role="alert">{{ $errors->first('gioi_tinh') }}</span>
                                                @endif
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
                                    <label>Số chứng minh nhân dân <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Số chứng minh nhân dân" value="{{ old('so_cmnd', $hocVien->so_cmnd) }}" name="so_cmnd">
                                    @if($errors->has('so_cmnd'))
                                    <span class="text-danger font-11" role="alert">{{ $errors->first('so_cmnd') }}</span>
                                    @endif
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Ngày cấp <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" placeholder="" name="ngay_cap_cmnd" id="reservation" value="{{ old('ngay_cap_cmnd', $hocVien->ngay_cap_cmnd) }}">
                                    @if($errors->has('ngay_cap_cmnd'))
                                    <span class="text-danger font-11" role="alert">{{ $errors->first('ngay_cap_cmnd') }}</span>
                                    @endif
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nơi cấp <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control text-capitalize" placeholder="Nơi cấp" name="noi_cap_cmnd" value="{{ old('noi_cap_cmnd', $hocVien->noi_cap_cmnd) }}">
                                    @if($errors->has('noi_cap_cmnd'))
                                    <span class="text-danger font-11" role="alert">{{ $errors->first('noi_cap_cmnd') }}</span>
                                    @endif
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Trình độ văn hoá <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control text-capitalize" placeholder="Trình độ văn hoá" name="trinh_do_van_hoa" value="{{ old('trinh_do_van_hoa', $hocVien->trinh_do_van_hoa) }}">
                                </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Trình trạng hôn nhân <span class="text-danger">*</span></label>
                                        <select name="hon_nhan" class="form-control">
                                            <option value="Chưa kết hôn" {{$hocVien->hon_nhan == "Chưa kết hôn" ? "selected":"" }}>Chưa kết hôn</option>
                                            <option value="Đã kết hôn" {{$hocVien->hon_nhan == "Đã kết hôn" ? "selected":"" }}>Đã kết hôn</option>
                                            <option value="Ly hôn" {{$hocVien->hon_nhan == "Ly hôn" ? "selected":"" }}>Ly hôn</option>
                                            <option value="Ly thân" {{$hocVien->hon_nhan == "Ly thân" ? "selected":"" }}>Ly thân</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Tên vợ/ chồng</label>
                                    <input type="text" class="form-control text-capitalize" placeholder="Tên vợ/chồng" name="vo_chong" value="{{ old('vo_chong',$hocVien->vo_chong) }}">
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Tên con (chia cách tên các con bằng dấu phẩy ) </label>
                                    <input type="text" class="form-control text-capitalize" placeholder="Con đầu,Con thứ" name="con_1" value="{{ old('con_1',$hocVien->con_1) }}">
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nghề nghiệp <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control text-capitalize" placeholder="Nghề nghiệp" name="nghe_nghiep" value="{{ old('nghe_nghiep', $hocVien->nghe_nghiep) }}">
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Tiền sử bệnh lý <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control text-capitalize" placeholder="Tiền sử bệnh lý" name="tien_su_benh_ly" value="{{ old('tien_su_benh_ly', $hocVien->tien_su_benh_ly) }}">
                                    @if($errors->has('tien_su_benh_ly'))
                                    <span class="text-danger font-11" role="alert">{{ $errors->first('tien_su_benh_ly') }}</span>
                                    @endif
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Chiều cao(cm)<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Chiều cao" name="chieu_cao" value="{{ old('chieu_cao', $hocVien->chieu_cao) }}">
                                    @if($errors->has('chieu_cao'))
                                    <span class="text-danger font-11" role="alert">{{ $errors->first('chieu_cao') }}</span>
                                    @endif
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Cân nặng(kg)<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Cân nặng" name="can_nang" value="{{ old('can_nang', $hocVien->can_nang) }}">
                                    @if($errors->has('can_nang'))
                                    <span class="text-danger font-11" role="alert">{{ $errors->first('can_nang') }}</span>
                                    @endif
                                </div>
                                </div>

                            </div>
                            
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- thong tin ca nhan -->

                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="far fa-user"></i> Thông tin người bảo hộ <span class="text-danger">*</span></h3>
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
                                    <label>Họ & tên người bảo hộ <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control text-capitalize" name="ho_va_ten_nguoi_bao_ho" value="{{ old('ho_va_ten_nguoi_bao_ho', $hocVien->nguoibaoho->ten) }}" placeholder="Họ và tên người bảo hộ">
                                    @if($errors->has('ho_va_ten_nguoi_bao_ho'))
                                    <span class="text-danger font-11" role="alert">{{ $errors->first('ho_va_ten_nguoi_bao_ho') }}</span>
                                    @endif
                                </div>
                                </div>
                                <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Số điện thoại người bảo hộ <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="so_dien_thoai" value="{{ old('so_dien_thoai', $hocVien->nguoibaoho->so_dien_thoai) }}" placeholder="Số điện thoại người bảo hộ">
                                    @if($errors->has('so_dien_thoai'))
                                    <span class="text-danger font-11" role="alert">{{ $errors->first('so_dien_thoai') }}</span>
                                    @endif
                                </div>
                                </div>
                                <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Email tên người bảo hộ </label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email', $hocVien->nguoibaoho->email) }}" placeholder="Email người bảo hộ">
                                    @if($errors->has('email'))
                                    <span class="text-danger font-11" role="alert">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                </div>
                                <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Quan hệ với học viên <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control text-capitalize" name="quan_he_hoc_vien" value="{{ old('quan_he_hoc_vien', $hocVien->nguoibaoho->quan_he_hoc_vien) }}" placeholder="Quan hệ người bảo hộ vs học viên">
                                    @if($errors->has('quan_he_hoc_vien'))
                                    <span class="text-danger font-11" role="alert">{{ $errors->first('quan_he_hoc_vien') }}</span>
                                @endif
                                </div>
                                </div>
                                <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Địa chỉ <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control text-capitalize" name="dia_chi" placeholder="Địa chỉ" value="{{ old('dia_chi', $hocVien->dia_chi) }}" >
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
                                    <input type="text" class="form-control text-capitalize" placeholder="Tình trạng hiện tại" value="{{ old('tinh_trang', $hocVien->tinh_trang) }}" name="tinh_trang">
                                    @if($errors->has('tinh_trang'))
                                    <span class="text-danger font-11" role="alert">{{ $errors->first('tinh_trang') }}</span>
                                    @endif
                                </div>
                                </div>
                                <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Tiền án(Số lần)</label>
                                    <input type="text" class="form-control" placeholder="Tiền án" name="tien_an" value="{{ old('tien_an', $hocVien->tien_an) }}">
                                    @if($errors->has('tien_an'))
                                    <span class="text-danger font-11" role="alert">{{ $errors->first('tien_an') }}</span>
                                    @endif
                                </div>
                                </div>
                                <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Tiền sự(Số lần)</label>
                                    <input type="text" class="form-control" placeholder="Tiền sự" name="tien_su" value="{{ old('tien_su', $hocVien->tien_su) }}">
                                    @if($errors->has('tien_su'))
                                    <span class="text-danger font-11" role="alert">{{ $errors->first('tien_su') }}</span>
                                    @endif
                                </div>
                                </div>
                                <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Về tội tiền án</label>
                                    <input type="text" class="form-control text-capitalize" placeholder="" name="ve_toi_tien_an" value="{{ old('ve_toi_tien_an', $hocVien->ve_toi_tien_an) }}">
                                    
                                </div>
                                </div>
                    
                                <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Về tội tiền sự</label>
                                    <input type="text" class="form-control text-capitalize" placeholder="" name="ve_toi_tien_su" value="{{ old('ve_toi_tien_an', $hocVien->ve_toi_tien_su) }}">
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Loại ma tuý <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control text-capitalize" placeholder="Loại ma tuý" name="ma_tuy_su_dung" value="{{ old('ma_tuy_su_dung', $hocVien->ma_tuy_su_dung) }}">
                                    @if($errors->has('ma_tuy_su_dung'))
                                    <span class="text-danger font-11" role="alert">{{ $errors->first('ma_tuy_su_dung') }}</span>
                                    @endif
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Cách thức sử dụng <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control text-capitalize" placeholder="Cách thức sử dụng" name="hinh_thuc_su_dung" value="{{ old('hinh_thuc_su_dung', $hocVien->hinh_thuc_su_dung) }}">
                                    @if($errors->has('hinh_thuc_su_dung'))
                                    <span class="text-danger font-11" role="alert">{{ $errors->first('hinh_thuc_su_dung') }}</span>
                                    @endif
                                </div>
                                </div>
                            </div>
                            
                        </div>
                        <!-- /.card-body -->
                    </div>
                    
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="far fa-images"></i> Ảnh đơn đăng ký & đơn cam kết <span class="text-danger">*</span></h3>
                            <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        
                        <!-- /.card-header -->
                        <div class="card-body">  
                            
                            <div class="row">
                            <!-- ./ col   -->
                           
                            <div class="col-lg-10">
                                <div id="multipe_img" class="row">
                                </div>
                                <div class="form-group file-upload m-auto">
                                <label class="input-file-trigger" for="multifileupload"><i class="fas fa-file-upload"></i> Tải ảnh ( Tối đa 5 ảnh) <span class="text-danger">*</span></label>
                                <input type="file" multiple class="form-control input-file" id="multifileupload" placeholder="" name="images[]">
                                @if($errors->has('images'))
                                    <span class="text-danger font-11" role="alert">{{ $errors->first('images') }}</span>
                                @endif
                                </div>
                               
                            </div>
                            <div class="col-lg-2 mt-4">
                                <select name="images_type" id="" class="form-control">
                                    <option value="0">Xoá ảnh cũ và cập nhật</option>
                                    <option value="1">Giữ ảnh cũ và cập nhật</option>
                                </select>
                            </div>
                        
                            </div>
                            <div class="row">
                                @foreach ($hocVien->anhhocvien()->get() as $image)
                                    <div class="col-md-3">
                                        <a data-fancybox="gallery" href="{{ asset(show_original_img(Config::get('images.paths.image_hocvien'), $image->anh_hoc_vien)) }}"><img class="img-fluid" src="{{ asset(show_original_img(Config::get('images.paths.image_hocvien'), $image->anh_hoc_vien)) }}"></a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- anh don dang ky -->

                </div>

                <div class="col-lg-12 mb-4 text-right">
                    <button class="btn btn-default mr-2 btn-close-update"><i class="fas fa-times"></i> Huỷ bỏ</button>
                    <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Lưu thông tin</button>
                </div>
            </div>
            
          </form>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
@section('scripts')
{{ Html::script('admin_assets/plugins/fancybox/dist/jquery.fancybox.min.js') }}

<script>

    $('.btn-close-update').on('click',function(e){
        e.preventDefault();
        let href = window.location.href;
        console.log(href);
         window.location.href = href;
    })
  let img_url = document.getElementById('avatar');
  let dir_path = ""
    if(img_url.getAttribute('data-img-src') == ""){
        dir_path = window.location.origin + "/admin_assets/images/logo/logo-aq-h.png"
    }else{
        dir_path = window.location.origin + "/storage/uploads/user_avatar/icon128/" + img_url.getAttribute('data-img-src');
    }
  img_url.setAttribute('src',dir_path);
  // show one image
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function (e) {
          $('#avatar').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]);
      $('.show-fileimage').removeClass('d-none');
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
            <div class="col-lg-3">
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

