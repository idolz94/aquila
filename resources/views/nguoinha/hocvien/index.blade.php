@extends('nguoinha.layouts.index')
<style>
    .modal-body{
        padding: 0 !important;
    }
</style>
@section('content')
<div class="content-header mb-4 bg-white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h5 class="m-0 text-dark">Hồ sơ cá nhân</h5>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Hồ sơ cá nhân</li>
                </ol>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-info card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            @if(Auth::user()->hocvien->avatar_url == null)
                                <img class="profile-user-img img-fluid img-circle user_avatar" src="/admin_assets/images/logo/logo-aq-h.png" alt="User profile picture">
                            @else
                                <img class="profile-user-img img-fluid img-circle user_avatar" src="/storage/uploads/user_avatar/icon128/{{Auth::user()->hocvien->avatar_url}}" alt="User profile picture">
                            @endif
                        </div>

                        <h3 class="profile-username text-center">{{ Auth::user()->hocvien->ten }}<i class="far fa-check-circle text-success ml-2"></i></h3>

                        <p class="text-muted text-center">Học viên</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Email</b> <a class="float-right">{{ Auth::user()->email }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Số điện thoại</b> <a class="float-right">{{ Auth::user()->so_dien_thoai }}</a>
                            </li>
                            <!-- <li class="list-group-item">
                            <b>Tình trạng nghiện</b> <a class="float-right">{{ Auth::user()->hocvien->tinh_trang }}</a>
                            </li> -->
                        </ul>

                        <a href="#" class="btn btn-outline-info btn-block update_pass"><i class="far fa-lock"></i> Thay đổi mật khẩu</a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-info card-outline">
                    <div class="card-header p-4">
                        <h5 class="mb-0">Thông tin học viên</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="ttcn ml-2">
                                    <div class="d-flex mb-2">
                                        <span>Họ và tên: </span>
                                        <span class="ml-3"><strong>{{ Auth::user()->hocvien->ten }}</strong></span>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <span>Mã học viên: </span>
                                        <span class="ml-3"><strong>{{ Auth::user()->hocvien->ma_hoc_vien }}</strong></span>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <span>Gioi tinh: </span>
                                        <span class="ml-3"><strong>Nam</strong></span>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <span>Tình trạng: </span>
                                        <span class="ml-3"><strong>{{ Auth::user()->hocvien->tinh_trang }}</strong></span>
                                    </div>
                                </div>
                                @foreach ( Auth::user()->hocvien->hanhkiem()->get() as $item)
                                    <div class="ttcn ml-5">
                                        <p>Hạnh kiểm :  {{$item->ten_hanh_kiem}} - Ngày Xét : {{$item->created_at}}</p>
                                    </div>
                                @endforeach

                                @foreach ( Auth::user()->hocvien->kyluat()->get() as $item)
                                    <div class="ttcn ml-5">
                                        <p>kỷ luật :  {{$item->ly_do}} - Ghi chú : {{$item->ghi_chu}} - Ngày Xét : {{$item->created_at}}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</section>
@component('admin.components.modals.edit-modal')
        @slot('title')
          Thay đổi mật khẩu
        @endslot
        @slot('form')
            <form 
                class="mb-0"
                action="{{ route('admin.manage.store') }}" 
                id="update_pass" 
                role="form" 
                method="post"
                data-url-index="{{ route('admin.manage.index') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Mật khẩu cũ <span class="text-danger">*</span></label>
                                <input type="password" name="" class="form-control">
                                <span class="text-danger" role="alert"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Mật khẩu mới <span class="text-danger">*</span></label>
                                <input type="password" name="" class="form-control">
                                <span class="text-danger" role="alert"></span>
                            </div>
                        </div>  
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Xác nhận khẩu mới <span class="text-danger">*</span></label>
                                <input type="password" name="" class="form-control">
                                <span class="text-danger" role="alert"></span>
                            </div>
                        </div>
                    </div>
                   <!-- end row -->
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Hủy bỏ</button>
                    <button type="button" id="create_admin" class="btn btn-success float-right"><i class="fas fa-save"></i> Cập nhật mật khẩu</button>
                </div>
            </form>
        @endslot
    @endcomponent
@endsection
@section('scripts')
    <script>
      // update form modal
      $('body').on('click', '.update_pass', function(event) {
          event.preventDefault();
          $('#modal-edit').modal('show', { backdrop: 'true' });
      });
    </script>
@endsection