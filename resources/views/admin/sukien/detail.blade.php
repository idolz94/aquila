@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Thông tin chi tiết sự kiện</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Sự kiện</li>
                    </ol>
                </div> 
                <div class="col-6 mt-2">
                    <a  href="/sukien" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
                <div class="col-md-6 mt-2 text-right">
                    <a href="{{route('admin.sukien.excel',$sukien->id)}}" class="btn btn-secondary buttons-csv buttons-html5"  type="button"><span><i class="fas fa-file-import mr-1"></i> Xuất dữ liệu Excel</span></a> 
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
                        <h3 class="card-title text-uppercase">{{ $sukien->ten }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-9 order-2 order-md-1">
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Ngày bắt đầu</span>
                                                <span class="info-box-number text-center text-success mb-0">{{ $sukien->ngay_bat_dau}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Ngày kết thúc</span>
                                                <span class="info-box-number text-center text-danger mb-0">{{ $sukien->ngay_ket_thuc}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Số lượng học viên tham gia</span>
                                                <span class="info-box-number text-center text-primary mb-0">{{count($sukien->hocvien)}} <span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Nội dung sự kiện</span>
                                                <hr>
                                                <div class="post pl-3">
                                                    {!! $sukien->noi_dung !!}
                                                </div>                                       
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Kết quả sự kiện</span>
                                                <hr>
                                                <div class="post pl-3">
                                                    @if( $sukien->ket_qua )
                                                        {!! $sukien->ket_qua !!}
                                                    @else
                                                        <span class="d-block text-center">Hiện tại chưa có kết quả cho sự kiện này. Vui lòng cập nhật kết quả sau khi kết thúc sự kiện.</span>
                                                    @endif
                                                </div>                                       
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-3 order-1 order-md-2">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted"><i class="fas fa-cogs"></i> Tác vụ</span>
                                        <p class="text-muted text-center font-11">Lựa chọn các tác vụ để cập nhật thông tin sự kiện</p>
                                        <div class="mt-5">
                                            <a href="" class="btn btn-block btn-success add-hv"><i class="fas fa-user-plus"></i> Thêm học viên</a>
                                            <a href="" class="btn btn-block btn-info update-modal"><i class="far fa-edit"></i> Cập nhật sự kiện</a>
                                            @if(Auth::guard('admin')->user()->role == 1 || Auth::guard('admin')->user()->role == 2 || Auth::guard('admin')->user()->role == 3)
                                            <a href="" class="btn btn-block btn-default delete-trigger" data-id="{{ $sukien->id }}"><i class="far fa-trash-alt"></i> Xoá bỏ sự kiện</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Danh sách học viên có trong sự kiện</span>
                                        <hr>
                                        <table id="table_infohv" class="table table-striped table-bordered dt-responsive nowrap" >
                                            <thead>
                                                <tr>
                                                    <th>Stt</th>
                                                    <th>Mã học viên</th>
                                                    <th>Ảnh học viên</th>
                                                    <th>Tên học viên</th>
                                                    <th>Ngày tham gia</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sukien->hocvien as $item)
                                                    <tr>
                                                        <td></td>
                                                        <td>{{$item->ma_hoc_vien}}</td>
                                                        <td>
                                                        @if($item->avatar_url !== NULL)
                                                        
                                                            <img src="{{"/storage/uploads/user_avatar/icon128/".$item->avatar_url}}" class="user_avatar profile-user-img img-fluid img-circle" alt=""></td>
                                                        @else 
                                                            <img src="/admin_assets/images/logo/logo-aq-h.png" class="user_avatar profile-user-img img-fluid img-circle" alt=""></td>
                                                        @endif
                                                        </td>
                                                        <td>{{$item->ten}}</td>
                                                        <td>{{$item->pivot->created_at->format('d-m-Y')}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /. row -->
                    </div>
                    <!-- /.card-body -->
                </div>                
            </div>
        </div>
        {{ Form::open(['route' => ['admin.sukien.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-sukien-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}      
    </section>

    <div class="mess-data"
        data-url-hocvien="{{ route('admin.sukien.hocvien', 'ID_REPLY_IN_URL') }}"
        data-url-edit="{{ route('admin.sukien.edit', 'ID_REPLY_IN_URL') }}"
        data-url-delete="{{ route('admin.sukien.destroy', 'ID_REPLY_IN_URL') }}"
        
        >
    </div>

    @component('admin.components.modals.alert-delete')
        @slot('headerText')
            {{ "Bạn có muốn xóa sự kiện này không?" }}
        @endslot
    @endcomponent

    @component('admin.components.modals.edit-modal')
        @slot('title')
            Cập nhật thông tin và kết quả sự kiện
        @endslot
        @slot('form')
            <form 
                action="{{route('admin.sukien.ketqua')}}" 
                id="update_event"
                class="mb-0" 
                role="form" 
                method="post">
                @csrf
                <input type="hidden" value="" name="id">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nội dung sự kiện</label>
                            <textarea name="noi_dung" id="edit" class="form-control" rows="4" placeholder="Enter ...">{{ $sukien->noi_dung }}</textarea>
                            <span class="text-danger noi_dung" role="alert"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kết quả sự kiện</label>
                            <textarea name="ket_qua" id="edit-kq" class="form-control" rows="4" placeholder="Enter ...">{{ $sukien->ket_qua }}</textarea>
                            <span class="text-danger ket_qua" role="alert"></span>
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
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@section('scripts')
    <script>
        CKEDITOR.replace('edit');
        CKEDITOR.replace('edit-kq');
        $(function(){
            let elementData = $('.mess-data'),
                urlEdit = elementData.data('url-edit'),
                urlDelete = elementData.data('url-delete'),
                urlStudent = elementData.data('url-hocvien'),
                data = $('.delete-trigger').data('id'),
                form_id = $('#update_event');
            let random = Math.random().toString(36).substring(2) + (new Date()).getTime().toString();
            let random_string = `${random}_${data}`;
            // add hv
            $('.add-hv').attr('href', urlStudent.replace('ID_REPLY_IN_URL', data))
            // delete 
            $('body').on('click', '.delete-trigger', function(event) {
                event.preventDefault();
                $('#modal-danger').modal('show', { backdrop: 'true' });
                let action = urlDelete.replace('ID_REPLY_IN_URL', data);
                $('#delete-sukien-form').attr('action', action);
            })

            $('body').on('click', '#modal-danger .yes-confirm', e => {
                $('#delete-sukien-form').submit();
            })
            // update 
            $('body').on('click', '.update-modal', function(event) {
                event.preventDefault();
                $('#modal-edit').modal('show', { backdrop: 'true' });
                $('input[name="id"]').attr('value', random_string);
            });
            // add id open modal edit
            if( form_id ){
                $('#modal-edit').addClass('modal-edit-width');
            };

            // data table
            let dataTable = $('#table_infohv').DataTable({
                "language": {
                    "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
                },
                'columnDefs': [{
                        'targets': 0,
                        'class': "text-center align-middle"
                    },
                    {
                        'targets': 1,
                        'class': "text-center align-middle"
                    },
                    {
                        'targets': 2,
                        'sortable': false,
                        'class': "text-center align-middle"
                    },
                    {
                        'targets': 3,
                        'class': "text-center align-middle"
                    },
                    {
                        'targets': 4,
                        'class': "text-center align-middle"
                    }
                ],
                "paging": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true
            });

            dataTable.on( 'order.dt search.dt', function () {
                dataTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();


        });
    </script>
@endsection