@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Hệ phái </h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Hệ phái</li>
                    </ol>
                </div> 
                <div class="col-12 mt-2">
                    <a href="javascript:void(0)" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                        <i class="fas fa-plus"></i> Thêm hệ phái
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
                        <h3 class="card-title flex-grow-1"><i class="fas fa-layer-group"></i> Danh sách các hệ phái</h3>
                    </div>
                    <div class="card-body">
                        <div id="table_wrapper" class="cus_tb table-responsive">
                            <table id="hephai" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Hệ phái</th>
                                        <th width="20%">Tác vụ</th>
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
        {{ Form::open(['route' => ['admin.hephai.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-hephai-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}      
    </section>

    <div class="mess-data"
        data-url-datatable="{{ route('admin.hephai.list') }}"
        data-url-edit="{{ route('admin.hephai.update', 'ID_REPLY_IN_URL') }}"
        data-url-delete="{{ route('admin.hephai.destroy', 'ID_REPLY_IN_URL') }}"
        >
    </div>

    @component('admin.components.modals.alert-delete')
        @slot('headerText')
            {{ "Bạn có muốn xóa hệ phái" }}
        @endslot
    @endcomponent

    @component('admin.components.modals.form-modal')
        @slot('title')
            Thêm mới hệ phái 
        @endslot
        @slot('form')
        <form action="{{ route('admin.hephai.store') }}" id="create_hephai" role="form" method="post" data-url-index="{{ route('admin.hephai.index') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Tên hệ phái</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                        </div>
                        <input type="text" name="ten" class="form-control" id="ten" placeholder="Tên hệ phái">
                    </div>
                    <span class="text-danger ten" role="alert"></span>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Hủy bỏ</button>
                <button type="submit" class="btn btn-success float-right"><i class="far fa-save"></i> Lưu thông tin</button>
            </div>
        </form>
        @endslot
    @endcomponent

    @component('admin.components.modals.edit-modal')
        @slot('title')
            Cập nhật thông tin hệ phái
        @endslot
        @slot('form')
            <form 
                action="" 
                id="update_group" 
                role="form" 
                method="post"
                data-url-index="{{ route('admin.hephai.index') }}"
                >
                @csrf
                <input name="_method" type="hidden" value="PUT"> 
                <div class="card-body">
                    <div class="form-group">
                        <label>Tên hệ phái</label>
                        <input type="text" name="ten" value="" class="form-control" id="ten" placeholder="Tên nhóm">
                        <span class="text-danger ten" role="alert"></span>
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
    {{ Html::script(mix('admin/hephai.js')) }}
@endsection