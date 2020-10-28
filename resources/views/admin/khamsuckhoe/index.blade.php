@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Khám sức khoẻ học viên</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Khám sức khoẻ học viên</li>
                    </ol>
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
                        <h3 class="card-title"><i class="fas fa-users"></i> Danh sách học viên</h3>     
                    </div>
                    <div class="card-body">
                        <div id="hv_kyluat_wrapper" class="table-responsive-sm">
                            <table id="hv_kyluat" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Mã học viên</th>
                                        <th>Ảnh học viên</th>
                                        <th>Tên học viên</th>
                                        <th>Số lần khám</th>
                                        <th>Ngày khám mới nhất</th>
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
        {{ Form::open(['route' => ['admin.khamsuckhoe.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-khamsuckhoe-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}      
    </section>

    <div class="mess-data"
        data-url-datatable="{{ route('admin.khamsuckhoe.list') }}"
        data-url-edit="{{ route('admin.khamsuckhoe.edit', 'ID_REPLY_IN_URL') }}"
        data-url-show="{{ route('admin.khamsuckhoe.show', 'ID_REPLY_IN_URL') }}"
        data-url-create="{{ route('admin.khamsuckhoe.created', 'ID_REPLY_IN_URL') }}"
        data-url-excel="{{ route('admin.khamsuckhoe.excel', 'ID_REPLY_IN_URL') }}"
        data-url-count="{{ route('admin.khamsuckhoe.count', 'ID_REPLY_IN_URL') }}">
    </div>

    @component('admin.components.modals.alert-delete')
        @slot('headerText')
            {{ "Bạn có muốn xóa khám sức khoẻ này" }}
        @endslot
    @endcomponent

    {{-- @component('admin.components.modals.edit-modal')
        @slot('title')
            sức khoẻ học viên
        @endslot
        @slot('form')
            <form 
                action="{{ route('admin.khamsuckhoe.store') }}" 
                id="update_khamsuckhoe" 
                role="form" 
                method="post"
                >
                @csrf
                <input type="hidden" value="" name="hoc_vien_id"> 
                <div class="card-body">
                    <div class="form-group">
                        <label>Đánh giá sức khoẻ</label>
                        <input type="text" name="ten" class="form-control" placeholder="Đáng giá sức khoẻ">
                    </div>
                    <span class="text-danger ten" role="alert"></span>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Hủy bỏ</button>
                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Lưu thông tin</button>
                </div>
            </form>
        @endslot
    @endcomponent
    --}}
@endsection
@section('scripts')
    {{ Html::script(mix('admin/khamsuckhoe.js')) }}
@endsection