@extends('admin.layouts.index')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-lg-12 mb-2">
                    <h4 class="m-0 text-dark">Thông tin chi tiết tài khoản quản lí: <strong>{{$admin->ten}}</strong> </h4>
                </div>
                <div class="col-lg-12">
                    <a  href="/manage" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
                <!-- ./col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <!-- Profile Image -->
                <div class="card card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img id="user_avatar" class="profile-user-img img-fluid img-circle"  src="" alt="User profile picture" data-src-image="{{$admin->avatar}}">
                    </div>
                    <h3 class="profile-username text-center">{{$admin->ten}}</h3>
                    <p class="text-muted text-center">{{$admin->email}}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Chức vụ</b> 
                            <a class="float-right">
                            @foreach (Config::get('admin.role') as $role)
                                @if($role['val'] == $admin->role)
                                    {{$role['text']}}
                                @endif
                            @endforeach
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Giới tính</b> <a class="float-right">{{$admin->gender == 3 ? 'Nữ' :'Nam'}}</a>
                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card card-info card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link active" href="#profile_detail" data-toggle="tab">Thông tin cá nhân</a></li>
                            <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Mật khẩu</a></li>
                            <li class="nav-item"><a class="nav-link" href="#avatar" data-toggle="tab">Ảnh đại diện</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <form action=""></form>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile_detail">
                                <form action="{{route('admin.manage.update',$admin->id)}}" id="create_manage" role="form" method="post" data-url-index="http://admin-aql.aquila.test/manage">
                                    @csrf
                                    <input name="_method" type="hidden" value="PUT">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Họ và tên <span class="text-danger">*</span></label>
                                                    <input type="text" name="ten" class="form-control" value="{{$admin->ten}}" placeholder="Họ và tên">
                                                    <span class="text-danger ten" role="alert"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Email <span class="text-danger">*</span></label>
                                                    <input type="email" name="email" class="form-control" value="{{$admin->email}}" placeholder="Email" >
                                                    <span class="text-danger email" role="alert"></span>
                                                </div>
                                            </div>  
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Nhiệm vụ <span class="text-danger">*</span></label>
                                                    <select name="role" class="form-control">
                                                        @foreach (Config::get('admin.role') as $role)
                                                                <option value="{{ $role['val'] }}"  {{$role['val'] == $admin->role ? "selected" : ""}}>{{ $role['text'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger role" role="alert"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Giới tính</label>
                                                    <select name="gender" class="form-control">
                                                        @foreach (Config::get('admin.genders') as $gender)
                                                            <option value="{{ $gender['val'] }}" {{$gender['val'] == $admin->gender ? "selected" : ""}} >{{ $gender['text'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <button type="submit" id="create_admin" class="btn btn-success float-right"><i class="fas fa-save"></i> Cập nhật thông tin</button>
                                            </div>
                                        </div>
                                    <!-- end row -->
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="password">
                                <form 
                                    action="{{ route('admin.manage.change',$admin->id) }}" 
                                    id="update_password" 
                                    role="form" 
                                    method="post"
                                    data-url-index="{{ route('admin.manage.index') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Mật khẩu cũ <span class="text-danger">*</span></label>
                                                    <input type="password" name="password_old" class="form-control">
                                                    <span class="text-danger" role="alert"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Mật khẩu mới <span class="text-danger">*</span></label>
                                                    <input type="password" name="password" class="form-control">
                                                    <span class="text-danger" role="alert"></span>
                                                </div>
                                            </div>  
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Xác nhận khẩu mới <span class="text-danger">*</span></label>
                                                    <input type="password" name="password_confirm" class="form-control">
                                                    <span class="text-danger" role="alert"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <button type="submit"  class="btn btn-success float-right"><i class="fas fa-save"></i> Cập nhật mật khẩu</button>
                                            </div>
                                        </div>
                                    <!-- end row -->
                                    </div>
                                </form>
                            </div>
                            <form action=""></form>
                             <!-- /.tab-pane -->
                             <div class="tab-pane" id="avatar">
                                <form 
                                    action="{{ route('admin.manage.avatar',$admin->id) }}" 
                                    id="update_avatar" 
                                    role="form" 
                                    method="post"
                                    data-url-index="{{ route('admin.manage.index') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="show-fileImage text-center d-none">
                                                    <img class="img-responsive profile-user-img img-fluid img-circle cus-avatar"
                                                      id="avatar_img"
                                                      src="">
                                                  </div>
                                                  <div class="form-group file-upload m-auto">
                                                    <label class="input-file-trigger" for="fileupload"><i class="fas fa-file-upload"></i> Tải avatar <span class="text-danger">*</span></label>
                                                    <input type="file" class="form-control input-file" id="fileupload" placeholder="" name="avatar">
                                                  </div>
                                            </div>
                                            <div class="col-lg-12 mt-3 border-top">
                                                <button type="submit"  class="btn btn-success btn-block mt-3 float-right"><i class="fas fa-save"></i> Cập nhật avatar</button>
                                            </div>
                                        </div>
                                    <!-- end row -->
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
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

@endsection
@section('scripts')
    <script>
          $(function() {
            let user_avatar = $('#user_avatar');
            // show image avatar
            let url_image = user_avatar.attr('data-src-image');
            let dir_path = ""
            if(url_image == ""){
                dir_path = window.location.origin + "/admin_assets/images/logo/logo-aq-h.png";
            }else{
                dir_path = window.location.origin + "/storage/uploads/admin_avatar/icon128/" + url_image;
            }
            user_avatar.attr("src", dir_path);
        });
        // show one image
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#avatar_img').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
                $('.show-fileImage').removeClass('d-none');
            }
        }
        
        $("#fileupload").change(function(){
            readURL(this);
        });

        // update form modal
        $('body').on('click', '.update_password', function(event) {
            event.preventDefault();
            $('#modal-edit').modal('show', { backdrop: 'true' });
        });

        $('body').on('click', '.update_avatar', function(event) {
            event.preventDefault();
            $('#modal-edit').modal('show', { backdrop: 'true' });
        });
        
        $("input[type=email]").prop('disabled', true);
      
    </script>
      {{ Html::script(mix('admin/manage.js')) }}
@endsection