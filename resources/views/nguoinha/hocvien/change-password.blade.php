@extends('nguoinha.layouts.index')
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
                    <li class="breadcrumb-item"><a href="#">Hồ sơ cá nhân</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
    <section class="content">
      <div class="row">
      <div class="col-md-10 offset-md-1">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">
            </div>
            <h3 class="profile-username text-center">Nina Mcintire</h3>
            <p class="text-muted text-center">abc@gmail.com</p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Chức vụ</b> <a class="float-right">Supper admin</a>
              </li>
              <li class="list-group-item">
                <b>Giới tính</b> <a class="float-right">Nam</a>
              </li>
            </ul>
            <a href="#" class="btn btn-info btn-block update_pass"><b>Thay đổi mật khẩu</b></a>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>  
      </div>
    </section>

    <div class="mess-data"
      data-url-edit="{{ route('admin.manage.edit', 'ID_REPLY_IN_URL') }}"
    >
    </div>

    @component('admin.components.modals.edit-modal')
        @slot('title')
          Thay đổi mật khẩu
        @endslot
        @slot('form')
            <form 
                action="{{ route('admin.manage.store') }}" 
                id="update_pass" 
                role="form" 
                method="post"
                data-url-index="{{ route('admin.manage.index') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Mật khẩu cũ<span class="text-danger">*</span></label>
                                <input type="password" name="" class="form-control">
                                <span class="text-danger" role="alert"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Mật khẩu mới<span class="text-danger">*</span></label>
                                <input type="password" name="" class="form-control">
                                <span class="text-danger" role="alert"></span>
                            </div>
                        </div>  
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Xác nhận khẩu mới<span class="text-danger">*</span></label>
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