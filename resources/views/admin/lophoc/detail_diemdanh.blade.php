

@extends('admin.layouts.index')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-lg-12">
                    <h4>Chi tiết điểm danh học viên: <strong>{{$hocvien->ten}}</strong></h4>
                    <h4>Lớp học : <strong>{{$lophoc->ma_lop_hoc}}</strong></h4>
                </div>
                <div class="col-lg-12 mt-2">
                    <a  href="{{ URL::previous() }}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
                <!-- ./col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="hv_table" class="table table-bordered">
                                    <thead>                  
                                        <tr>
                                            <th width="20px">STT</th>
                                            <th>Ngày học</th>
                                            <th>Ca sáng</th>
                                            <th>Điểm danh</th>
                                            <th>Ca chiều</th>
                                            <th>Điểm danh</th>
                                        </tr>
                                    </thead>
                                    <tbody>                          
                                        @foreach ($thoikhoabieu as $item) 
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>{{date("d-m-Y",strtotime($item->ngay))}}</td>
                                                <td>
                                                    {{$item->sang}}    
                                                </td>
                                                <td>
                                                    @if(isset($item->ca_hoc) && !empty($item->sang))
                                                        @if($item->ca_hoc[0] == 0)
                                                            <i class="icon fas fa-check text-success"></i>
                                                        @else
                                                            <i class="icon fas fa-times text-danger"></i>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$item->chieu}}
                                                </td>
                                                <td>
                                                    @if(isset($item->ca_hoc) && !empty($item->chieu))
                                                        @if(count($item->ca_hoc)> 1 ||$item->ca_hoc[0] == 1)
                                                            <i class="icon fas fa-check text-success"></i>
                                                        @else
                                                            <i class="icon fas fa-times text-danger"></i>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- ./card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(function() {
            // data table
            let dataTable = $('#hv_table').DataTable({
                "language": {
                    "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
                },
                "columnDefs": [{
                        'targets': 0,
                        'class': "text-center"
                    },
                    {
                        'targets': 1,
                        'class': "text-center",
                        'sortable': false
                    },
                    {
                        'targets': 2,
                        'class': "text-center"
                    },
                    {
                        'targets': 3,
                        'class': "text-center",
                        'sortable': false
                    },
                    {
                        'targets': 4,
                        'class': "text-center",
                        'sortable': false
                    },
                    {
                        'targets': 5,
                        'class': "text-center",
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