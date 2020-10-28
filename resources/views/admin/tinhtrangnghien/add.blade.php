@extends('admin.layouts.index')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4>Cập nhật tình trạng nghiện ma tuý: {{$hocvien->ten}}</h4>
                </div>
                <div class="col-lg-12 mt-2">
                    <a  href="/tinhtrangnghien" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <form action="{{ route('admin.tinhtrangnghien.store')}}"  role="form" method="post">
            @csrf
            <input type="hidden" name="hoc_vien_id" value="{{$hocvien->id}}">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title">1. Quá trình sử dụng ma túy:</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label> Sử dụng ma túy lần đầu tiên : </label>
                                            <div class="input-group mb-3">
                                                <input type="date" class="form-control" name="lan_dau" placeholder="Ngày sử dụng lần đầu" required>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Lý do sử dụng ma túy :</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="ly_do" placeholder="Lý do" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Có sử dụng hàng ngày không:  </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="su_dung_hang_ngay" placeholder="Có / Không" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Ngày sử dụng mấy lần</label>
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control" name="ngay_may_lan" placeholder="Lần/ngày" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Mỗi lần sử dụng bao nhiêu (ghi số: ml, bi, viên ...)</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="ham_luong_su_dung" placeholder="ml, bi, viên, tép, chỉ, gam…" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Nếu không sử dụng có chịu được không: </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="khong_su_dung" placeholder="Chịu được / Không chịu được" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Đã dùng những loại ma túy nào : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="da_dung_loai_nao" placeholder="Kể tên" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Đã sử dụng bằng những cách nào? </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="hinh_thuc_su_dung" placeholder="Hít, Hút, ..." required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label> Sử dụng ma túy lần gần đây nhất vào lúc :</label>
                                            <div class="input-group mb-3">
                                                <input type="date" class="form-control" name="su_dung_gan_nhat" placeholder="Ngày" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-12">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title">2. Số lần cai nghiện:</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse" >
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label> Lần này là lần cai nghiện thứ mấy : </label>
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control" name="lan_cai_nghien" placeholder="Số lần" required>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Cai nghiện lần thứ nhất tại: </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="lan_thu_nhat" placeholder="Địa chỉ lần đầu cai" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Thời gian cai nghiện được bao lâu :  </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="thoi_gian_lan_thu_nhat" placeholder="Thời gian lần cai đầu" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>bằng phương pháp nào (ATK, cai vo,…) : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="phuong_phap_lan_thu_nhat" placeholder="Phương pháp cai" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Lý do tái nghiện: </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="ly_do_tai_nghien_lan_thu_nhat" placeholder="Lý do tái nghiện" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Cai nghiện lần thứ hai tại:  </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="lan_thu_hai" placeholder="Địa chỉ cai lần 2" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Thời gian cai nghiện được bao lâu :  </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="thoi_gian_lan_thu_hai" placeholder="Phương pháp lần 2" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label> bằng phương pháp nào (ATK, cai vo,…)</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="phuong_phap_lan_thu_hai" placeholder="Lần gần 2" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label> Lý do tái nghiện : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="ly_do_tai_nghien_lan_thu_hai" placeholder="Lý do tái nghiện lần thứ 2" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-12">
                        <div class="card card-outline card-success">
                            <!-- /.card-header -->
                            <div class="card-header">
                                <h3 class="card-title">3. Các bệnh kèm theo (tên bệnh, mức độ) & Đặc điểm liên quan: </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label> Các bệnh kèm theo (tên bệnh, mức độ):</label>
                                    <textarea rows="4" name="cac_benh_kem_theo" style="width:100%;"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Có thường xuyên sử dụng:</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="thuong_xuyen_su_dung" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Có cơ địa dị ứng:</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="co_dia_di_ung" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Gia đình ai nghiện:</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="gia_dinh_ai_nghien" placeholder="Cơ địa" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-lg-12 mb-4 text-right">
                        <button type="submit" class="btn btn-default mr-2"><i class="fas fa-times"></i> Huỷ bỏ</button>
                        <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Lưu thông tin</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    {{ Html::script(mix('admin/tinhtrangnghien.js')) }}
@endsection