@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Báo cáo theo tháng</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active"> Báo cáo theo tháng</li>
                    </ol>
                </div>  
                
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->   
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-users"></i> Báo cáo theo tháng</h3>     
                    </div>
                    <div class="card-body">
                        <div class="form">
                            <form action="{{route('admin.baocao.filter')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Chọn tháng</label>
                                            <input type="month"  name="month" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info"><i class="fas fa-search mr-1"></i> Tìm kiếm</button>
                            </form>
                        </div>
                        @if(isset($countHocVien))
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{$month}}</h3>

                                        <p>Tháng</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{$countHocVien}}</h3>

                                        <p>Tổng học viên</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="col-md-3">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{$HocVienInTheMonth->count()}}</h3>

                                        <p>Học viên mới trong tháng</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{$HocVienBoTronTrongThang->count()}}</h3>

                                        <p>Học viên bỏ trốn trong tháng</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-user-times"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <a href="{{route('admin.baocao.excel',$month)}}" class="btn btn-secondary buttons-csv buttons-html5"  type="button"><i class="fas fa-print mr-1"></i> Xuất báo cáo</a>
                        </div>
                        <div id="hv_hanhkiem_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <table id="hv_hanhkiem" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mã học viên</th>
                                        <th>Tên học viên</th>
                                        <th>Ảnh học viên</th>
                                        <th>Ngày vào trung tâm</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr> 
                                        <td colspan="5">
                                            Học Viên Mới Trong Tháng
                                        </td>
                                    </tr>
                                    @foreach ($HocVienInTheMonth as $hocvien)
                                        <tr>
                                            <td></td>
                                            <td>{{$hocvien->ma_hoc_vien}}</td>
                                            <td>{{$hocvien->ten}}</td>
                                            <td>
                                            @if($hocvien->avatar_url !== NULL)
                                                <img class="profile-user-img img-circle" src="{{"/storage/uploads/user_avatar/icon128/".$hocvien->avatar_url}}" alt=""></td>
                                            @else 
                                                <img class="profile-user-img img-circle" src="/admin_assets/images/logo/logo-aq-h.png" alt=""></td>
                                            @endif
                                            </td>
                                            <td>{{date("d-m-Y", strtotime($hocvien->ngay_vao))}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5">
                                            Học Viên Bỏ Trốn Trong Tháng 
                                        </td>
                                    </tr>
                                    @foreach ($HocVienBoTronTrongThang as $hocvien)
                                        <tr>
                                            <td></td>
                                            <td>{{$hocvien->ma_hoc_vien}}</td>
                                            <td>{{$hocvien->ten}}</td>
                                            <td>
                                            @if($hocvien->avatar_url !== NULL)
                                                <img src="{{"/storage/uploads/user_avatar/icon128/".$hocvien->avatar_url}}" alt=""></td>
                                            @else 
                                                <img src="/admin_assets/images/logo/logo-aq-h.png" alt=""></td>
                                            @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>                  
            </div>
        </div>
        {{ Form::open(['route' => ['admin.hanhkiem.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-hanhkiem-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}      
    </section>

    <div class="mess-data"
        data-url-datatable="{{ route('admin.hanhkiem.list') }}"
        data-url-edit="{{ route('admin.hanhkiem.edit', 'ID_REPLY_IN_URL') }}"
        data-url-show="{{ route('admin.hanhkiem.show', 'ID_REPLY_IN_URL') }}"
        data-url-create="{{ route('admin.hanhkiem.create', 'ID_REPLY_IN_URL') }}">
    </div>

@endsection
@section('scripts')
    <script type="text/javascript">
        $(function() {
            $('.date-picker').datepicker( {
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'MM yy',
            onClose: function(dateText, inst) { 
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
            });
        });
    </script>
@endsection