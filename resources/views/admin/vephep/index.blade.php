@extends('admin.layouts.index')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="col-12">
                        <a href="javascript:void(0)" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                            <i class="far fa-calendar-plus"></i> Thêm mới về phép
                        </a>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-users"></i> Danh sách về phép - Tên HV : {{$hocvien->ten}} - Mã HV :{{$hocvien->ma_hoc_vien}}</h3>     
                    </div>
                    <div class="card-body">
                        <div id="hv_kyluat_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <table id="example2" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Ngày về</th>
                                        <th>Ngày quay lại</th>
                                        <th>Lý do</th>
                                        <th>Tình trạng</th>
                                        <th>Ghi chú</th>
                                        <th width="10%">Tác vụ</th>
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
        {{ Form::open(['route' => ['admin.ve-phep.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-ve-phep-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}      
    </section>

    <div class="mess-data"
        data-url-datatable="{{ route('admin.ve-phep.list',$hocvien->id) }}"
        data-url-edit="{{ route('admin.ve-phep.update', 'ID_REPLY_IN_URL') }}"
        data-url-show="{{ route('admin.ve-phep.show', 'ID_REPLY_IN_URL') }}"
        data-url-delete="{{ route('admin.ve-phep.destroy', 'ID_REPLY_IN_URL') }}">
        
    </div>

    @component('admin.components.modals.alert-delete')
        @slot('headerText')
            {{ "Bạn có muốn xóa về phép" }}
        @endslot
    @endcomponent

    @component('admin.components.modals.form-modal')
        @slot('title')
            Về phép học viên
        @endslot
        @slot('form')
        <form action="{{ route('admin.ve-phep.store') }}" id="create_vephep" role="form" method="post" data-url-index="{{ route('admin.hoc-vien.ve-phep',$hocvien->id) }}">
            @csrf
            <input type="hidden" value="{{$hocvien->id}}" name="hoc_vien_id"> 
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Ngày về:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                                <input type="date" name="ngay_ve" class="form-control float-right">
                        </div>
                        <span class="text-danger ngay_ve" role="alert"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Ngày quay lại:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="date" name="ngay_vao" class="form-control float-right">
                        </div>
                        <span class="text-danger ngay_vao" role="alert"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Tình trạng quay lại</label>
                        <input type="text" name="tinh_trang" class="form-control" placeholder="Tình trạng quay lại">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Lý do</label>
                        <select name="ly_do" class="form-control">
                            <option value="0">Xin Về</option>
                            <option value="1">Trốn</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Ghi chú</label>
                        <textarea name="ghi_chu" class="form-control" placeholder="Ghi chú"></textarea>
                    </div>
                    
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Hủy bỏ</button>
                <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Lưu thông tin</button>
            </div>
        </form>
        @endslot
    @endcomponent

    @component('admin.components.modals.edit-modal')
        @slot('title')
            Cập nhật thông tin về phép của học viên
        @endslot
        @slot('form')
        <form action="" id="update_vephep" role="form" method="put" data-url-index="{{ route('admin.hoc-vien.ve-phep',$hocvien->id) }}">
            @csrf
            @method('PUT')
            <input type="hidden" value="{{$hocvien->id}}" name="hoc_vien_id"> 
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Ngày về:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                                <input type="date" name="ngay_ve" class="form-control float-right">
                        </div>
                        <span class="text-danger ngay_ve" role="alert"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Ngày quay lại:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="date" name="ngay_vao" class="form-control float-right">
                        </div>
                        <span class="text-danger ngay_vao" role="alert"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Tình trạng quay lại</label>
                        <input type="text" name="tinh_trang" class="form-control" placeholder="Tình trạng quay lại">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Lý do</label>
                        <select name="ly_do" class="form-control">
                            <option value="0">Xin Về</option>
                            <option value="1">Trốn</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Ghi chú</label>
                        <textarea name="ghi_chu" class="form-control" placeholder="Ghi chú"></textarea>
                    </div>
                    
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
    <script>
        $(function() {
            
        });
    </script>
    {{ Html::script(mix('admin/vephep.js')) }}
@endsection