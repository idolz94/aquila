@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Lịch sử hạnh kiểm của học viên</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active"> Hạnh kiểm của học viên</li>
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
            <!-- col -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title flex-grow-1 text-uppercase"><i class="fas fa-user mr-1"></i> {{$hocvien->ten}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="detail_phong" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Hạnh kiểm</th>
                                        <th>Ngày đánh giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hocvien->hanhkiem()->get() as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>                                      
                                            <td>{{$item->ten_hanh_kiem}}</td>
                                            <td>{{$item->created_at->format('d-m-Y')}}</td>
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
        $(function() {
            $('#detail_phong').DataTable({
                "language": {
                    "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
                },
                'columnDefs': [{
                        'targets': 0,
                        'sortable': false,
                        'class': 'text-center align-middle'
                    },
                    {
                        'targets': 1,
                        'class': 'text-center align-middle'
                    },
                    {
                        'targets': 2,
                        'class': 'text-center align-middle'
                    }
                ],
                "paging": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true
            });
        });
    </script>
@endsection
