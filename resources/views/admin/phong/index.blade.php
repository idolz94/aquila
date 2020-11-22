@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Danh sách phòng ở của học viên</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Phòng ở của học viên</li>
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
                        <a href="javascript:void(0)" class="btn btn-success btn-block-sm" data-toggle="modal" data-target="#modal-default">
                            <i class="fas fa-user-plus mr-1"></i> Thêm phòng
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm student_room">
                            <table id="student_room" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Tên phòng</th>
                                        <th>Vị trí</th>
                                        <th>Trưởng phòng</th>
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
        {{ Form::open(['route' => ['admin.phong.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-phong-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}      
    </section>

    <div class="mess-data"
        data-url-datatable="{{ route('admin.phong.list') }}"
        data-url-edit="{{ route('admin.phong.update', 'ID_REPLY_IN_URL') }}"
        data-url-show="{{ route('admin.phong.show', 'ID_REPLY_IN_URL') }}"
        data-url-createhv="{{ route('admin.phong.create.hv', 'ID_REPLY_IN_URL') }}"
        data-url-truongphong="{{ route('admin.phong.truongphong.create', 'ID_REPLY_IN_URL') }}"
        data-url-export="{{ route('admin.phong.export', 'ID_REPLY_IN_URL') }}"
        data-url-delete="{{ route('admin.phong.destroy', 'ID_REPLY_IN_URL') }}">
        
    </div>

    @component('admin.components.modals.alert-delete')
        @slot('headerText')
            {{ "Bạn có muốn xóa phòng ở này không?" }}
        @endslot
    @endcomponent

    @component('admin.components.modals.form-modal')
        @slot('title')
            Thêm mới phòng ở
        @endslot
        @slot('form')
            <form 
                action="{{ route('admin.phong.store') }}" 
                id="create_phong" 
                role="form" 
                method="post" 
                data-url-index="{{ route('admin.phong.index') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Tên phòng</label>
                        <input type="text" name="ten_phong" class="form-control text-capitalize">
                        <span class="text-danger ten_phong" role="alert"></span>
                    </div>
                    <div class="form-group d-flex flex-column">
                        <label>Trưởng phòng</label>
                        <select name="ten_truong_phong" class="form-control" id="leader_group">
                            @foreach ($hocviens as $item)
                                @if($item->phong->isEmpty())
                                    <option value="{{$item->id}}">{{$item->ten}}</option>
                                @endif
                            @endforeach
                        </select>   
                        <span class="text-danger ten_truong_phong" role="alert"></span>
                    </div>
                    <div class="form-group">
                        <label>Vị trí phòng</label>
                        <input type="text" name="vi_tri" class="form-control text-capitalize">
                        <span class="text-danger vi_tri" role="alert"></span>
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
            Cập nhật thông tin phòng ở học viên
        @endslot
        @slot('form')
            <form action=""  role="form" method="post" id="update_room"  data-url-index="{{ route('admin.phong.index') }}">
                @csrf     
                <input name="_method" type="hidden" value="PUT">
                <div class="card-body">
                    <div class="form-group">
                        <label>Tên phòng</label>
                    <input type="text" name="ten_phong" value="" class="form-control">
                        <span class="text-danger ten_phong_update" role="alert"></span>
                    </div>
                    <div class="form-group">
                        <label>Vị trí phòng</label>
                        <input type="text" name="vi_tri"  value="" class="form-control">
                        <span class="text-danger vi_tri_update" role="alert"></span>
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
    {{ Html::script(mix('admin/phong.js')) }}
@endsection

