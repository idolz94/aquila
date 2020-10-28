@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Danh sách khiếu nại của gia đình học viên</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Khiếu nại</li>
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
                        <h3 class="card-title"><i class="fab fa-buromobelexperte"></i> Danh sách Khiếu nại</h3>
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="table-responsive">
                            <table id="report" class="table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Người bảo hộ</th>
                                        <th>Học viên</th>
                                        <th>Vấn đề</th>
                                        <th>Nội dung</th>
                                        <th>Hành động</th>
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
        {{ Form::open(['route' => ['admin.report.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-report-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}      
    </section>

    <div class="mess-data"
        data-url-datatable="{{ route('admin.report.list') }}"
        data-url-delete="{{ route('admin.report.destroy', 'ID_REPLY_IN_URL') }}">
    </div>

    @component('admin.components.modals.alert-delete')
        @slot('headerText')
            {{ "Bạn có muốn xóa report" }}
        @endslot
    @endcomponent

@endsection
@section('scripts')
    {{ Html::script(mix('admin/report.js')) }}
@endsection

