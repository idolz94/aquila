@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Nhóm học viên</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Nhóm</li>
                    </ol>
                </div> 
                <div class="col-12 mt-2">
                    <a href="javascript:void(0)" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                        <i class="fas fa-plus"></i> Thêm nhóm
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
                    <div class="card-header">
                        <h3 class="card-title flex-grow-1"><i class="fas fa-users"></i> Danh sách các nhóm</h3>
                    </div>
                    <div class="card-body">
                        <div id="table_wrapper" class="cus_tb dataTables_wrapper dt-bootstrap4">
                            <table id="example2" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nhóm</th>
                                        <th>Trưởng nhóm</th>
                                        <th>Ngày bắt đầu</th>
                                        <th>Ghi chú</th>
                                        <th>Kết quả</th>
                                        <th>Thuộc</th>
                                        <th width="30%">Tác vụ</th>
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
        {{ Form::open(['route' => ['admin.nhom.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-nhom-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}      
    </section>

    <div class="mess-data"
        data-url-datatable="{{ route('admin.nhom.list') }}"
        data-url-edit="{{ route('admin.nhom.edit', 'ID_REPLY_IN_URL') }}"
        data-url-delete="{{ route('admin.nhom.destroy', 'ID_REPLY_IN_URL') }}"
        data-url-hocvien="{{ route('admin.nhom.hocvien', 'ID_REPLY_IN_URL') }}"
        data-url-hocvien-list="{{ route('admin.nhom.hocvien.list', 'ID_REPLY_IN_URL') }}"
        data-url-hocvien-export="{{ route('admin.nhom.hocvien.export', 'ID_REPLY_IN_URL') }}"
        >
    </div>

    @component('admin.components.modals.alert-delete')
        @slot('headerText')
            {{ "Bạn có muốn xóa nhóm" }}
        @endslot
    @endcomponent

    @component('admin.components.modals.form-modal')
        @slot('title')
            Thêm mới nhóm
        @endslot
        @slot('form')
            <form action="{{ route('admin.nhom.store') }}" id="create_nhom" role="form" method="post" data-url-index="{{ route('admin.nhom.index') }}">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Tên nhóm</label>
                            <input type="text" name="ten" class="form-control" id="ten" placeholder="Tên nhóm">
                            <span class="text-danger ten" role="alert"></span>
                        </div>
                        <div class="form-group col-md-6 d-flex flex-column">
                            <label>Trưởng nhóm</label>
                            <select name="truong_nhom_id"  class="form-control" id="leader_group">
                                @foreach ($hocviens as $item)
                                    <option value="{{$item->id}}">{{$item->ten}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger ten_truong_nhom" role="alert"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Thời gian bắt đầu</label>
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
                        <div class="form-group col-md-6 d-flex flex-column">
                            <label>Thuộc nhóm</label>
                            <select name="nhom_cha_id" id="parent_group" class="form-control">
                                @foreach ($nhom_chas as $item)
                                <option value="{{$item->id}}">{{$item->ten}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger nhom_nao" role="alert"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Ghi chú</label>
                            <textarea rows="3" name="ghi_chu" class="form-control" id="ten" placeholder="Ghi chú ..."></textarea>
                            <span class="text-danger ghi_chu" role="alert"></span>
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
    {{ Html::script(mix('admin/nhom.js')) }}
@endsection