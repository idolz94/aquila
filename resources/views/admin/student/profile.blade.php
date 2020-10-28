@extends('admin.layouts.index')
@section('styles')
  {{ Html::style('admin_assets/plugins/fancybox/dist/jquery.fancybox.min.css') }}
@endsection
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6 mb-2">
					<h4>Thông tin chi tiết học viên</h4>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="/">Home</a></li>
					<li class="breadcrumb-item active"> Thông tin chi tiết học viên</li>
				</ol>
			</div>  
			<div class="col-lg-12 mb-2">
				<a  href="{{ URL::previous() }}" class="btn btn-default float-left"><i class="fas fa-undo"></i> Trở về</a>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
		<!-- ./col -->
		<div class="col-md-3 col-12">
			<!-- Profile Image -->
			<div class="card card-outline">
				<div class="card-body box-profile">
					<div class="text-center">
						@if($hocvien->avatar_url !== null)
						<img id="user_avatar" class="profile-user-img img-fluid img-circle"  src="/storage/uploads/user_avatar/icon128/{{$hocvien->avatar_url}}" alt="User profile picture" data-src-image="{{$hocvien->avatar_url}}">
						@else
						<img id="user_avatar" class="profile-user-img img-fluid img-circle"  src="/admin_assets/images/logo/logo-aq-h.png" alt="User profile picture" data-src-image="">
						@endif
					</div>
					<h3 class="profile-username text-center">{{$hocvien->ten}}</h3>
					<p class="text-muted text-center">Học viên</p>
					<ul class="list-group list-group-unbordered mb-3">
						<li class="list-group-item">
							<span>Ngày vào:</span> 
							<a class="float-right">{{date("d-m-Y",strtotime($hocvien->ngay_vao))}}</a>
						</li>
						<li class="list-group-item">
							<span>Số điện thoại:</span> 
							<a class="float-right">{{$hocvien->nguoibaoho->so_dien_thoai}}</a>
						</li>
						<li class="list-group-item">
							<span>CMTND:</span> 
							<a class="float-right">{{$hocvien->so_cmnd}}</a>
						</li>
						<li class="list-group-item">
							<span>TT hôn nhân:</span> 
							<a class="float-right">{{$hocvien->hon_nhan}}</a>
						</li>
						<li class="list-group-item">
							<span>Hạnh kiểm</span> 
							<a class="float-right"> 
								@if($hocvien->hanhkiem != NULL)
									{{$hocvien->hanhkiem->ten_hanh_kiem}}
								@endif                             
							</a>
						</li>
						<li class="list-group-item">
							<span>Kỷ luật (số lần):</span> 
							<a class="float-right"> {{count($hocvien->kyluat()->get())}}</a>
						</li>
						<li class="list-group-item">
							<span>TT hiện tại:</span> 
							<a class="float-right">{{$hocvien->tinh_trang}}</a>
						</li>
						<li class="list-group-item">
							<span>Phòng ở:</span> 
								<a class="float-right">
								@foreach($hocvien->phong as $phong)
									@if($phong->pivot->type == 1)
										{{$phong->ten_phong}}
									@endif
								@endforeach
							</a>
						</li>
						<li class="list-group-item">
							<span>Nhóm học viên:</span> 
							<a class="float-right">
								@foreach($hocvien->nhom as $nhom)
									{{$nhom->ten.","}}
								@endforeach
							</a>
						</li>

						<li class="list-group-item">
							<span>Lớp học:</span> 
							<a class="float-right">
								@foreach($hocvien->lophoc as $lophoc)
									{{$lophoc->ma_lop_hoc.","}}
								@endforeach
							</a>
						</li>

						<li class="list-group-item">
							<span>Sự kiện:</span> 
							<a class="float-right">
								@foreach($hocvien->sukien as $sukien)
									{{$sukien->ten.","}}
								@endforeach
							</a>
						</li>
					</ul>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<div class="col-md-9">
			<div class="card card-info card-outline card-outline-tabs">
			<div class="card-header p-0 border-bottom-0">
				<ul class="nav nav-tabs">
					<li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Thông tin cá nhân</a></li>
					<li class="nav-item"><a class="nav-link" href="#taichinh" data-toggle="tab">Tài chính </a></li>
					<li class="nav-item"><a class="nav-link" href="#daotao" data-toggle="tab">Đào tạo</a></li>
					<li class="nav-item"><a class="nav-link" href="#diemdanh" data-toggle="tab">Điểm danh</a></li>
					<li class="nav-item"><a class="nav-link" href="#hanhkiem" data-toggle="tab">Hạnh kiểm</a></li>
				</ul>
			</div><!-- /.card-header -->
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane active" id="activity">
						<div class="row">
							<div class="col-md-12 col-12">
								<div class="parent_hv mb-5">
									<h5>1. Thông tin người bảo hộ</h5>
									<ul class="list-group list-group-unbordered pl-4">
										<li class="list-group-item border-top-0">Người bảo hộ: {{$hocvien->nguoibaoho->ten}}</li>
										<li class="list-group-item">Số điện thoại: {{$hocvien->nguoibaoho->so_dien_thoai}}</li>
										<li class="list-group-item">Email: {{$hocvien->nguoibaoho->email}}</li>
										<li class="list-group-item">Điạ chỉ: {{$hocvien->dia_chi}}</li>
										<li class="list-group-item">Quan hệ với học viên: {{$hocvien->nguoibaoho->quan_he_hoc_vien}}</li>
									</ul>
								</div>
								<div class="mb-5">
									<h5>2. Tiền án & tiền sự</h5>
									<ul class="list-group list-group-unbordered pl-4">
										<li class="list-group-item border-top-0">Tình trạng hiện tại: {{$hocvien->tinh_trang}}</li>
										<li class="list-group-item">Về tội tiền án: {{$hocvien->tien_an}}</li>
										<li class="list-group-item">Về tội tiền sự: {{$hocvien->tien_su}}</li>
									</ul>
								</div>
								<div class="mb-5">
									<h5>3. Quá trình nghiện</h5>
									<ul class="list-group list-group-unbordered pl-4">
										<li class="list-group-item border-top-0">Loại ma tuý và cách thức sử dụng: {{$hocvien->ma_tuy_su_dung}} - {{$hocvien->hinh_thuc_su_dung}}</li>
										<li class="list-group-item">Ngày phát nghiện: {{$hocvien->lan_dau_su_dung}}</li>
										<li class="list-group-item">Ngày cai nghiện bắt buộc: {{$hocvien->ngay_cai_bat_buoc}}</li>
										<li class="list-group-item">Ngày cai nghiện tự nguyện: {{$hocvien->ngay_cai_tu_nguyen}}</li>
										<li class="list-group-item">Tình trạng sử dụng Methadone: {{$hocvien->methadone}}</li>
									</ul>
								</div>
								<div class="mb-5">
									<h5 class="mb-4">4. Ảnh đơn đăng ký & đơn cam kết</h5>
									<div class="row pl-4">
										@foreach ($anhHocVien as $image)
											<div class="col-md-3 mb-2">
												<a data-fancybox="gallery" href="{{ asset(show_original_img(Config::get('images.paths.image_hocvien'), $image->anh_hoc_vien)) }}"><img class="img-fluid" src="{{ asset(show_original_img(Config::get('images.paths.image_hocvien'), $image->anh_hoc_vien)) }}"></a>
											</div>
										@endforeach
									</div>
								</div>
								<div class="mb-5">
									<h5 class="mb-4">5. Ảnh quá trình tại trung tâm</h5>
									<div class="row pl-4">
										@foreach ($anhQuaTrinh as $image)
											<div class="col-md-3">
												<a data-fancybox="gallery" href="{{ asset(show_original_img(Config::get('images.paths.image_hocvien'), $image->anh_hoc_vien)) }}"><img class="img-fluid" src="{{ asset(show_original_img(Config::get('images.paths.image_hocvien'), $image->anh_hoc_vien)) }}"></a>
											</div>
										@endforeach
									</div>
								</div>
							</div>
							<!-- /.col -->
						</div>
					</div>
					<!-- /.tab-pane -->
					<div class="tab-pane" id="taichinh">
						
						<div class="d-flex justify-content-between mb-2">
							<div>
								@if ( $hocvien->tong_ngay_co_mat )
									<h3>Số ngày sinh hoạt tại trung tâm : <span class="text-success">{{$hocvien->tong_ngay_co_mat}} ngày</span></h3>
								@endif
								@if ( $hocvien->tong_ngay_nghi )
									<h3>Số ngày vắng mặt : <span class="text-danger">{{$hocvien->tong_ngay_nghi}} ngày</span></h3>
								@endif
							</div>
						</div>
						
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
						@if(isset($taichinh) )
							<div class="text-right mb-2">
								<a href="{{route('admin.taichinh.export',$hocvien->id)}}" class="btn btn-success" title="Xuất file excel danh sách học viên">
									<i class="fas fa-file-excel"></i> Xuất file Excel
								</a>
							</div>
						
							<!-- The taichinh -->
							<table id="total_taichinh" class="table table-bordered text-center" width="100%"> 
								<thead>
									<tr>
										<th>STT</th>
										<th>Tháng</th>
										<th>Diễn giải</th>
										<th>Khoản thu</th>
										<th>Khoản chi</th>
										<th>Số tiền còn lại</th>
									</tr>
								</thead>
								@if(isset($taichinh) )
									<tbody class="filter_show">
										@foreach ($taichinh as $item)
										<tr>
											<td>{{$item->id}}</td>
											<td>{{$item->thang}}</td>
											<td>{{$item->ten_dien_giai}}</td>
											<td>
											@php echo number_format($item->thu,0).'  '.'vnd' @endphp
											</td>
											<td>
											@php echo number_format($item->chi,0).'  '.'vnd' @endphp
											</td>
											<td>{{$item->ghi_chu}}</td>
										</tr>
										@endforeach                     
									</tbody>
									<tfoot>
										<tr>
											<td class="font-weight-bold" colspan="3">Tổng Tiền :</td>
											<td>
											@php echo number_format($taichinh->sum('thu'),0).'  '.'vnd' @endphp
											</td>
											<td>
											@php echo number_format($taichinh->sum('chi'),0).'  '.'vnd' @endphp
											</td>
											<td>
												<strong>@php echo number_format($taichinh->sum('thu')-$taichinh->sum('chi'),0).'  '.'vnd' @endphp</strong>
											</td>
										</tr>
									<tfoot>
								@endif
							</table>
						@endif
					</div>
					<!-- /.tab-pane -->

					<div class="tab-pane" id="daotao">
						@if(count($hocvien->lophoc)>0)
							<a href="{{route('admin.hoc-vien.diem.export',$hocvien->id)}}" class="btn btn-success mb-2" title="Xuất file excel danh sách học viên">
								<i class="fas fa-file-excel"></i> Xuất file Excel
							</a>

							@foreach($hocvien->lophoc as $lophoc)
								<ul class="list-group list-group-unbordered mb-2">
									<li class="list-group-item">Lớp học : <strong>{{ $lophoc->ma_lop_hoc }}</strong></li>
									<li class="list-group-item">Môn học : <strong>{{ $lophoc->monhoc->mon_hoc }}</strong></li>
									<li class="list-group-item">Ngày bắt đầu : <strong>{{date("d-m-Y", strtotime($lophoc->ngay_bat_dau)) }}</strong></li>
									<li class="list-group-item border-bottom-0">Ngày kết thúc : <strong>{{ date("d-m-Y", strtotime($lophoc->ngay_ket_thuc)) }}</strong></li>
								</ul>
								<div class="dataTables_wrapper dt-bootstrap4">
									<table id="tb_point" class="table table-bordered dt-responsive nowrap">
										<thead>
											<tr class="text-center">
												<th width="20px">Stt</th>
												<th>Lý do</th>
												<th>Điểm</th>                                       
												<th>Ngày cho điểm</th>
											</tr>
										</thead>
										<tbody class="text-center">
											@foreach ($diem_mon_hocs as $key => $item)
												<tr>
													@if($item->lop_hoc_id == $lophoc->id)
														<td>{{ $key+1 }} </td>
														<td>{{ $item->ten }}</td>
														<td>{{ $item->diem }}</td>
														<td>{{ date("d-m-Y", strtotime($item->created_at)) }}</td>
													@endif
												</tr>
											@endforeach 
										</tbody>
									</table>
								</div>   
							@endforeach               
						@else
							<span>Hiện tại chưa có lớp học cho học viên này!</span>
						@endif
					</div>

					<div class="tab-pane" id="diemdanh">
						@if(count($hocvien->lophoc)>0)
							<a href="{{route('admin.hoc-vien.diemdanh.export',$hocvien->id)}}" class="btn btn-success mb-2" title="Xuất file excel điểm danh học viên">
								<i class="fas fa-file-excel"></i> Xuất file Excel
							</a>
						@endif
						@foreach($hocvien->lophoc as $lophoc)
							<ul class="list-group list-group-unbordered mb-2">
								<li class="list-group-item">Lớp học : <strong>{{ $lophoc->ma_lop_hoc }}</strong></li>
								<li class="list-group-item">Môn học : <strong>{{ $lophoc->monhoc->mon_hoc }}</strong></li>
								<li class="list-group-item">Ngày bắt đầu : <strong>{{date("d-m-Y", strtotime($lophoc->ngay_bat_dau)) }}</strong></li>
								<li class="list-group-item border-bottom-0">Ngày kết thúc : <strong>{{ date("d-m-Y", strtotime($lophoc->ngay_ket_thuc)) }}</strong></li>
							</ul>
							<div class="dataTables_wrapper dt-bootstrap4">
								<table id="tb_diemdanh" class="table table-bordered dt-responsive nowrap" style="width:100%">
									<thead>
										<tr class="text-center">
											<th>STT</th>
											<th>Ngày điểm danh</th>
											<th>Ca sáng</th>
											<th>Điểm danh</th>
											<th>Ca chiều</th>
											<th>Điểm danh</th>
										</tr>
									</thead>
									<tbody>
										@foreach($lophoc->thoikhoabieu_hocvien() as $key => $tkb)
											<tr>
												<td>{{ $key+1 }}</td>
												<td>{{ date("d-m-Y", strtotime($tkb->ngay)) }}</td>
												<td>{{ $tkb->sang }} </td>
												<td>
													@foreach($hocvien->diemdanh as $diemdanh)
														@if($diemdanh->pivot->lop_hoc_id == $tkb->lop_hoc_id && $tkb->ngay == $diemdanh->pivot->ngay)
															@if($diemdanh->pivot->ca_hoc == 0)
																<i class="icon fas fa-check text-success"></i>
															@endif
															
														@endif
													@endforeach 
													@if($tkb->ngay < date('Y-m-d') && $hocvien->checkNotDiemDanh($tkb->ngay,$lophoc->id,0) == null )
														<i class="icon fas fa-times text-danger"></i>
													@endif 
												</td>
												<td>{{ $tkb->chieu }}</td>
												<td>
													@foreach($hocvien->diemdanh as $diemdanh)
														@if($diemdanh->pivot->lop_hoc_id == $tkb->lop_hoc_id && $tkb->ngay == $diemdanh->pivot->ngay)
															@if($diemdanh->pivot->ca_hoc)
																@if($diemdanh->pivot->ca_hoc == 1)
																	<i class="icon fas fa-check text-success"></i>
																@endif
															@endif
														@endif
													@endforeach 
													@if($tkb->ngay < date('Y-m-d') && $hocvien->checkNotDiemDanh($tkb->ngay,$lophoc->id,1) == null )
														<i class="icon fas fa-times text-danger"></i>
													@endif
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						@endforeach               
					</div>

					<div class="tab-pane" id="hanhkiem">
						@if($hocvien->hanhkiem != NULL)     
							<h4> Đánh giá hạnh kiểm</h4>
							<div id="hv_danhgia_wrapper" class="table-responsive mb-5">
								<table id="hv_danhgia" class="table table-bordered dt-responsive nowrap" style="width:100%">
									<thead>
										<tr>
											<th>Stt</th>
											<th>Hạnh kiểm</th>
											<th>Ngày kỷ luật</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($hocvien->hanhkiem()->get() as $hanhkiem)
											<tr>
												<td>{{$hanhkiem->id}}</td>
												<td>{{$hanhkiem->ten_hanh_kiem}}</td>
												<td>{{date("d-m-Y", strtotime($hanhkiem->created_at))}}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							<h4> Kỷ luật : {{ count($hocvien->kyluat()->get()) }} lần</h4>
							@if( count($hocvien->kyluat()->get()) !== 0 )
								<div id="hv_kyluat_wrapper" class="table-responsive">
									<table id="hv_kyluat" class="table table-striped table-bordered nowrap" style="width:100%">
										<thead>
											<tr>
												<th>Stt</th>
												<th>Ghi chú</th>
												<th>Lý do</th>
												<th>Ngày kỷ luật</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($hocvien->kyluat()->get() as $kyluat)
												<tr>
													<td>{{$kyluat->id}}</td>
													<td>{{$kyluat->ghi_chu}}</td>
													<td>{{$kyluat->ly_do}}</td>
													<td>{{date("d-m-Y", strtotime($kyluat->ngay))}}</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							@endif
						@else
							<span>Hiện tại chưa có đánh giá hạnh kiểm cho học viên này!</span>
						@endif
					</div>
					<!-- /.tab-pane -->
				</div>
				<!-- /.tab-content -->
			</div><!-- /.card-body -->
			</div>
			<!-- /.nav-tabs-custom -->
		</div>
		<!-- /.col -->
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
  
</section>
<div class="mess-data"
	data-url-show="{{ route('admin.hoc-vien.taichinh.filter', 'ID_REPLY_IN_URL') }}"
	>
</div>
<!-- /.content -->
@endsection
@section('scripts')
  {{ Html::script('admin_assets/plugins/fancybox/dist/jquery.fancybox.min.js') }}
  <script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#tb_diemdanh').DataTable({
        "language": {
            "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
        },
        "columnDefs": [{
                'targets': 0,
                'class': "text-center align-middle"
            },
            {
                'targets': 1,
                'class': "text-center align-middle",
                'sortable': false
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
            },
            {
                'targets': 5,
                'class': "text-center align-middle"
            }
        ],
        "paging": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true
	});
	
	$('#tb_point').DataTable({
        "language": {
            "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
        },
        "columnDefs": [{
                'targets': 0,
                'class': "text-center align-middle"
            },
            {
                'targets': 1,
                'class': "text-center align-middle",
                'sortable': false
            },
            {
                'targets': 2,
                'class': "text-center align-middle"
			},
			{
                'targets': 3,
                'class': "text-center align-middle"
            }
        ],
        "paging": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true
	});
	
	$('#hv_danhgia').DataTable({
        "language": {
            "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
        },
        "columnDefs": [{
                'targets': 0,
                'class': "text-center align-middle"
            },
            {
                'targets': 1,
                'class': "text-center align-middle",
                'sortable': false
            },
            {
                'targets': 2,
                'class': "text-center align-middle"
			}
        ],
        "paging": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true
	});
	

    $(function() {
      let user_avatar = $('#user_avatar');
      // show image avatar
	  let url_image = user_avatar.attr('data-src-image');
	  console.log(url_image)
    //   let dir_path = ""
    //   if(url_image == ""){
		// dir_path = window.location.origin + "/admin_assets/images/logo/logo-aq-h.png";
    //   }else{
    //     dir_path =  window.location.origin + "/storage/uploads/user_avatar/icon128/" + url_image;
    //   }
    //   user_avatar.attr("src", dir_path);

    //   $('#total_taichinh').DataTable({
    //     "language": {
    //       "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
    //     },
    //     "dom": `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>
	// 		<'row'<'col-sm-12'tr>>
	// 		<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
    //     "buttons": [
    //       'print',
    //       'copyHtml5',
    //       'excelHtml5',
    //       'csvHtml5',
    //       'pdfHtml5',
    //     ],
    //     fixedHeader: {
    //       header: true,
    //       footer: true
    //     },
    //     "lengthChange": false,
    //     "info": false,
    //     "autoWidth": true,
    //     searching: false,
    //     "responsive": true
    //   });
	});

	let hocvien_id = $('#filterMonth').data('id');
	let urlAjax = $('.mess-data').data('url-show').replace('ID_REPLY_IN_URL', hocvien_id);

	$('.btn-monthRead').on('click', function(e){
		e.preventDefault();
		console.log('re');
		return;
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

