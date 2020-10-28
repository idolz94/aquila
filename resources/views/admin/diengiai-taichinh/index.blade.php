@extends('admin.layouts.index')
@section('content') 
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Tài chính học viên</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Tài chính học viên</li>
                    </ol>
                </div> 
                <div class="col-sm-12 mt-2">
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
                    <div class="card-header">
                        <h3 class="card-title"> <i class="fas fa-money-check-alt"></i> Danh sách các khoản phí của học viên </h3>
                    </div>
                    <div class="card-body">
                        <div id="table_wrapper" class="cus_tb dataTables_wrapper dt-bootstrap4">
                            <table id="table_tc" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="5%">Stt</th>
                                        <th>Khoản phí</th>
                                        <th>Thu/Chi</th>
                                        <th width="10%">Tác vụ</th>
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
        {{ Form::open(['route' => ['admin.diengiai-taichinh.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-diengiai-taichinh-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}      
    </section>

    <div class="mess-data"
        data-url-datatable="{{ route('admin.diengiai-taichinh.list') }}"
        data-url-edit="{{ route('admin.diengiai-taichinh.edit', 'ID_REPLY_IN_URL') }}"
        data-url-delete="{{ route('admin.diengiai-taichinh.destroy', 'ID_REPLY_IN_URL') }}"
        data-url-update="{{ route('admin.diengiai-taichinh.update', 'ID_REPLY_IN_URL') }}">
    </div>

    <!-- Remove -->
    @component('admin.components.modals.alert-delete')
        @slot('headerText')
            {{ "Bạn có muốn xóa khoản tài chính này?" }}
        @endslot
    @endcomponent

    <!-- Create -->
    @component('admin.components.modals.form-modal')
        @slot('class')
            cus_modal
        @endslot
        @slot('title')
            Thêm mới diễn giải tài chính
        @endslot
        @slot('form')
            <form action="{{ route('admin.diengiai-taichinh.store') }}" id="create_diengiai-taichinh" role="form" method="post" data-url-index="{{ route('admin.diengiai-taichinh.index') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Khoản tài chính <span class="text-danger">*</span></label>
                                <input type="text" name="ten_dien_giai" class="form-control" placeholder="Tên khoản tài chính">
                                <span class="text-danger ten_dien_giai" role="alert"></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Khoản thu / Khoản chi <span class="text-danger">*</span></label>
                                <select name="thu_chi" class="form-control">
                                    <option value="0">Thu</option>
                                    <option value="1">Chi</option>
                                </select>
                            </div>
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

    <!-- Update -->
    @component('admin.components.modals.edit-modal')
        @slot('title')
            Chỉnh sửa thông tin tài chính
        @endslot
        @slot('form')
            <form  action="" id="update_diengiai-taichinh" role="form" method="POST">
                @csrf
                <input name="_method" type="hidden" value="PUT">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Khoản tài chính <span class="text-danger">*</span></label>
                                <input type="text" name="ten_dien_giai" class="form-control" placeholder="Tên khoản tài chính">
                                <span class="text-danger ten_dien_giai" role="alert"></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Khoản thu / Khoản chi <span class="text-danger">*</span></label>
                                <select name="thu_chi" class="form-control">
                                    <option value="0">Thu</option>
                                    <option value="1">Chi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Hủy bỏ</button>
                    <button type="submit" class="btn btn-success float-right " id="update_diengiai"><i class="far fa-save"></i> Lưu thông tin</button>
                </div>
            </form>
        @endslot
    @endcomponent

@endsection
@section('scripts')
    {{ Html::script(mix('admin/diengiai-taichinh.js')) }}
@endsection