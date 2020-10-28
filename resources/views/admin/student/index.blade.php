@extends('admin.layouts.index')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Danh sách học viên</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Danh sách học viên</li>
                    </ol>
                </div>    
                <div class="col-md-6 mt-2">
                    <a href="{{ route('admin.hoc-vien.create') }}" class="btn btn-success btn-block-sm">
                        <i class="fas fa-user-plus mr-1"></i> Thêm học viên
                    </a>
                </div>  
                <div class="col-md-6 mt-2 text-right">
                    <a href="{{ route('admin.hoc-vien.importView') }}" class="btn btn-info btn-block-sm">
                        <i class="fas fa-file-upload mr-1"></i> Nhập dữ liệu học viên
                    </a>
                    <a href="{{ route('admin.hoc-vien.export') }}" class="btn btn-default btn-block-sm">
                        <i class="fas fa-file-excel mr-1"></i> Xuất dữ liệu học viên
                    </a>
                </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="hoc_vien" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã học viên</th>
                                            <th>Ảnh học viên</th>
                                            <th>Tên học viên</th>
                                            <th>Giới tính</th>
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
        </div>
        {{ Form::open(['route' => ['admin.hoc-vien.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-class-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}      
    </section>

    <div class="mess-data"
        data-url-datatable="{{ route('admin.hoc-vien.list') }}"
        data-url-show="{{ route('admin.hoc-vien.show', 'ID_REPLY_IN_URL') }}"
        data-url-edit="{{ route('admin.hoc-vien.edit', 'ID_REPLY_IN_URL') }}"
        data-url-delete="{{ route('admin.hoc-vien.destroy', 'ID_REPLY_IN_URL') }}"
        data-url-taichinh="{{route('admin.taichinh.create', 'ID_REPLY_IN_URL') }}"
        data-url-theodoiyte="{{route('admin.hoc-vien.theo-doi-y-te', 'ID_REPLY_IN_URL') }}"
        data-url-vephep="{{route('admin.hoc-vien.ve-phep', 'ID_REPLY_IN_URL') }}"
        data-url-anhquatrinh="{{route('admin.hoc-vien.anhquatrinh.index', 'ID_REPLY_IN_URL') }}"
        >
    </div>

    @component('admin.components.modals.alert-delete')
        @slot('headerText')
            {{ "Bạn có muốn xóa học viên" }}
        @endslot
    @endcomponent

@endsection
@section('scripts')
    {{ Html::script(mix('admin/student.js')) }}
    <script>
    let admin = {!! json_encode(Auth::guard('admin')->user()->role) !!};
    </script>
@endsection