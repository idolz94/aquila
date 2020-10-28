@extends('admin.layouts.index')
@section('content')
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h4>Thêm thông tin giáo viên </h4>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="/">Home</a></li>
						<li class="breadcrumb-item active"> Thêm thông tin giáo viên</li>
					</ol>
				</div> 
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content-header -->
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-lg-12 mb-4">
					<a  href="{{ URL::previous() }}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
				</div>
				<!-- ./col -->
				<div class="col-lg-12">
					<form action="{{ route('admin.giaovien.store') }} " 
						method="post" id="create_giaovien" role="form" 
						data-url-index="{{ route('admin.giaovien.index') }}"
						enctype="multipart/form-data"
					>
						@csrf
						<input name="_method" type="hidden" value="POST">
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
											<div class="col-md-12">
												<div class="show-fileiamge text-center d-none">
													<img class="img-responsive profile-user-img img-fluid img-circle cus-avatar"
														id="avatar"
														src="">
												</div>
												<div class="form-group file-upload m-auto">
													<label class="input-file-trigger" for="fileupload"><i class="fas fa-file-upload"></i> Tải ảnh giáo viên <span class="text-danger">*</span></label>
													<input type="file" class="form-control input-file" id="fileupload" placeholder="" name="anh_dai_dien">
													<span class="text-danger anh_dai_dien" role="alert"></span>
												</div>
											</div>
											<div class="col-md-4 col-12">
												<div class="form-group">
													<label>Họ & tên <span class="text-danger">*</span></label>
													<input type="text" class="form-control text-capitalize" name="ten" id="ipname" value="{{old('ten')}}" placeholder="Họ và tên giáo viên" >
													@error('ten')
														<span class="text-danger ten" role="alert">{{ $message }}</span>
													@enderror
												</div>
											</div>
											<div class="col-md-4 col-12">
												<div class="form-group">
													<label>Email <span class="text-danger">*</span></label>
													<input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Email">
													@error('email')
														<span class="text-danger email" role="alert">{{ $message }}</span>
													@enderror
												</div>
											</div>
											<div class="col-md-4 col-12">
												<div class="form-group">
													<label>Quốc gia</label>
													<select id="country" name="quoc_gia" class="form-control">
													@foreach($nations as $nation )
														<option value="{{$nation['name']}}">{{$nation['name']}}</option>
													@endforeach
													</select>
													<span class="text-danger quoc_gia" role="alert"></span>
												</div>
											</div>
											<div class="col-md-4 col-12">
												<div class="form-group">
													<label>Ngày sinh <span class="text-danger">*</span></label>
													<input type="date" class="form-control" name="ngay_sinh" value="{{old('ngay_sinh')}}"  placeholder="Ngày sinh" >
													@error('ngay_sinh')
														<span class="text-danger ngay_sinh" role="alert">{{ $message }}</span>
													@enderror
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Chức vụ <span class="text-danger">*</span></label>
													<select name="chuc_vu_id" class="form-control">
													@foreach($chucvus as $chucvu)
														<option value="{{$chucvu->id}}">{{$chucvu->ten}}</option>
													@endforeach
													</select>
													@error('chuc_vu_id')
															<span class="text-danger chuc_vu_id" role="alert">{{ $message }}</span>
													@enderror
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Số điện thoại <span class="text-danger">*</span></label>
													<input type="number" class="form-control" value="{{old('so_dien_thoai')}}"  placeholder="Số điện thoại" name="so_dien_thoai" id="reservation">
													@error('so_dien_thoai')
															<span class="text-danger so_dien_thoai" role="alert">{{ $message }}</span>
													@enderror
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Đối tác</label>
													<select name="doi_tac" class="form-control">
														<option value="Lâu Dài">Lâu Dài</option>
														<option value="Ngắn Hạn">Ngắn Hạn</option>
														<option value="Định Kỳ">Định Kỳ</option>
													</select>
													@error('doi_tac')
														<span class="text-danger doi_tac" role="alert">{{ $message }}</span>
													@enderror
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Hệ phái <span class="text-danger">*</span></label>
													<select name="he_phai_id" class="form-control">
													@foreach($hephais as $hephai)
													<option value="{{$hephai->id}}">{{$hephai->ten}}</option>
													@endforeach
													</select>
													@error('he_phai_id')
													<span class="text-danger he_phai_id" role="alert">{{ $message }}</span>
													@enderror
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Người giới thiệu </label>
													<input type="text" class="form-control text-capitalize" value="{{old('nguoi_gioi_thieu')}}"  placeholder="Người giới thiệu" name="nguoi_gioi_thieu" id="">
													<span class="text-danger nguoi_gioi_thieu" role="alert"></span>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label>Ghi chú</label>
													<input type="text" class="form-control" value="{{old('ghi_chu')}}"  placeholder="Ghi chú" name="ghi_chu" id="">
													<span class="text-danger ghi_chu" role="alert"></span>
												</div>
											</div>
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
  {{ Html::script(mix('admin/giaovien.js')) }}
@endsection

