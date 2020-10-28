@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Hướng nghiệp học viên</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Hướng nghiệp</li>
                    </ol>
                </div> 
                <div class="col-12 mt-2">
                    <a href="javascript:void(0)" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                        <i class="fas fa-plus"></i> Thêm mới
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
                        <h3 class="card-title flex-grow-1"><i class="fab fa-buromobelexperte"></i> Danh sách hướng nghiệp</h3>
                        <div class="dt-buttons btn-group flex-wrap">
                            <button class="btn btn-secondary buttons-print" type="button"><span>Print</span></button> 
                            <button class="btn btn-secondary buttons-csv buttons-html5"  type="button"><span>Csv</span></button>
                            <button class="btn btn-secondary buttons-csv buttons-html5"  type="button"><span>Pdf</span></button> 
                            <button class="btn btn-secondary buttons-csv buttons-html5"  type="button"><span>Word</span></button>  
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <table id="example2" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên</th>
                                        <th>Ngày bắt đầu</th>
                                        <th>Ngày kết thúc</th>
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
        {{ Form::open(['route' => ['admin.huongnghiep.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-huongnghiep-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}      
    </section>

    <div class="mess-data"
        data-url-datatable="{{ route('admin.huongnghiep.list') }}"
        data-url-edit="{{ route('admin.huongnghiep.update', 'ID_REPLY_IN_URL') }}"
        data-url-show="{{ route('admin.huongnghiep.show', 'ID_REPLY_IN_URL') }}"
        data-url-createhv="{{ route('admin.huongnghiep.create.hv', 'ID_REPLY_IN_URL') }}"
        data-url-hocvien-list="{{ route('admin.huongnghiep.hocvien.list', 'ID_REPLY_IN_URL') }}"
        data-url-delete="{{ route('admin.huongnghiep.destroy', 'ID_REPLY_IN_URL') }}">
        
    </div>

    @component('admin.components.modals.alert-delete')
        @slot('headerText')
            {{ "Bạn có muốn xóa hướng nghiệp này không" }}
        @endslot
    @endcomponent

    @component('admin.components.modals.form-modal')
        @slot('title')
            Thêm mới hướng nghiệp
        @endslot
        @slot('form')
            <form 
                action="{{ route('admin.huongnghiep.store') }}" 
                id="create_huongnghiep" 
                role="form" 
                method="post" 
                data-url-index="{{ route('admin.huongnghiep.index') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Hướng nghiệp</label>
                        <input type="text" name="ten" class="form-control text-capitalize" placeholder="Tên Hướng nghiệp">
                        <span class="text-danger ten" role="alert"></span>
                    </div>
                    <div class="row">
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
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Hủy bỏ</button>
                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Lưu thông tin</button>
                </div>
            </form>
        @endslot
    @endcomponent

    @component('admin.components.modals.edit-modal')
        @slot('title')
            Cập nhật thông tin hướng nghiệp
        @endslot
        @slot('form')
            <form action=""  role="form" method="post" id="update_room">
                @csrf     
                <input name="_method" type="hidden" value="PUT">
                <div class="card-body">
                    <div class="form-group">
                        <label>Hướng nghiệp</label>
                        <input type="text" name="ten" class="form-control text-capitalize" placeholder="Tên Hướng nghiệp">
                        <span class="text-danger ten" role="alert"></span>
                    </div>
                    <div class="row">
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
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Hủy bỏ</button>
                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Lưu thông tin</button>
                </div>
            </form> 
        @endslot
    @endcomponent

@endsection
@section('scripts')
    {{ Html::script(mix('admin/huongnghiep.js')) }}
@endsection

