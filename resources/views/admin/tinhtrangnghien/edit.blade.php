@extends('admin.layouts.index')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <h4>Cập nhật tình trạng nghiện ma tuý : <strong>{{$hocvien->ten}}</strong> </h4>
                </div>
                <div class="col-lg-12 mb-4">
                    <a  href="/tinhtrangnghien" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <form action="{{ route('admin.tinhtrangnghien.update',$hocvien->id)}}"  role="form" method="post">
            @csrf
            @method('PUT')
            <div class="container-fluid">
                <div class="row">
                    <input type="hidden" name="tinh_trang_nghien_id" value="{{$tinhtrangnghiens->tinh_trang_nghien_id}}">
                    <div class="col-md-6 col-6">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title">1. Quá trình sử dụng ma túy: </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Sử dụng ma túy lần đầu tiên : </label>
                                            <div class="input-group mb-3">
                                                <input type="date" class="form-control" name="lan_dau" value="{{$tinhtrangnghiens->lan_dau}}" placeholder="Ngày sử dụng lần đầu">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Lý do sử dụng ma túy :</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="ly_do" value="{{$tinhtrangnghiens->ly_do}}"  placeholder="lý do">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Có sử dụng hàng ngày không:  </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="su_dung_hang_ngay" value="{{$tinhtrangnghiens->su_dung_hang_ngay}}" placeholder="Có / Không">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Ngày sử dụng mấy lần</label>
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control" name="ngay_may_lan" value="{{$tinhtrangnghiens->ngay_may_lan}}" placeholder="lần/ngày">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Mỗi lần sử dụng bao nhiêu (ghi số: ml, bi, viên, tép, chỉ, gam…)</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="ham_luong_su_dung" value="{{$tinhtrangnghiens->ham_luong_su_dung}}" placeholder="ml, bi, viên, tép, chỉ, gam…">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nếu không sử dụng có chịu được không: </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="khong_su_dung"  value="{{$tinhtrangnghiens->khong_su_dung}}" placeholder="Chịu được / Không chịu được">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Đã dùng những loại ma túy nào : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="da_dung_loai_nao"  value="{{$tinhtrangnghiens->da_dung_loai_nao}}" placeholder="kể tên">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Đã sử dụng bằng những cách nào? </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="hinh_thuc_su_dung" value="{{$tinhtrangnghiens->hinh_thuc_su_dung}}" placeholder="hít hút nuốt ...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Sử dụng ma túy lần gần đây nhất vào lúc :</label>
                                            <div class="input-group mb-3">
                                                <input type="date" class="form-control" name="su_dung_gan_nhat" value="{{$tinhtrangnghiens->su_dung_gan_nhat}}"  placeholder="Ngày">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title">2. Số lần cai nghiện:  </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Lần này là lần cai nghiện thứ mấy : </label>
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control" name="lan_cai_nghien" value="{{$tinhtrangnghiens->lan_cai_nghien}}" placeholder="Số lần ">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Cai nghiện lần thứ nhất tại: </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="lan_thu_nhat" value="{{$tinhtrangnghiens->lan_thu_nhat}}" placeholder="địa chỉ lần đầu cai ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Thời gian cai nghiện được bao lâu :  </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="thoi_gian_lan_thu_nhat" value="{{$tinhtrangnghiens->thoi_gian_lan_thu_nhat}}" placeholder="Thời gian lần cai đầu ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>bằng phương pháp nào (ATK, cai vo,…) : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="phuong_phap_lan_thu_nhat" value="{{$tinhtrangnghiens->phuong_phap_lan_thu_nhat}}" placeholder="Phương pháp cai">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Lý do tái nghiện: </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="ly_do_tai_nghien_lan_thu_nhat" value="{{$tinhtrangnghiens->ly_do_tai_nghien_lan_thu_nhat}}" placeholder="Lý do tái nghiện">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Cai nghiện lần thứ hai tại:  </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="lan_thu_hai" value="{{$tinhtrangnghiens->lan_thu_hai}}" placeholder="địa chỉ cai lần 2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Thời gian cai nghiện được bao lâu :  </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="thoi_gian_lan_thu_hai" value="{{$tinhtrangnghiens->thoi_gian_lan_thu_hai}}" placeholder="Phương pháp lần 2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> bằng phương pháp nào (ATK, cai vo,…)</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="phuong_phap_lan_thu_hai" value="{{$tinhtrangnghiens->phuong_phap_lan_thu_hai}}" placeholder="Lần gần nhất">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Lý do tái nghiện : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="ly_do_tai_nghien_lan_thu_hai" value="{{$tinhtrangnghiens->ly_do_tai_nghien_lan_thu_hai}}" placeholder="ly_do_tai_nghien_lan_thu_hai">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="card card-outline card-success">
                            <!-- /.card-header -->
                            <div class="card-header">
                                <h3 class="card-title">3. Các bệnh kèm theo (tên bệnh, mức độ): </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                             
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>  Các bệnh kèm theo (tên bệnh, mức độ):  </label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="cac_benh_kem_theo" value="{{$tinhtrangnghiens->cac_benh_kem_theo}}" placeholder="">
                                    </div>
                                </div>
                            </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="card card-outline card-success">
                            <!-- /.card-header -->
                          
                            <div class="card-header">
                                <h3 class="card-title">4. Đặc điểm liên quan: </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Có thường xuyên sử dụng:   </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="thuong_xuyen_su_dung" value="{{$tinhtrangnghiens->thuong_xuyen_su_dung}}" placeholder=" ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Có cơ địa dị ứng:   </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="co_dia_di_ung" value="{{$tinhtrangnghiens->co_dia_di_ung}}" placeholder=" ">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="card card-outline card-success">
                            <!-- /.card-header -->
                          
                            <div class="card-header">
                                <h3 class="card-title">5. Trong gia đình còn ai nghiện ma túy (ghi rõ: cha, mẹ, anh, chị, em…) </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Gia đình ai nghiện:   </label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="gia_dinh_ai_nghien" value="{{$tinhtrangnghiens->gia_dinh_ai_nghien}}" placeholder="cơ địa ">
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
    {{-- {{ Html::script(mix('admin/tinhtrangnghien.js')) }} --}}
@endsection