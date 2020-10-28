@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Danh sách hạnh kiểm của học viên</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active"> Hạnh kiểm của học viên</li>
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
                        <div class="table-responsive-sm">
                            <table id="hv_hanhkiem" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mã học viên</th>
                                        <th>Tên học viên</th>
                                        <th>Ảnh học viên</th>
                                        <th>Hạnh kiểm hiện tại</th>
                                        <th>Số lần kỷ luật</th>
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
        {{ Form::open(['route' => ['admin.hanhkiem.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-hanhkiem-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}      
    </section>

    <div class="mess-data"
        data-url-datatable="{{ route('admin.hanhkiem.list') }}"
        data-url-edit="{{ route('admin.hanhkiem.edit', 'ID_REPLY_IN_URL') }}"
        data-url-show="{{ route('admin.hanhkiem.show', 'ID_REPLY_IN_URL') }}"
        data-url-create="{{ route('admin.hanhkiem.create', 'ID_REPLY_IN_URL') }}">
    </div>

    @component('admin.components.modals.alert-delete')
        @slot('headerText')
            {{ "Bạn có muốn xóa hạnh kiểm" }}
        @endslot
    @endcomponent

    @component('admin.components.modals.edit-modal')
        @slot('title')
            Đánh giá hạnh kiểm học viên <span class="name-hv"></span>
        @endslot
        @slot('form')
            
            <form 
                action="{{ route('admin.hanhkiem.store') }}" 
                id="update_conduct" 
                role="form" 
                method="post"
                >
                @csrf
                <input type="hidden" value="" name="hoc_vien_id"> 
                <div class="card-body">
                    <div class="form-group">
                        <label>Hạnh kiểm</label>
                        <select name="ten_hanh_kiem" class="form-control">
                                <option value="Yếu ">Yếu</option>
                                <option value="Trung Bình">Trung bình</option>
                                <option value="Khá ">Khá</option>
                                <option value="Tốt ">Tốt</option>
                                <option value="Xuất Sắc ">Xuất Sắc</option>
                        </select>
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
    {{ Html::script(mix('admin/hanhkiem.js')) }}
@endsection