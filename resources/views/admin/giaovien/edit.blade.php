@extends('admin.layouts.index')
@section('content')
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h4>Cập nhật thông tin giáo viên </h4>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="/">Home</a></li>
						<li class="breadcrumb-item active"> Cập nhật thông tin giáo viên</li>
					</ol>
				</div> 
				<div class="col-lg-12 mt-2">
					<a  href="{{ URL::previous() }}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
				</div>
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content-header -->
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<form action="{{ route('admin.giaovien.update',$giaovien->id) }} " method="post"  data-url-index="{{ route('admin.giaovien.index') }}"  enctype="multipart/form-data">
						@csrf
						<input name="_method" type="hidden" value="PUT">
						<div class="row">
							<div class="col-lg-12">
								<div class="card card-success card-outline">
									<div class="card-header">
										<h3 class="card-title"><i class="far fa-user"></i> Thông tin cá nhân</h3>
									</div>
								<!-- /.card-header -->
								<div class="card-body">     
									<div class="row">
										<!-- ./ col   -->
										<div class="col-lg-12">
											<div class="show-fileiamge text-center">
												<img class="img-responsive profile-user-img img-fluid img-circle cus-avatar"
												id="avatar"
												src=""
												data-img-src="{{$giaovien->anh_dai_dien}}">
											</div>
											<div class="form-group file-upload m-auto">
												<label class="input-file-trigger" for="fileupload"><i class="fas fa-file-upload"></i> Tải ảnh</label>
												<input type="file" class="form-control input-file" id="fileupload" placeholder="" name="anh_dai_dien">
												@error('anh_dai_dien')
												<span class="text-danger anh_dai_dien" role="alert">{{ $message }}</span>
												@enderror
											</div>
										</div>
										<div class="col-md-4 col-12">
											<div class="form-group">
												<label for="exampleInputEmail1">Họ & tên</label>
												<input type="text" class="form-control text-capitalize" name="ten" id="ipname" value="{{$giaovien->ten}}" placeholder="Họ và tên giáo viên" >
												@error('ten')
												<span class="text-danger ten" role="alert">{{ $message }}</span>
												@enderror
											</div>
										</div>
										<div class="col-md-4 col-12">
											<div class="form-group">
												<label for="exampleInputEmail1">Email</label>
												<input type="email" class="form-control" name="email" value="{{$giaovien->email}}" placeholder="Email">
												@error('email')
												<span class="text-danger email" role="alert">{{ $message }}</span>
												@enderror
											</div>
										</div>
										<div class="col-md-4 col-12">
											<div class="form-group">
												<label for="exampleInputEmail1">Quốc gia</label>
												<input type="text" class="form-control" name="quoc_gia" value="{{$giaovien->quoc_gia}}" placeholder="Quốc gia">
												@error('quoc_gia')
												<span class="text-danger quoc_gia" role="alert">{{ $message }}</span>
												@enderror
											</div>
										</div>
										<div class="col-md-4 col-12">
											<div class="form-group">
												<label for="exampleInputEmail1">Ngày sinh</label>
												<input type="date" class="form-control" name="ngay_sinh" value="{{$giaovien->ngay_sinh}}" placeholder="Ngày sinh" >
												@error('ngay_sinh')
												<span class="text-danger ngay_sinh" role="alert">{{ $message }}</span>
												@enderror
											</div>
										</div>
										<div class="col-md-4 col-12">
											<div class="form-group">
												<label for="exampleInputEmail1">Hệ phái</label>
												<select name="he_phai_id" class="form-control">
												@foreach($hephais as $hephai)
													<option value="{{$hephai->id}}" {{ ( $hephai->id == $giaovien->he_phai_id) ? 'selected' : '' }}>{{$hephai->ten}}</option>
												@endforeach
												</select>
												@error('he_phai_id')
													<span class="text-danger he_phai_id" role="alert">{{ $message }}</span>
												@enderror
											</div>
										</div>
										<div class="col-md-4 col-12">
											<div class="form-group">
												<label for="exampleInputEmail1">Số điện thoại</label>
												<input type="number" class="form-control" placeholder="Số điện thoại" value="{{$giaovien->so_dien_thoai}}" name="so_dien_thoai" id="reservation">
												@error('so_dien_thoai')
												<span class="text-danger so_dien_thoai" role="alert">{{ $message }}</span>
												@enderror
											</div>
										</div>
										<div class="col-md-4 col-12">
											<div class="form-group">
												<label for="exampleInputEmail1">Đối tác</label>
												<input type="text" class="form-control" placeholder="Đối tác" value="{{$giaovien->doi_tac}}" name="doi_tac" id="reservation">
												@error('doi_tac')
													<span class="text-danger doi_tac" role="alert">{{ $message }}</span>
												@enderror
											</div>
										</div>
										<div class="col-md-4 col-12">
											<div class="form-group">
												<label for="exampleInputEmail1">Chức Vụ</label>
												<select name="chuc_vu_id" class="form-control">
												@foreach($chucvus as $chucvu)
													<option value="{{$chucvu->id}}" {{ ( $chucvu->id == $giaovien->chuc_vu_id) ? 'selected' : '' }}>{{$chucvu->ten}}</option>
												@endforeach
												</select>
												@error('chuc_vu_id')
													<span class="text-danger chuc_vu_id" role="alert">{{ $message }}</span>
												@enderror
											</div>
										</div>
										<div class="col-md-4 col-12">
											<div class="form-group">
												<label for="exampleInputEmail1">Người giới thiệu</label>
												<input type="text" class="form-control text-capitalize" placeholder="Người giới thiệu" value="{{$giaovien->nguoi_gioi_thieu}}" name="nguoi_gioi_thieu" id="">
												@error('nguoi_gioi_thieu')
												<span class="text-danger nguoi_gioi_thieu" role="alert">{{ $message }}</span>
												@enderror
											</div>
										</div>
										<div class="col-md-12 col-12">
											<div class="form-group">
												<label for="exampleInputEmail1">Ghi chú</label>
												<input type="text" class="form-control" placeholder="Ghi Chú" value="{{$giaovien->ghi_chu}}" name="ghi_chu" id="">
											</div>
										</div>
										<!-- ./ col   -->
									</div>
								</div>
								<!-- /.card-body -->
								</div>
								<!-- thong tin ca nhan -->
							</div>
							<div class="col-lg-12 mb-4 text-right">
								<button type="submit" class="btn btn-default mr-2"><i class="fas fa-times"></i> Huỷ bỏ</button>
								<button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Lưu thông tin</button>
							</div>
						</div>
					</form>
				</div>
				<!-- ./col -->
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
@endsection
@section('scripts')
	<script>

		let img_url = document.getElementById('avatar');
		let dir_path = "";
		if(img_url.getAttribute('data-img-src') == ""){
			dir_path = window.location.origin + "/admin_assets/images/logo/logo-aq-h.png";
		}else{
		dir_path = window.location.origin + "/storage/uploads/teacher_avatar/icon128/" + img_url.getAttribute('data-img-src');
		};
		img_url.setAttribute('src',dir_path);
	</script>
	{{ Html::script(mix('admin/giaovien.js')) }}
@endsection

