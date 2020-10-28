@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Danh sách giáo viên </h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Giáo viên</li>
                    </ol>
                </div> 
                <div class="col-12 mt-2">
                    <a href="{{route('admin.giaovien.create')}}" class="btn btn-success">
                        <i class="fas fa-user-plus"></i> Thêm giáo viên
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
                        <h3 class="card-title flex-grow-1"><i class="fas fa-users"></i> Danh sách giáo viên</h3>
                        <div class="dt-buttons btn-group flex-wrap">
                            <a href="{{route('admin.giaovien.excel')}}" class="btn btn-success"  type="button"><span><i class="far fa-file-excel"></i> Xuất file Excel</span></a>  
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="table_wrapper" class="cus_tb dataTables_wrapper dt-bootstrap4">
                            <table id="table_gv" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Ngày sinh</th>
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
        {{ Form::open(['route' => ['admin.giaovien.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-giaovien-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}      
    </section>

    <div class="mess-data"
        data-url-datatable="{{ route('admin.giaovien.list') }}"
        data-url-edit="{{ route('admin.giaovien.edit', 'ID_REPLY_IN_URL') }}"
        data-url-show="{{ route('admin.giaovien.show', 'ID_REPLY_IN_URL') }}"
        data-url-delete="{{ route('admin.giaovien.destroy', 'ID_REPLY_IN_URL') }}"
        >
    </div>

    @component('admin.components.modals.alert-delete')
        @slot('headerText')
            {{ "Bạn có muốn xóa giáo viên" }}
        @endslot
    @endcomponent
@endsection
@section('scripts')
    {{ Html::script(mix('admin/giaovien.js')) }}
@endsection