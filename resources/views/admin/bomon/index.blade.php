@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Danh sách bộ môn </h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Bộ môn</li>
                    </ol>
                </div> 
                <div class="col-12 mt-2">
                    <a href="javascript:void(0)" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                        <i class="fas fa-plus"></i> Thêm bộ môn
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
                        <h3 class="card-title flex-grow-1"><i class="fas fa-th"></i> Danh sách bộ môn</h3>
                    </div>
                    <div class="card-body">
                        <div id="table_wrapper" class="table-responsive-sm">
                            <table id="table_bm" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Bộ môn</th>
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
        {{ Form::open(['route' => ['admin.bomon.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-bomon-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}      
    </section>

    <div class="mess-data"
        data-url-datatable="{{ route('admin.bomon.list') }}"
        data-url-edit="{{ route('admin.bomon.edit', 'ID_REPLY_IN_URL') }}"
        data-url-update="{{ route('admin.bomon.update', 'ID_REPLY_IN_URL') }}"
        data-url-delete="{{ route('admin.bomon.destroy', 'ID_REPLY_IN_URL') }}">
    </div>

    @component('admin.components.modals.alert-delete')
        @slot('headerText')
            {{ "Bạn có muốn xóa bộ môn này không ?" }}
        @endslot
    @endcomponent

    @component('admin.components.modals.form-modal')
        @slot('class')
            cus_modal
        @endslot
        @slot('title')
            Thêm mới bộ môn
        @endslot
        @slot('form')
            <form action="{{ route('admin.bomon.store') }}" id="create_bomon" role="form" method="post" data-url-index="{{ route('admin.bomon.index') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Tên bộ môn</label>
                        <input type="text" name="ten_bo_mon" class="form-control text-capitalize" placeholder="Tên bộ môn">
                        <span class="text-danger ten_bo_mon" role="alert"></span>
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
            Chỉnh sửa bộ môn
        @endslot
        @slot('form')
        <form action="" id="update_bomon" role="form" method="POST" data-url-index="{{ route('admin.bomon.index') }}">
                @csrf
                <input name="_method" type="hidden" value="PUT"> 
                <div class="card-body">
                    <div class="form-group">
                        <label>Tên bộ môn</label>
                        <input type="text" name="ten_bo_mon" class="form-control text-capitalize" placeholder="Tên bộ môn">
                        <span class="text-danger ten_bo_mon_update" role="alert"></span>
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
    {{ Html::script(mix('admin/bomon.js')) }}
@endsection