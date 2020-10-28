@extends('admin.layouts.index')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12">
                    <h4>Chi tiết tình trạng sức khoẻ học viên : <span class="text-uppercase">{{$hocvien->ten}}</span> </h4>
                </div>
                <div class="col-md-12 mt-2">
                    <a  href="{{route('admin.khamsuckhoe.count',$hocvien->id)}}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="post">
                                    <h5 class=" mb-2">Khám toàn thân</h5>
                                    <ul>
                                        <li>Toàn thân (da, niêm mạc, hệ thống hạch, tuyến giáp): <strong>{{$khamsuckhoes->toan_than}}</strong></li>
                                        <li>Mạch : <strong>{{$khamsuckhoes->mach}}</strong></li>
                                        <li>Huyết áp : <strong>{{$khamsuckhoes->huyet_ap}}</strong></li>
                                        <li>Nhiệt độ : <strong>{{$khamsuckhoes->nhiet_do}}</strong></li>
                                        <li>Cân nặng : <strong>{{$khamsuckhoes->can_nang}}</strong></li>
                                        <li>Nhịp thở : <strong>{{$khamsuckhoes->nhip_tho}}</strong></li>
                                    </ul>
                                </div>
                                <div class="post">
                                    <h5 class=" mb-2">Khám các cơ quan</h5>
                                    <ul>
                                        <li>Hô hấp : <strong>{{$khamsuckhoes->ho_hap}}</strong></li>
                                        <li>Tuần hoàn : <strong>{{$khamsuckhoes->tuan_hoan}}</strong></li>
                                        <li>Tiêu hoá : <strong>{{$khamsuckhoes->tieu_hoa}}</strong></li>
                                        <li>Thận - tiết niệu, sinh dụ : <strong>{{$khamsuckhoes->tiet_nieu_sinh_duc}}</strong></li>
                                        <li>Mắt : <strong>{{$khamsuckhoes->mat}}</strong></li>
                                    </ul>
                                </div>
                                <div class="post">
                                    <h5 class=" mb-2">Tâm thần</h5>
                                    <ul>
                                        <li>Biểu hiện chung (tỉnh táo, lẫn lộn, bực dọc, trầm cảm,...) : <strong>{{$khamsuckhoes->bieu_hien_chung}}</strong></li>
                                        <li>Biểu hiện khác : <strong>{{$khamsuckhoes->bieu_hien_khac}}</strong></li>
                                    </ul>
                                </div>
                                <div class="post">
                                    <h5 class="mb-2">Xét nghiệm ma tuý trong nước tiểu:</h5>
                                    <ul>
                                        <li>Phương pháp TEST nhanh: <strong>{{$khamsuckhoes->test_nhanh}}</strong> </li>
                                    </ul>
                                </div>
                                <div class="post">
                                    <h5 class=" mb-2">Tóm tắt bệnh án</h5>
                                    <p> @php echo $khamsuckhoes->noi_dung @endphp</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                  
            </div>
        </div>
           
    </section>

@endsection
