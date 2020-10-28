@extends('admin.layouts.index')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 mb-2">
                    <h1>Cập nhật thông tin tài chính học viên</h1>
                </div>
                <div class="col-lg-12 mb-4">
                    <a  href="{{ URL::previous() }}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <form action="{{ route('admin.taichinh.store')}}"  role="form" method="post">
            @csrf
            <input type="hidden" name="hoc_vien_id" value="{{$hocvien->id}}">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title"><i class="far fa-calendar-alt"></i> Thông tin tài chính</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <h5>1. Số ngày có mặt & vắng mặt tại trung tâm</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tháng</label>
                                            <div class="input-group mb-3">
                                                <input type="month" class="form-control ip_month" name="thang" placeholder="Tháng" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="far fa-calendar-check"></i></span>
                                                </div>
                                            </div>
                                        </div>                                       
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Số ngày có mặt</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control ip_datefound" name="tong_ngay_co_mat" value="" placeholder="Số ngày có mặt" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="far fa-calendar-check"></i></span>
                                                </div>
                                            </div>
                                        </div>                                       
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Số ngày nghỉ</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control ip_datenotfound" name="tong_ngay_ngi" value="" placeholder="Số ngày nghỉ" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="far fa-calendar-times"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <h5>2. Các khoản thu của học viên</h5>
                                    </div>

                                    @foreach ($diengiai_thu as $item)
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>{{$item->ten_dien_giai}}</label>
                                                @if($item->ten_dien_giai == "Chuyển từ tháng trước" && !empty($hocvien->tai_chinh_con_lai ))
                                                    <input type="text" name="so_tien[]"  value="{{$hocvien->tai_chinh_con_lai}}" class="form-control money"placeholder="Số tiền">
                                                @else
                                                    <input type="text" name="so_tien[]"  class="form-control money"placeholder="Số tiền">
                                                @endif
                                                    <input type="hidden" name="dien_giai_tai_chinh[]" value="{{$item->id}}">
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-md-12 mb-2">
                                        <h5>2. Các khoản chi của học viên</h5>
                                    </div>

                                    @foreach ($diengiai_chi as $item)
                                        <div class="col-md-2">
                                            <div class="form-group ">
                                                <label for="">{{$item->ten_dien_giai}}</label><br>
                                                <input type="hidden" name="dien_giai_tai_chinh[]" value="{{$item->id}}">
                                                <input type="text" name="so_tien[]"  class="form-control money" placeholder="Số tiền" required>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-lg-12 mb-4 text-right">
                        <a href="{{ URL::previous() }}" class="btn btn-default mr-2"><i class="fas fa-times"></i> Huỷ bỏ</a>
                        <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Lưu thông tin</button>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <div class="data-mess" data-url-month="{{ route('admin.taichinh.filter', 'ID_REPLY_IN_URL') }}"></div>
@endsection
@section('scripts')
    <script>
        $(function() {
            $('.money').simpleMoneyFormat();

            // get date
            let hv_id = $('input[name="hoc_vien_id"]').val();
            let url_month = $('.data-mess').data('url-month').replace('ID_REPLY_IN_URL', hv_id);
            $('.ip_month').bind('input', function(){
                $.ajax({
                    url: url_month,
                    type: 'GET',
                    data: {
                        month: $(this).val(),
                    },
                    success: function(result) {
                        console.log(result);
                        $('.ip_datefound').val(result.ngay_co_mat);
                        $('.ip_datenotfound').val(result.ngay_nghi);
                    },
                    error: function(xhr, thrownError) {
                        if (xhr.status == 500) {
                            $('.card-error').removeClass('d-none');
                            $('.card-success-data').addClass('d-none');
                        }
                        console.log(thrownError);
                    }
                });
                
            })
        });
    </script>

@endsection
