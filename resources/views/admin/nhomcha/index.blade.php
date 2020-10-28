@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Nhóm</h4>
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
                        <h3 class="card-title"><i class="fas fa-layer-group"></i> Danh sách các nhóm</h3>
                    </div>
                    <div class="card-body">
                        <div id="table_wrapper" class="cus_tb dataTables_wrapper dt-bootstrap4">
                            <table id="example2" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Tên nhóm</th>
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
        {{ Form::open(['route' => ['admin.nhomcha.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-nhomcha-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}      
    </section>

    <div class="mess-data"
        data-url-datatable="{{ route('admin.nhomcha.list') }}"
        data-url-edit="{{ route('admin.nhomcha.update', 'ID_REPLY_IN_URL') }}"
        data-url-delete="{{ route('admin.nhomcha.destroy', 'ID_REPLY_IN_URL') }}"
        >
    </div>

    @component('admin.components.modals.alert-delete')
        @slot('headerText')
            {{ "Bạn có muốn xóa nhóm" }}
        @endslot
    @endcomponent

    @component('admin.components.modals.form-modal')
        @slot('title')
            Thêm mới nhóm chính
        @endslot
        @slot('form')
        <form action="{{ route('admin.nhomcha.store') }}" id="create_nhomcha" role="form" method="post" data-url-index="{{ route('admin.nhomcha.index') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Tên nhóm</label>
                    <div class="input-group mb-3">
                        
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                        </div>
                        <input type="text" name="ten" class="form-control" placeholder="Tên nhóm">
                        <span class="text-danger ten" role="alert"></span>
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

    @component('admin.components.modals.edit-modal')
        @slot('title')
            Cập nhật thông tin nhóm chính
        @endslot
        @slot('form')
            <form 
                action="" 
                id="update_group" 
                role="form" 
                method="post"
                data-url-index="{{ route('admin.nhomcha.index') }}"
                >
                @csrf
                <input name="_method" type="hidden" value="PUT"> 
                <div class="card-body">
                    <div class="form-group">
                        <label>Tên nhóm</label>
                        <input type="text" name="ten" value="" class="form-control" placeholder="Tên nhóm">
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
    {{ Html::script(mix('admin/nhomcha.js')) }}
@endsection