@extends('nguoinha.layouts.index')
@section('content')
<div class="content-header mb-4 bg-white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h5 class="m-0 text-dark">Học phí</h5>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Học phí</li>
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            <div>
                                <h5>Lọc theo tháng</h5>
                                <form action="" method="get" data-id="{{ $hocvien->id }}" id="filterMonth">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="month" name="month" id="" class="form-control">
                                    </div>
                                    </div>
                                    <div class="col-md-4">
                                    <button type="submit" class="btn btn-info btn-monthRead">
                                        <i class="fa fa-search mr-1" aria-hidden="true"></i> Tìm kiếm
                                    </button>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="total_taichinh" class="table table-bordered text-center" width="100%"> 
                                    <thead>
                                        <tr>
                                        <th>STT</th>
                                        <th>Ngày</th>
                                        <th>Diễn giải</th>
                                        <th>Thu</th>
                                        <th>Chi</th>
                                        <th>Tồn</th>
                                        </tr>
                                    </thead>
                                    @if(isset($taichinhs) )
                                        <tbody class="filter_show">
                                            @foreach ($taichinhs as $item)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->thang}}</td>
                                                <td>{{$item->ten_dien_giai}}</td>
                                                <td>
                                                @if(number_format($item->thu,0) == 0)
                                                    <span> </span>
                                                @else
                                                    @php echo number_format($item->thu,0).'  '.'vnd' @endphp
                                                @endif
                                                </td>
                                                <td>
                                                @if(number_format($item->chi,0) == 0)
                                                    <span> </span>
                                                @else
                                                    @php echo number_format($item->chi,0).'  '.'vnd' @endphp
                                                @endif
                                                </td>
                                                <td>{{$item->ghi_chu}}</td>
                                            </tr>
                                            @endforeach                     
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td class="font-weight-bold" colspan="3">Tổng Tiền :</td>
                                            <td>
                                            @php echo number_format($taichinhs->sum('thu'),0).'  '.'vnd' @endphp
                                            </td>
                                            <td>
                                            @php echo number_format($taichinhs->sum('chi'),0).'  '.'vnd' @endphp
                                            </td>
                                            <td>
                                            @php echo number_format($taichinhs->sum('thu')-$taichinhs->sum('chi'),0).'  '.'vnd' @endphp
                                            </td>
                                        </tr>
                                        <tfoot>
                                    @endif
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
        <!-- /.row -->
    </div>
</section>
<div class="mess-data"
	data-url-show="{{ route('nguoibaoho.hoc-phi.filter', 'ID_REPLY_IN_URL') }}"
	>

@endsection
@section('scripts')
<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
  });
  let hocvien_id = $('#filterMonth').data('id');
	let urlAjax = $('.mess-data').data('url-show').replace('ID_REPLY_IN_URL', hocvien_id);

	$('.btn-monthRead').on('click', function(e){
		e.preventDefault();
		let month = $('input[type="month"]').val();
		$.ajax({
            url: urlAjax,
            type: 'GET',
            data: {
				month: month
			},
            success: data => {
				showData(data.message);
            },
            error: data => {
				Swal.fire({
					type: 'warning',
					title: 'Hiện tại không có tài chính cho tháng này !'
				})
                if (data.status == 422) {
                    showMessErrForm(data.responseJSON.errors)
                }
            },
            // xhr: progressUpload,
        });
	});
    function showData(priceMonth){
		let tbody = $('.filter_show');
        let arr_lh = '';
        console.log(priceMonth);
        if (tbody.empty()) {
            priceMonth.forEach(element => {
                arr_lh += `<tr>
                <td>${element.id}</td>
                <td>${element.thang}</td>
                <td>${element.ten_dien_giai}</td>
				<td>
					${element.thu === null ? "" : element.thu  }
				</td>
                <td>${element.chi === null ? "" : element.chi  }</td>
                <td>
                    
                </td>
             </tr>`;
            });
            tbody.append(arr_lh);
        };
	}


</script>
@endsection