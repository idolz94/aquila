@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Danh sách lớp học</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Lớp học</li>
                    </ol>
                </div> 
                <div class="col-12 mt-2">
                    <a href="javascript:void(0)" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                        <i class="fas fa-plus"></i> Thêm lớp học
                    </a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.lophoc.filter')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Lớp học</label>
                                        <select id="filter_status" name="ngay_bat_dau" class="form-control">
                                            <option onclick="event.preventDefault();">Vui lòng chọn lớp học</option>
                                            <option value="0">Lớp Đang Học</option>
                                            <option value="1">Lớp Sắp Học</option>
                                            <option value="2">Lớp Đã Học</option>
                                        </select>
                                        <span class="font-11">Lựa chọn lớp học để hiện thị chi tiết</span>
                                    </div>
                                </div>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title flex-grow-1"><i class="fas fa-hospital"></i> Danh sách lớp học</h3>
                        <div class="dt-buttons btn-group flex-wrap">
                            <a href="{{route('admin.lophoc.export')}}" class="btn btn-success"  type="button"><span><i class="far fa-file-excel"></i> Xuất file Excel</span></a>
                        </div> 
                    </div>
                    <div class="card-body">
                        <div id="table_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <table id="table_lh" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Mã lớp</th>
                                        <th>Môn học</th>
                                        <th>Giáo viên</th>
                                        <th>Ngày bắt đầu</th>
                                        <th>Ngày kết thúc</th>
                                        <th>Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>

                        <div id="table_filter" class="d-none">
                            <table id="table_lh_filter" class="table table_filter table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Mã lớp</th>
                                        <th>Môn học</th>
                                        <th>Giáo viên</th>
                                        <th>Ngày bắt đầu</th>
                                        <th>Ngày kết thúc</th>
                                        <th>Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody class="filter_show">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                  
            </div>
        </div>
        {{ Form::open(['route' => ['admin.lophoc.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-lophoc-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}      
    </section>

    <div class="mess-data"
        data-url-datatable="{{ route('admin.lophoc.list') }}"
        data-url-update="{{ route('admin.lophoc.update', 'ID_REPLY_IN_URL') }}"
        data-url-show="{{ route('admin.lophoc.show', 'ID_REPLY_IN_URL') }}"
        data-url-create_hocvien="{{ route('admin.lophoc.hocvien.create','ID_REPLY_IN_URL') }}"
        data-url-create="{{ route('admin.lophoc.create') }}"
        data-url-listtkb="{{ route('admin.thoi-khoa-bieu.index', 'ID_REPLY_IN_URL') }}"
        data-url-delete="{{ route('admin.lophoc.destroy', 'ID_REPLY_IN_URL') }}"
        data-url-filter="{{ route('admin.lophoc.filter') }}"
        data-url-diem="{{ route('admin.lophoc.diem.create', 'ID_REPLY_IN_URL') }}"
        data-url-export="{{ route('admin.lophoc.export.detail', 'ID_REPLY_IN_URL') }}"
        data-url-diemdanh="{{ route('admin.lophoc.diemdanh.create', 'ID_REPLY_IN_URL') }}"
        data-url-images="{{ route('admin.lophoc.create.images', 'ID_REPLY_IN_URL') }}"
        >
    </div>

    @component('admin.components.modals.alert-delete')
        @slot('headerText')
            {{ "Bạn có muốn xóa lớp học này không ?" }}
        @endslot
    @endcomponent

    <!-- Create room -->
    @component('admin.components.modals.form-modal')
        @slot('title')
            Thêm mới lớp học
        @endslot
        @slot('form')
            <form 
                action="{{ route('admin.lophoc.store') }}" 
                id="create_lophoc" 
                role="form" 
                method="post"
                data-url-index="{{ route('admin.lophoc.index') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Mã lớp học <span class="text-danger">*</span></label>
                                <input type="text" name="ma_lop_hoc" class="form-control text-uppercase" placeholder="Mã lớp học">
                                <span class="text-danger ma_lop_hoc" role="alert"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex flex-column">
                                <label>Môn học</label>
                                <select name="mon_hoc_id" class="" id="monhoc_select2">
                                    @foreach ($monhocs as $item)
                                        <option value="{{$item->id}}">{{$item->mon_hoc}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger mon_hoc_id" role="alert"></span>
                            </div>
                        </div>   
                        <div class="form-group col-md-6 d-flex flex-column">
                            <label>Giáo viên giảng dậy</label>
                            <select name="giao_vien_id" class="form-control select2_form">
                                @if($giaoviens->isEmpty())
                                    <option value=""></option>
                                @endif
                                @foreach ($giaoviens as $giaovien)
                                    <option value="{{$giaovien->id}}">{{$giaovien->ten}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger giao_vien_id" role="alert"></span>
                        </div>
                        <!-- end col -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Thời gian bắt đầu <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="ngay_bat_dau" class="form-control float-right" id="reservation_1">
                                </div>
                                <span class="text-danger ngay_bat_dau" role="alert"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Thời gian kết thúc <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="ngay_ket_thuc" class="form-control float-right" id="reservation_2">
                                </div>
                                <span class="text-danger ngay_ket_thuc" role="alert"></span>
                            </div>
                        </div>    
                    </div>
                   <!-- end row -->
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Hủy bỏ</button>
                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Lưu thông tin</button>
                </div>
            </form>
        @endslot
    @endcomponent
    
    <!-- Update class -->
    @component('admin.components.modals.edit-modal')
        @slot('title')
            Cập nhật lớp học
        @endslot
        @slot('form')
            <form 
                action="" 
                id="update_lophoc" 
                role="form" 
                method="post"
                data-url-index="{{ route('admin.lophoc.index') }}">
                @csrf
                <input name="_method" type="hidden" value="PUT">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Mã Lớp Học</label>
                                <input type="text" name="ma_lop_hoc" value="{{old('ma_lop_hoc')}}" class="form-control" placeholder="Mã lớp học">
                                <span class="text-danger ma_lop_hoc" role="alert"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Thời gian bắt đầu:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="ngay_bat_dau" value="" class="form-control float-right">
                                </div>
                                <span class="text-danger ngay_bat_dau" role="alert"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Thời gian kết thúc:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="ngay_ket_thuc"  value="" class="form-control float-right">
                                </div>
                                <span class="text-danger ngay_ket_thuc" role="alert"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Ghi chú</label>
                                <textarea name="ghi_chu" class="form-control" rows="4" placeholder="Enter ..."></textarea>
                                <span class="text-danger ghi_chu" role="alert"></span>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Hủy bỏ</button>
                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Lưu thông tin</button>
                </div>
            </form>
        @endslot
    @endcomponent
    <div class="lds-ellipsis d-none"><div></div><div></div><div></div><div></div></div>
@endsection
@section('scripts')
    {{ Html::script(mix('admin/lophoc.js')) }}
@endsection