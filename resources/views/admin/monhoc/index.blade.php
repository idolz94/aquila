@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Danh sách môn học </h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Môn học</li>
                    </ol>
                </div> 
                <div class="col-12 mt-2">
                    <a href="javascript:void(0)" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                        <i class="fas fa-plus"></i> Thêm môn học
                    </a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title flex-grow-1"><i class="fas fa-book"></i> Danh sách môn học</h3>
                    </div>
                    <div class="card-body">
                        <div id="table_wrapper" class="table-responsive-sm">
                            <table id="table_mh" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Môn học</th>
                                        <th>Hình thức</th>
                                        <th>Giai đoạn</th>
                                        <th>Cấp độ</th>
                                        <th>Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                  
            </div>
        </div>
        {{ Form::open(['route' => ['admin.monhoc.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-monhoc-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}      
    </section>

    <div class="mess-data"
        data-url-datatable="{{ route('admin.monhoc.list') }}"
        data-url-edit="{{ route('admin.monhoc.edit', 'ID_REPLY_IN_URL') }}"
        data-url-delete="{{ route('admin.monhoc.destroy', 'ID_REPLY_IN_URL') }}"
        >
    </div>

    @component('admin.components.modals.alert-delete')
        @slot('headerText')
            {{ "Bạn có muốn xóa môn học này không ?" }}
        @endslot
    @endcomponent

    @component('admin.components.modals.form-modal')
        @slot('title')
            Thêm mới môn học
        @endslot
        @slot('form')
            <form action="{{ route('admin.monhoc.store') }}" id="create_monhoc" role="form" method="post" data-url-index="{{ route('admin.monhoc.index') }}">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Tên môn học <span class="text-danger">*</span></label>
                        <input type="text" name="mon_hoc" class="form-control" id="mon_hoc" placeholder="Tên môn học">
                        <span class="text-danger mon_hoc" role="alert"></span>
                    </div>
                    <div class="form-group col-md-6 d-flex flex-column">
                        <label>Thuộc bộ môn</label>
                        <select name="bo_mon_id" class="form-control select2_form">
                            @if($bomons->isEmpty())
                                <option value=""></option>
                            @endif
                            @foreach ($bomons as $item)
                                <option value="{{$item->id}}">{{$item->ten_bo_mon}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger bo_mon_id" role="alert"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Loại hình môn học</label>
                        <select name="loai_hinh" class="form-control">
                            <option value="0">Cố định</option>
                            <option value="1">Phát sinh</option>
                        </select>
                        <span class="text-danger ghi_chu" role="alert"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Thuộc giai đoạn</label>
                        <select name="giai_doan" class="form-control">
                            <option value="0">Sơ Cấp</option>
                            <option value="1">Trung Cấp</option>
                        </select>
                        <span class="text-danger giai_doan" role="alert"></span>
                    </div>       
                    <div class="form-group col-md-6">
                        <label>Độ khó môn học</label>
                        <select name="do_kho" class="form-control">
                            <option value="0">Cơ Bản</option>
                            <option value="1">Nâng Cao</option>
                        </select>
                        <span class="text-danger ghi_chu" role="alert"></span>
                    </div>
                    {{-- <div class="form-group col-md-12">
                        <label>Nhận xét</label>
                        <textarea name="nhan_xet" class="form-control" rows="4" placeholder="Enter ..."></textarea>
                        <span class="text-danger nhan_xet" role="alert"></span>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Ghi chú</label>
                        <textarea name="ghi_chu" class="form-control" rows="4" placeholder="Enter ..."></textarea>
                        <span class="text-danger ghi_chu" role="alert"></span>
                    </div> --}}
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
    {{ Html::script(mix('admin/monhoc.js')) }}
@endsection