@extends('nguoinha.layouts.index')
@section('content')
<div class="content-header mb-4 bg-white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h5 class="m-0 text-dark">Điểm danh</h5>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Điểm danh</li>
                </ol>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="" id="create_monhoc" role="form" method="post">
                        @csrf
                        <label for="">Chọn Lớp:</label>
                        <select name="id" class="form-control mb-2" id="select_class">
                            <option onclick="event.preventDefault();">Vui lòng chọn lớp học</option>
                            @foreach($lophocs as $lophoc)
                              <option value="{{$lophoc->id}}">{{$lophoc->ma_lop_hoc}}</option>
                            @endforeach
                        </select>
                        <span class="font-11">Chọn lớp học để hiển thị môn học</span>
                    </form>
                </div>
            </div> 
        </div>
        <div class="col-12">
          <div class="row">
            <div class="col-lg-12">
                <div class="lophoc">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> Số buổi có mặt : <strong class="total-days"></strong> </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="diemdanh_table" class="table table-bordered">
                                        <thead>                  
                                            <tr class="text-center">
                                                <th style="width:100px">Buổi học</th>
                                                <th>Ngày học</th>
                                                <th>Ca học</th>
                                                <th>Trạng thái đi học</th>
                                            </tr>
                                        </thead>
                                        <tbody class="filter_show">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- ./card-body -->
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
    <div class="mess-data"
        data-filter="{{route('nguoibaoho.filter-diemdanh')}}"
    ></div>
</section>
@endsection
@section('scripts')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //hide table filter
            $('.lophoc').hide();

            let table_id = '';
            /* select2 lophoc */
            $('#select_class').select2();
            /* filter lophoc */
            $('#select_class').on('change', function() {
                let lophoc_id = $(this).val();
                let url_filter = $('.mess-data').data('filter');
                $('.total-days').empty();
                $.ajax({
                    url: url_filter,
                    type: 'POST',
                    data: { 
                        id: lophoc_id,
                    },
                    beforeSend: function() {
                        $('.lds-ellipsis').show();
                    },
                    complete: function() {
                        $('.lds-ellipsis').hide();
                    },
                    success: function(result) {
                        console.log(result.message);
                        console.log(result.lophoc);

                        if (result.message.length > 0) {
                            filterClass(result.message);
                            $('.total-days').html(result.lophoc.sobuoi);
                            $('.lophoc').show();
                        } else {
                            Swal.fire({
                                type: 'warning',
                                title: 'Hiện tại chưa có điểm danh cho lớp học này !'
                            })
                        }
                    },
                    error: function(xhr, thrownError) {
                        if (xhr.status == 500) {
                            $('.card-error').removeClass('d-none');
                            $('.card-success-data').addClass('d-none');
                        }
                        console.log(thrownError);
                    }
                });
            });

            function filterClass(dataset) {
                let tbody = $('.filter_show');
                tbody.empty();
                let arr_lh = '';
                let count = 1;
                if (tbody.empty()) {
                    dataset.forEach(element => {
                        arr_lh += `<tr>
                            <td class="align-middle text-center">${count++}</td>
                            <td class="align-middle text-center">${element.ngay}</td>
                            <td class="align-middle text-center">${element.ca_hoc}</td>
                            <td class="align-middle text-center">${element.diem_danh === 1 ? 'Có mặt' : 'Vắng mặt'}</td>
                        </tr>`;
                    });
                    tbody.append(arr_lh);                   
                };
               
            };
        });
    </script>
@endsection