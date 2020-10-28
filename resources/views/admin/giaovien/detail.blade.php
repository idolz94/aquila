@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4> Thông tin giáo viên  - {{$giaovien->ten}}</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">  Thông tin giáo viên</li>
                    </ol>
                </div> 
                <div class="col-lg-12 mt-2">
                    <a  href="/giaovien" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
  
 
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img id="user_avatar" class="profile-user-img img-fluid img-circle"  src="" alt="User profile picture" data-src-image="{{$giaovien->anh_dai_dien}}">
                        </div>
                        <h3 class="profile-username text-center">{{$giaovien->ten}}</h3>
                        <p class="text-muted text-center">{{$giaovien->email}}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Ngày sinh</b> <span class="float-right">{{date("d-m-Y", strtotime($giaovien->ngay_sinh))}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Số điện thoại</b> <span class="float-right">{{$giaovien->so_dien_thoai}}</span>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-9">
                    <div class="card card-info card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active" href="#classroom" data-toggle="tab">Lớp học đang quản lí</a></li>
                                <li class="nav-item"><a class="nav-link" href="#classroom_managed" data-toggle="tab">Lớp học đã quản lí</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <form action=""></form>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="classroom">
                                    <div class="table-responsive p-0">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                <th>Mã lớp học</th>
                                                <th>Môn học</th>
                                                <th>Ngày bắt đầu</th>
                                                <th>Ngày kết thúc</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($giaovien->lophoc()->where('ngay_ket_thuc','>',date("Y-m-d"))->get() as $lophoc)
                                                <tr>
                                                    <td>{{$lophoc->ma_lop_hoc}}</td>
                                                    <td>{{$lophoc->monhoc->mon_hoc}}</td>
                                                    <td>{{date("d-m-Y", strtotime($lophoc->ngay_bat_dau))}}</td>
                                                    <td>{{date("d-m-Y", strtotime($lophoc->ngay_ket_thuc))}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="classroom_managed">
                                    <div class="table-responsive p-0">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                <th>Mã lớp học</th>
                                                <th>Môn học</th>
                                                <th>Ngày bắt đầu</th>
                                                <th>Ngày kết thúc</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($giaovien->lophoc()->where('ngay_ket_thuc','<',date("Y-m-d"))->get() as $lophoc)
                                                <tr>
                                                    <td>{{$lophoc->ma_lop_hoc}}</td>
                                                    <td>{{$lophoc->monhoc->mon_hoc}}</td>
                                                    <td>{{date("d-m-Y", strtotime($lophoc->ngay_bat_dau))}}</td>
                                                    <td>{{date("d-m-Y", strtotime($lophoc->ngay_ket_thuc))}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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
                dir_path = window.location.origin + "/storage/uploads/teacher_avatar/icon128/" + url_image;
            }
            user_avatar.attr("src", dir_path);
        });
    </script>
@endsection

