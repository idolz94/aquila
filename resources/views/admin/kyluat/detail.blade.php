@extends('admin.layouts.index')
@section('content')
     <!-- Content Header (Page header) -->
     <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Chi tiết kỷ luật học viên</h4>
                    <ul>
                        <li>Học viên : <strong>{{$hocvien->ten}}</strong></li>
                        <li>Mã học viên : <strong>{{$hocvien->ma_hoc_vien}}</strong></li>
                        <li>Số lần vi phạm : <strong>{{count($kyluats)}}</strong></li>
                    </ul>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Đánh giá kỷ luật của học viên</li>
                    </ol>
                </div> 
                <div class="col-md-12 mt-2">
                    <a  href="{{ URL::previous() }}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="hv_kyluat_wrapper" class="table-responsive">
                            <table id="hv_kyluat" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Ngày kỷ luật</th>
                                        <th>Lý do</th>
                                        <th>Ghi chú</th>
                                    </tr>
                                </thead>
                                <tbody {{ $count=1 }}>
                                    @foreach ($kyluats as $kyluat)
                                        <tr>
                                            <td>{{$count++}}</td>
                                            <td>{{date("d-m-Y", strtotime($kyluat->ngay))}}</td>
                                            <td>{{$kyluat->ly_do}}</td>
                                            <td>{{$kyluat->ghi_chu}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                  
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#hv_kyluat').DataTable({
                "language": {
                    "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
                },
                "dt-responsive": true,
                'columnDefs': [{
                        'targets': 0,
                        'class': "text-center align-middle"
                    }, {
                        'targets': 1,
                        'class': "text-center align-middle"
                    },
                    {
                        'targets': 2,
                        'class': "text-center align-middle"
                    },
                    {
                        'targets': 3,
                        'class': "text-center align-middle"
                    }
                ]
            });

        });
    </script>
@endsection
