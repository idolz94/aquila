@extends('admin.layouts.index')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4>Chi tiết tình trạng nghiện ma tuý: {{$hocvien->ten}}</h4>
                </div>
                <div class="col-lg-12 mt-2">
                    <a  href="/tinhtrangnghien" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                            <h5> 1. Quá trình sử dụng ma túy:</h5>
                            <ul>
                                <li>Sử dụng ma túy lần đầu tiên: <strong>{{$tinhtrangnghiens->lan_dau}}</strong></li>
                                <li>Lý do sử dụng ma túy: <strong>{{$tinhtrangnghiens->ly_do}}</strong></li>
                                <li>Có sử dụng hàng ngày không: <strong>{{$tinhtrangnghiens->su_dung_hang_ngay}}</strong></li>
                                <li>Ngày sử dụng mấy lần: <strong>{{$tinhtrangnghiens->ngay_may_lan}} lần/ngày</strong></li>
                                <li>Mỗi lần sử dụng bao nhiêu: <strong>{{$tinhtrangnghiens->ham_luong_su_dung}}</strong></li>
                                <li>Nếu không sử dụng có chịu được không: <strong>{{$tinhtrangnghiens->khong_su_dung}}</strong></li>
                                <li>Đã dùng những loại ma túy nào: <strong>{{$tinhtrangnghiens->da_dung_loai_nao}}</strong></li>
                                <li>Đã sử dụng bằng những cách nào: <strong>{{$tinhtrangnghiens->hinh_thuc_su_dung}}</strong></li>
                                <li>Sử dụng ma túy lần gần đây nhất vào lúc: <strong>{{$tinhtrangnghiens->su_dung_gan_nhat}}</strong></li>
                            </ul>
                            <h5>2. Số lần cai nghiện: </h5>
                            <ul>
                                <li>Lần này là lần cai nghiện thứ mấy: <strong>{{$tinhtrangnghiens->lan_cai_nghien}}</strong></li>
                                <li>Cai nghiện lần thứ nhất tại: <strong>{{$tinhtrangnghiens->lan_thu_nhat}}</strong></li>
                                <li>Thời gian cai nghiện được bao lâu: <strong>{{$tinhtrangnghiens->thoi_gian_lan_thu_nhat}}</strong></li>
                                <li>Bằng phương pháp nào (ATK, cai vo,…): <strong>{{$tinhtrangnghiens->phuong_phap_lan_thu_nhat}}</strong></li>
                                <li>Lý do tái nghiện: <strong>{{$tinhtrangnghiens->ly_do_tai_nghien_lan_thu_nhat}}</strong></li>
                                <li>Cai nghiện lần thứ hai tại: <strong>{{$tinhtrangnghiens->lan_thu_hai}}</strong></li>
                                <li>Thời gian cai nghiện được bao lâu: <strong>{{$tinhtrangnghiens->thoi_gian_lan_thu_hai}}</strong></li>
                                <li>Bằng phương pháp nào (ATK, cai vo,…): <strong>{{$tinhtrangnghiens->phuong_phap_lan_thu_hai}}</strong></li>
                                <li>Lý do tái nghiện: <strong>{{$tinhtrangnghiens->ly_do_tai_nghien_lan_thu_hai}}</strong></li>
                            </ul>
                            <h5>3. Các bệnh kèm theo (tên bệnh, mức độ) & các đặc điểm liên quan:</h5>
                            <ul>
                                <li>Các bệnh kèm theo: <strong>{{$tinhtrangnghiens->cac_benh_kem_theo}}</strong></li>
                                <li>Có thường xuyên sử dụng: <strong>{{$tinhtrangnghiens->thuong_xuyen_su_dung}}</strong></li>
                                <li>Có cơ địa dị ứng: <strong>{{$tinhtrangnghiens->co_dia_di_ung}}</strong></li>
                                <li>Trong gia đình có ai nghiện ma tuý: <strong>{{$tinhtrangnghiens->gia_dinh_ai_nghien}} </strong></li>
                            </ul>
                    </div>
                </div>                  
            </div>
        </div>
           
    </section>

@endsection
