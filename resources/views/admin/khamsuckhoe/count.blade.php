@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Đánh giá sức khoẻ của học viên</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/khamsuckhoe">Khám sức khoẻ</a></li>
                        <li class="breadcrumb-item active"> Đánh giá sức khoẻ học viên</li>
                    </ol>
                </div>  
                <div class="col-lg-12 mt-2">
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
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-users mr-1"></i><span class="text-uppercase">{{$hocvien->ten}}</span></h3>     
                    </div>
                    <div class="card-body">
                        <div id="health_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <table id="health_number" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Ngày và giờ khám sức khoẻ</th>
                                        <th>Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody {{$solan=0}}>
                                    @foreach($counts as $count)
                                        <tr>
                                            <td>{{$solan+1}}</td>
                                            <td>{{date("d-m-Y", strtotime($count->created_at))}}</td>
                                            <td>
                                                <a href="{{route('admin.khamsuckhoe.edit',$count->id)}}" class="btn btn-info"> <i class="fas fa-edit"></i> Cập nhật</a>
                                                <a href="{{route('admin.khamsuckhoe.show',$count->id)}}" class="btn btn-success"> <i class="fas fa-info"></i> Thông tin chi tiết</a>
                                            </td>
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
            $('#health_number').DataTable({
                "language": {
                    "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
                },
                "dt-responsive": true,
                'columnDefs': [{
                        'targets': 0,
                        'sortable': false,
                        'class': "text-center align-middle"
                    }, {
                        'targets': 1,
                        'sortable': false,
                        'class': "text-center align-middle"
                    },
                    {
                        'targets': 2,
                        'sortable': false,
                        'class': "text-center align-middle"
                    }
                ]
            });

        });
</script>
@endsection