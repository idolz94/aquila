@extends('admin.layouts.index')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-lg-12">
                    <h4>Lịch sử chuyển phòng: {{$hocvien->ten}}</h4>
                </div>
                <div class="col-lg-12 mt-2">
                    <a  href="{{ URL::previous() }}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
                <!-- ./col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
            <!-- col -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="detail_phong" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên phòng</th>
                                        <th>Lý do</th>
                                        <th>Ngày vào</th>
                                        <th>Ngày ra</th>
                                    </tr>
                                </thead>
                                <tbody {{$count = 1}}>
                                    @foreach ($hocvien->phong as $item)
                                    <tr>
                                        <td>{{$count++}}</td>                                      
                                        <td>{{$item->ten_phong}}</td>
                                        <td>{{$item->pivot->ly_do}}</td>
                                        <td>{{$item->pivot->created_at->format('d-m-Y')}}</td>
                                        @if($item->pivot->type == 0)
                                            <td>{{$item->pivot->updated_at->format('d-m-Y')}}</td>
                                        @else
                                            <td>Chưa có</td>
                                        @endif
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
            // data table
            let dataTable = $('#detail_phong').DataTable({
                "language": {
                    "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
                },
                "columnDefs": [{
                        'targets': 0,
                        'class': "text-center align-middle"
                    },
                    {
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