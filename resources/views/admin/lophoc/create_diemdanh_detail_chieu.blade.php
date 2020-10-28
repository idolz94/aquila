@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"> 
                    <h4>Điểm danh chiều lớp : <strong>{{$lophoc->ma_lop_hoc}}</strong> - Ngày : <strong>{{date("d-m-Y",strtotime($ngay))}}</strong></h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Điểm danh Chiều</li>
                    </ol>
                </div> 
                <div class="col-12 mt-2">
                  <a  href="{{route('admin.lophoc.index')}}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-tabs">
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-two-tabContent">
                                <div class="tab-pane fade active show" id="custom_tab_casang" role="tabpanel" aria-labelledby="tab_casang">
                                    <form action="{{route('admin.lophoc.monhoc.diemdanh.post')}}"  role="form" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$lophoc->id}}">
                                        <input type="hidden" name="ca_hoc" value="1">
                                        <input type="hidden" name="ngay" value="{{$ngay}}">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex justify-content-between align-items-center mb-3 p-2">
                                                    <h3 class="card-title flex-grow-1"><i class="fas fa-users"></i> Danh sách học viên</h3>
                                                    <div class="dt-buttons btn-group flex-wrap">
                                                        <button class="btn btn-info mr-2" id="select_all"><i class="fas fa-check"></i> Chọn tất cả</button>
                                                        <button class="btn btn-secondary" id="unselect_all"><i class="fas fa-times"></i> Bỏ chọn tất cả</button> 
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <table id="hv_table" class="table table-bordered">
                                                        <thead>                  
                                                            <tr class="text-center">
                                                                <th style="width: 10px" class="align-middle">#</th>
                                                                <th  class="align-middle">Mã học viên</th>
                                                                <th  class="align-middle">Ảnh học viên</th>
                                                                <th  class="align-middle">Học viên</th>
                                                                <th  class="align-middle">Điểm danh</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody {{$count=1}}>
                                                            @foreach ($hocviens as $hocvien)
                                                                <tr class="text-center">
                                                                    <td  class="align-middle">{{$count++}}</td>
                                                                    <td  class="align-middle">{{$hocvien->ma_hoc_vien}}</td>
                                                                    <td  class="align-middle">
                                                                    @if($hocvien->avatar_url !== NULL)
                                                                        <img class="profile-user-img img-fluid img-circle" src="{{"/storage/uploads/user_avatar/icon128/".$hocvien->avatar_url}}" alt=""></td>
                                                                    @else 
                                                                        <img class="profile-user-img img-fluid img-circle" src="/admin_assets/images/logo/logo-aq-h.png" alt=""></td>
                                                                    @endif
                                                                    </td>
                                                                    <td  class="align-middle">{{$hocvien->ten}}</td>
                                                                    <td  class="align-middle"> 
                                                                    @if($hocvien->active == 1)
                                                                        <input type="checkbox" name="hoc_vien_id[]" value="{{$hocvien->id}}" class="select" disabled>
                                                                    @else
                                                                        <input type="checkbox" name="hoc_vien_id[]" value="{{$hocvien->id}}" class="select">
                                                                    @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-4 text-right">
                                            <a href="/" class="btn btn-default mr-2"><i class="fas fa-times"></i> Huỷ bỏ</a>
                                            <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Lưu thông tin</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <!-- /.card -->
                </div>  
                
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // select diemdanh sang
            $('#select_all').on('click', function(event){
                event.preventDefault();
                let select_all = $('input[name="hoc_vien_id[]"]');
                for(let i = 0; i< select_all.length; i++){
                    if( select_all[i].getAttribute('disabled') === null ){
                        select_all[i].checked = true;
                    }
                }
            });
            // un select all
            $('#unselect_all').on('click', function(event){
                event.preventDefault();
                let select_all = $('input[name="hoc_vien_id[]"]');
                for(let i = 0; i< select_all.length; i++){
                    select_all[i].checked = false;
                }
            });
            // select diemdanh chieu

            $('#select_all_chieu').on('click', function(event){
                event.preventDefault();
                let select_all = $('input[name="hoc_vien_id[]"]');
                for(let i = 0; i< select_all.length; i++){
                    select_all[i].checked = true;
                }
            });
            // un select all
            $('#unselect_all_chieu').on('click', function(event){
                event.preventDefault();
                let select_all = $('input[name="hoc_vien_id[]"]');
                for(let i = 0; i< select_all.length; i++){
                    select_all[i].checked = false;
                }
            });

            
        });
    </script>
@endsection