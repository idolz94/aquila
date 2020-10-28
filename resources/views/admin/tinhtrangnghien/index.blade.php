@extends('admin.layouts.index')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4>Tình trạng nghiện</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/khamsuckhoe">Home</a></li>
                        <li class="breadcrumb-item active">Tình trạng nghiện</li>
                    </ol>
                </div> 
                <div class="col-lg-12 mt-2">
                    <a  href="{{ URL::previous() }}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-users"></i> Danh sách học viên</h3>     
                    </div>
                    <div class="card-body">
                        <div id="hv_kyluat_wrapper" class="table-responsive">
                            <table id="hv_kyluat" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Mã học viên</th>
                                        <th>Tên học viên</th>
                                        <th>Ảnh học viên</th>
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
        {{ Form::open(['route' => ['admin.tinhtrangnghien.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-tinhtrangnghien-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}      
    </section>

    <div class="mess-data"
        data-url-datatable="{{ route('admin.tinhtrangnghien.list') }}"
        data-url-edit="{{ route('admin.tinhtrangnghien.edit', 'ID_REPLY_IN_URL') }}"
        data-url-show="{{ route('admin.tinhtrangnghien.show', 'ID_REPLY_IN_URL') }}"
        data-url-create="{{ route('admin.tinhtrangnghien.created', 'ID_REPLY_IN_URL') }}">
    </div>

    @component('admin.components.modals.alert-delete')
        @slot('headerText')
            {{ "Bạn có muốn xóa quá trình nghiện này" }}
        @endslot
    @endcomponent

    {{-- @component('admin.components.modals.edit-modal')
        @slot('title')
            sức khoẻ học viên
        @endslot
        @slot('form')
            <form 
                action="{{ route('admin.tinhtrangnghien.store') }}" 
                id="update_tinhtrangnghien" 
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
    {{ Html::script(mix('admin/tinhtrangnghien.js')) }}
@endsection