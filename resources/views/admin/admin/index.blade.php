@extends('admin.layouts.index')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6"> 
                    <h4>Danh sách tài khoản quản lí</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> quản lí </li>
                    </ol>
                </div> 
                <div class="col-lg-12 mt-2s">
                    <a href="javascript:void(0)" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                        <i class="fas fa-user-plus"></i> Thêm quản lí
                    </a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-users"></i> Danh sách quản lý</h3>
                    </div>
                    <div class="card-body">
                        <div id="table_wrapper" class="table-responsive-sm">
                            <table id="table_mng" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Quyền hạn</th>
                                        <th>Giới tính</th>
                                        <th>Ảnh đại diện</th>
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
        {{ Form::open(['route' => ['admin.manage.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-admin-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}      
    </section>

    <div class="mess-data"
        data-url-datatable="{{ route('admin.manage.list') }}"
        data-url-edit="{{ route('admin.manage.edit', 'ID_REPLY_IN_URL') }}"
        data-url-show="{{ route('admin.manage.show', 'ID_REPLY_IN_URL') }}"
        data-url-create="{{ route('admin.manage.create') }}"
        data-url-delete="{{ route('admin.manage.destroy', 'ID_REPLY_IN_URL') }}"
        >
    </div>

    @component('admin.components.modals.alert-delete')
        @slot('headerText')
            {{ "Bạn có muốn xóa admin" }}
        @endslot
    @endcomponent

    @component('admin.components.modals.form-modal')
        @slot('title')
            Thêm mới admin
        @endslot
        @slot('form')
            <form 
                action="{{ route('admin.manage.store') }}" 
                id="create_manage" 
                role="form" 
                method="post"
                data-url-index="{{ route('admin.manage.index') }}" >
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" name="ten" class="form-control" placeholder="Họ và tên">
                                <span class="text-danger ten" role="alert"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" placeholder="Email">
                                <span class="text-danger email" role="alert"></span>
                            </div>
                        </div>  
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nhiệm vụ <span class="text-danger">*</span></label>
                                <select name="role" class="form-control">
                                    @foreach (Config::get('admin.role') as $role)
                                        @if($role['val'] != Config::get('admin.role.supper_admin.val'))
                                            <option value="{{ $role['val'] }}">{{ $role['text'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="text-danger role" role="alert"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Giới tính</label>
                                <select name="gender" class="form-control">
                                    @foreach (Config::get('admin.genders') as $gender)
                                        <option value="{{ $gender['val'] }}">{{ $gender['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                   <!-- end row -->
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Hủy bỏ</button>
                    <button type="button" id="create_admin" class="btn btn-success float-right"><i class="fas fa-save"></i> Lưu thông tin</button>
                </div>
            </form>
        @endslot
    @endcomponent
@endsection
@section('scripts')
    {{ Html::script(mix('admin/manage.js')) }}
@endsection