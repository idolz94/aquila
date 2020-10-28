@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Sự kiện của học viên</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Sự kiện của học viên</li>
                    </ol>
                </div> 
                <div class="col-12 mt-2">
                    <a href="javascript:void(0)" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                        <i class="far fa-calendar-plus"></i> Thêm mới sự kiện
                    </a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-success-data">
                    <div class="card-header">
                        <h3 class="card-title flex-grow-1"><i class="fas fa-users"></i> Danh sách các sự kiện</h3>
                    </div>
                    <div class="card-body p-0">
                       
                        <!-- THE CALENDAR -->
                        <div id="calendar" data-id=""></div>
                    </div>
                </div>
                <div class="card card-error d-none">
                    <div class="card-body text-center">
                        <span>Hiện tại chưa có sự kiện nào được khởi tạo. Vui lòng thêm sự kiện mới</span>
                    </div>
                </div>                  
            </div>
        </div>
        {{ Form::open(['route' => ['admin.sukien.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-sukien-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}      
    </section>

    <div class="mess-data"
        data-url-show="{{ route('admin.sukien.list') }}"
        data-url-edit="{{ route('admin.sukien.edit', 'ID_REPLY_IN_URL') }}"
        data-url-delete="{{ route('admin.sukien.destroy', 'ID_REPLY_IN_URL') }}"
        data-url-hocvien="{{ route('admin.sukien.hocvien', 'ID_REPLY_IN_URL') }}"
        >
    </div>

    @component('admin.components.modals.form-modal')
        @slot('title')
            Thêm mới sự kiện
        @endslot
        @slot('form')
            <form action="{{ route('admin.sukien.store') }}" id="create_sukien" role="form" method="post" data-url-index="{{ route('admin.sukien.index') }}">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Tên sự kiện</label>
                            <input type="text" name="ten" class="form-control" id="ten" placeholder="Tên sự kiện">
                            <span class="text-danger ten" role="alert"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Màu sắc thẻ</label>
                            <input type="text" name="ma_mau" class="form-control my-colorpicker1 colorpicker-element" data-colorpicker-id="1" data-original-title="" title="">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Thời gian bắt đầu:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="date" name="ngay_bat_dau" class="form-control float-right">
                            </div>
                            <span class="text-danger ngay_bat_dau" role="alert"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Thời gian kết thúc:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="date" name="ngay_ket_thuc" class="form-control float-right">
                            </div>
                            <span class="text-danger ngay_ket_thuc" role="alert"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Nội Dung</label>
                            <textarea name="noi_dung" id="event_content" class="form-control" rows="4" placeholder="Enter ..."></textarea>
                            <span class="text-danger noi_dung" role="alert"></span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Hủy bỏ</button>
                    <button type="submit" class="btn btn-success float-right"><i class="far fa-save"></i> Lưu thông tin</button>
                </div>
            </form>
        @endslot
    @endcomponent
@endsection
@section('scripts')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    {{ Html::script(mix('admin/sukien.js')) }}
@endsection