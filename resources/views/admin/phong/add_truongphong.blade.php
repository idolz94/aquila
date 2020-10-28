@extends('admin.layouts.index')
<style>
    input[type="radio"] {
        width: 30px;
        height: 30px;
    }
</style>
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 mb-3">
                    <h1>Cập nhật trưởng phòng: {{$phong->ten_phong}}</h1>
                </div>
                <div class="col-lg-12">
                    <a  href="{{ URL::previous() }}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
                <!-- ./col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <form action="{{route('admin.phong.truongphong')}}" role="form" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title flex-grow-1"><i class="fas fa-users"></i> Danh sách học viên</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" value="{{$phong->id}}" name="id" >
                                <div class="row">
                                    <div class="col-md-12">
                                        <br>
                                        <table class="table table-bordered" id="list_hv">
                                            <thead>                  
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>Mã học viên</th>
                                                    <th>Ảnh học viên</th>
                                                    <th>Họ và tên học viên</th>
                                                    <th>Tích thêm học viên</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($phong->hocvien as $item)
                                                    @if($item->pivot->type == 1)
                                                        <tr>
                                                            <td></td>
                                                            <td>{{$item->ma_hoc_vien}}</td>
                                                            <td>
                                                                @if($item->avatar_url !== NULL)
                                                                    <img class="profile-user-img img-fluid img-circle" src="{{"/storage/uploads/user_avatar/icon128/".$item->avatar_url}}" alt=""></td>
                                                                @else 
                                                                    <img class="profile-user-img img-fluid img-circle" src="/admin_assets/images/logo/logo-aq-h.png" alt=""></td>
                                                                @endif
                                                            </td>
                                                            <td>{{$item->ten}}</td>
                                                            <input type="hidden" name="id" value="{{$phong->id}}">
                                                            <td>
                                                                <input type="radio" name="ten_truong_phong" value="{{$item->id}}" {{$phong->ten_truong_phong == $item->id ? 'checked':''}}>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-4 text-right">
                        <a href="{{ URL::previous() }}"  class="btn btn-default mr-2"><i class="fas fa-times"></i> Huỷ bỏ</a>
                        <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Lưu thông tin</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(function() {
            // data table
            let dataTable = $('#list_hv').DataTable({
                "language": {
                    "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
                },
                "columnDefs": [{
                        'targets': 0,
                        'class': "text-center align-middle"
                    },{
                        'targets': 1,
                        'class': "text-center align-middle"
                    },
                    {
                        'targets': 2,
                        'class': "text-center align-middle",
                        'sortable': false
                    },
                    {
                        'targets': 3,
                        'class': "text-center align-middle"
                    },
                    {
                        'targets': 4,
                        'class': "text-center align-middle",
                        'sortable': false
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