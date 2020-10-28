@extends('admin.layouts.index')
@section('content')
     <!-- Content Header (Page header) -->
     <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Kỷ luật của học viên</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Kỷ luật của học viên</li>
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
                                        <th>#</th>
                                        <th>Mã học viên</th>
                                        <th>Tên học viên</th>
                                        <th>Ảnh học viên</th>
                                        <th>Số lần</th>
                                        <th>Lý do</th> 
                                        <th>Ngày kỷ luật</th>
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
        {{ Form::open(['route' => ['admin.kyluat.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-kyluat-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}      
    </section>

    <div class="mess-data"
        data-url-datatable="{{ route('admin.kyluat.list') }}"
        data-url-edit="{{ route('admin.kyluat.edit', 'ID_REPLY_IN_URL') }}"
        data-url-show="{{ route('admin.kyluat.show', 'ID_REPLY_IN_URL') }}"
        data-url-create="{{ route('admin.kyluat.created', 'ID_REPLY_IN_URL') }}">
    </div>

    @component('admin.components.modals.alert-delete')
        @slot('headerText')
            {{ "Bạn có muốn xóa kỷ luật" }}
        @endslot
    @endcomponent

    @component('admin.components.modals.edit-modal')
        @slot('title')
            Kỷ luật học viên
        @endslot
        @slot('form')
            <form 
                action="{{ route('admin.kyluat.store') }}" 
                id="update_kyluat" 
                role="form" 
                method="post"
                >
                @csrf
                <input type="hidden" value="" name="hoc_vien_id"> 
                <div class="card-body">
                    <div class="form-group">
                        <label>Lý do</label>
                        <input type="text" name="ly_do" class="form-control" placeholder="Lý do kỷ luật" required>
                    </div>
                    <div class="form-group">
                        <label>Ghi Chú</label>
                        <input type="text" name="ghi_chu" class="form-control" placeholder="Ghi chú ">
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
    {{ Html::script(mix('admin/kyluat.js')) }}
@endsection