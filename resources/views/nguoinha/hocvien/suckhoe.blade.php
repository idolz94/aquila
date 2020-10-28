@extends('nguoinha.layouts.index')
@section('content')
<div class="content-header mb-4 bg-white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h5 class="m-0 text-dark">Sức khoẻ</h5>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Sức khoẻ</li>
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
                <form action="" role="form" method="post">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <label for="">Chọn ngày khám:</label>
                        <select name="id" class="form-control mb-2" id="daysHealth">
                            <option onclick="event.preventDefault();">Vui lòng chọn ngày khám</option>
                            @foreach ($khamsuckhoes as $item)
                                <option value="{{$item->id}}">{{ date("d-m-Y",strtotime($item->created_at)) }}</option>
                            @endforeach
                        </select>
                        <span class="font-11">Chọn ngày khám để hiển thị chi tiết sức khoẻ của học viên</span>
                    </form>
                </div>
            </div> 
        </div>
        <div class="col-12">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title flex-grow-1"><i class="nav-icon fas fa-procedures"></i> Sức khoẻ của học viên</h3>
                    <div class="dt-buttons btn-group flex-wrap">
                        <button class="btn btn-secondary buttons-print" type="button"><span>Print</span></button> 
                        <button class="btn btn-secondary buttons-csv buttons-html5" type="button"><span>Csv</span></button>
                        <button class="btn btn-secondary buttons-csv buttons-html5" type="button"><span>Pdf</span></button> 
                        <button class="btn btn-secondary buttons-csv buttons-html5" type="button"><span>Word</span></button>  
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 visible_detail">
                            @if(is_object($khamsuckhoe))
                                <div class="post">
                                    <h5 class=" mb-2">Khám toàn thân</h5>
                                    <p class="font-11">1. Toàn thân (da, niêm mạc, hệ thống hạch, tuyến giáp): {{$khamsuckhoe->toan_than}}</p>
                                    <p href="#" >Mạch : <strong>{{$khamsuckhoe->mach}}</strong></p>
                                    <p href="#" >Huyết áp : <strong>{{$khamsuckhoe->huyet_ap}}</strong></p>
                                    <p href="#" >Nhiệt độ : <strong>{{$khamsuckhoe->nhiet_do}}</strong></p>
                                    <p href="#" >Cân nặng : <strong>{{$khamsuckhoe->can_nang}}</strong></p>
                                    <p href="#" >Nhịp thở : <strong>{{$khamsuckhoe->nhip_tho}}</strong></p>
                                </div>
                                <div class="post">
                                    <h5 class=" mb-2">Khám các cơ quan</h5>
                                    <p class="font-11">2. Các cơ quan: </p>
                                    <p href="#" >Hô hấp : <strong>{{$khamsuckhoe->ho_hap}}</strong></p>
                                    <p href="#" >Tuần hoàn : <strong>{{$khamsuckhoe->tuan_hoan}}</strong></p>
                                    <p href="#" >Tiêu hoá : <strong>{{$khamsuckhoe->tieu_hoa}}</strong></p>
                                    <p href="#" >Thận - tiết niệu, sinh dụ : <strong>{{$khamsuckhoe->tiet_nieu_sinh_duc}}</strong></p>
                                    <p href="#" >Mắt : <strong>{{$khamsuckhoe->mat}}</strong></p>
                                </div>
                                <div class="post">
                                    <h5 class=" mb-2">Khám các cơ quan</h5>
                                    <p class="font-11">3. Tâm thần: </p>
                                    <p href="#" >Biểu hiện chung (tỉnh táo, lẫn lộn, bực dọc, trầm cảm,...) : <strong>{{$khamsuckhoe->bieu_hien_chung}}</strong></p>
                                    <p href="#" >Biểu hiện khác : <strong>{{$khamsuckhoe->bieu_hien_khac}}</strong></p>
                                </div>
                                <div class="post">
                                    <h5 class="mb-2">4. Xét nghiệm ma tuý trong nước tiểu (phương pháp TEST nhanh) :</h5>
                                    <p>{{$khamsuckhoe->test_nhanh}}</p>
                                </div>
                                <div class="post">
                                    <h5 class=" mb-2">5. Tóm tắt bệnh án</h5>
                                    <p class="font-11"> @php echo $khamsuckhoe->noi_dung @endphp</p>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-12 hidden_detail"></div>
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
<div class="mess-data" data-url-filter="{{route('nguoibaoho.suckhoe.detail')}}"></div>
@endsection
@section('scripts')
  <script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	let hocvien_id = $('#filterMonth').data('id');
	let url_filter = $('.mess-data').data('url-filter');

	$('#daysHealth').on('change', function() {
        let day_id = $(this).val();
        
        $.ajax({
            url: url_filter,
            type: 'POST',
            data: { 
                id: day_id,
            },
            success: function(result) {
                filterHealth(result);
            },
            error: function(xhr, thrownError) {
                if (xhr.status == 500) {
                    $('.card-error').removeClass('d-none');
                    $('.card-success-data').addClass('d-none');
                }
            }
        });
    });

	function filterHealth(data){
        console.log(data);
        // return;
        $('.visible_detail').hide();
        $('.hidden_detail').show();
        let arr_lh = '';
        if ($('.hidden_detail').empty()) {
            arr_lh = `<div class="post">
                    <h5 class=" mb-2">Khám toàn thân</h5>
                    <p class="font-11">1. Toàn thân (da, niêm mạc, hệ thống hạch, tuyến giáp): ${data.toan_than}</p>
                    <p href="#" >Mạch : <strong>${data.mach}</strong></p>
                    <p href="#" >Huyết áp : <strong>${data.huyet_ap}</strong></p>
                    <p href="#" >Nhiệt độ : <strong>${data.nhiet_do}</strong></p>
                    <p href="#" >Cân nặng : <strong>${data.can_nang}</strong></p>
                    <p href="#" >Nhịp thở : <strong>${data.nhip_tho}</strong></p>
                </div>
                <div class="post">
                    <h5 class=" mb-2">Khám các cơ quan</h5>
                    <p class="font-11">2. Các cơ quan: </p>
                    <p href="#" >Hô hấp : <strong>${data.ho_hap}</strong></p>
                    <p href="#" >Tuần hoàn : <strong>${data.tuan_hoan}</strong></p>
                    <p href="#" >Tiêu hoá : <strong>${data.tieu_hoa}</strong></p>
                    <p href="#" >Thận - tiết niệu, sinh dụ : <strong>${data.tiet_nieu_sinh_duc}</strong></p>
                    <p href="#" >Mắt : <strong>${data.mat}</strong></p>
                </div>
                <div class="post">
                    <h5 class=" mb-2">Khám các cơ quan</h5>
                    <p class="font-11">3. Tâm thần: </p>
                    <p href="#" >Biểu hiện chung (tỉnh táo, lẫn lộn, bực dọc, trầm cảm,...) : <strong>${data.bieu_hien_chung}</strong></p>
                    <p href="#" >Biểu hiện khác : <strong>${data.bieu_hien_khac}</strong></p>
                </div>
                <div class="post">
                    <h5 class="mb-2">4. Xét nghiệm ma tuý trong nước tiểu (phương pháp TEST nhanh) :</h5>
                    <p>${data.test_nhanh}</p>
                </div>
                <div class="post">
                    <h5 class=" mb-2">5. Tóm tắt bệnh án</h5>
                    <p class="font-11"> ${data.noi_dung}</p>
                </div>`;
                $('.hidden_detail').append(arr_lh);
        };
	}

  </script>
@endsection