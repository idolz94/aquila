@extends('admin.layouts.index')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h4>Điểm số học viên lớp: {{$lophoc->ma_lop_hoc}}</h4>
                </div>
                <div class="col-lg-12 mt-2">
                    <a  href="{{ URL::previous() }}" class="btn btn-success"><i class="fas fa-undo"></i> Trở về</a>
                </div>
                <!-- col -->
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
                                <div class="form-group">
                                    <form action="{{route('admin.lophoc.diem.lydo')}}" id="filter_date">
                                        <label>Lí do cho điểm số</label>
                                        <input type="hidden" name="lop_hoc_id" value={{$lophoc->id}}>
                                        <select ID="filter_status" name="ly_do_id" class="form-control">
                                            <option onclick="event.preventDefault();">Vui lòng chọn lí do</option>
                                           
                                            @foreach ($ly_dos as $item)
                                                <option value="{{$item->id}}">{{$item->ten}}</option>
                                            @endforeach
                                        </select>
                                        <span class="font-11">Lựa chọn lí do cho điểm để hiện thị chi tiết</span>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ./card-body -->
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <span class="text-center message d-block">Vui lòng chọn lí do cho điểm để hiển thị danh sách điểm số của học viên có trong lớp</span>
                        <div id="table_point_filter" class="d-none">
                            <table class="table table_filter_point table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="20px">Stt</th>
                                        <th>Mã học viên</th>
                                        <th>Ngày</th>
                                        <th>Điểm số</th>
                                    </tr>
                                </thead>
                                <tbody class="filter_show">
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                  
            </div>
        </div>
     
    </section>

    <div class="mess-data" data-url-filter="{{ route('admin.lophoc.diem.lydo') }}"></div>

@endsection
@section('scripts')
    <script>
        $(function() {

            // debounce delay time with on change event
            // function debounce(fn, delay, immediate) {
            //     let timeout;
            //     return function executedFn() {
            //         let context = this; 
            //         let args = arguments; 
            //         let later = function() {
            //             timeout = null;
            //             if (!immediate) fn.apply(context, args);
            //         };
            //         let callNow = immediate && !timeout;
            //         clearTimeout(timeout);
            //         timeout = setTimeout(later, delay);
            //         if (callNow) fn.apply(context, args);
            //     }
            // };
            // let ip_date = $('#start_date');
            // let onChangeHandlerHandler = event => {
            //     const date_time = event.target.value;
            //     console.log(date_time);
            //     $('#filter_date').submit();
            // };
            // const debounced_on_change = debounce(onChangeHandlerHandler, 500); 
            // ip_date.bind('change', debounced_on_change);

            // let user_avatar = $('.user_avatar');
            // // show image avatar
            // for( let i=0; i< user_avatar.length; i++){
            //     let url_image = user_avatar[i].getAttribute('data-src-image');
            //     let dir_path = window.location.origin + "/storage/uploads/user_avatar/icon128/" + url_image;
            //     user_avatar[i].setAttribute("src", dir_path);
            // }

            // select2 
            $('#note_filter').select2();
            
            let elementData = $('.mess-data'),
                urlFilter = elementData.data('url-filter'); 

            $('#filter_status').on('change', function() {
                let status = $(this).val(),
                    class_id = $('input[name="lop_hoc_id"]').val();
                
                $.ajax({
                    url: urlFilter,
                    type: 'GET',
                    data: {
                        lop_hoc_id: class_id,
                        ly_do_id: status
                    },
                    beforeSend: function() {
                        $('.lds-ellipsis').show();
                    },
                    complete: function() {
                        $('.lds-ellipsis').hide();
                    },
                    success: function(result) {
                        let data_student = result.message;
                        console.log('a');
                        console.log(data_student);
                        return;
                        if (data_student[0].diem) {
                            filterClass(data_student);
                            let classList = $('.message').attr('class').split(/\s+/);
                            $.each(classList, function(index, item) {
                                if (item === 'd-block') {
                                     $('.message').removeClass('d-block');
                                     $('.message').addClass('d-none');
                                }
                            });
                            $('#table_point_filter').removeClass('d-none');
                            $('.message').addClass('d-none');
                            $('#table_point_filter').addClass('d-block');
                        } else {
                            Swal.fire({
                                type: 'warning',
                                title: 'Hiện tại không có điểm nào tương ứng !'
                            });
                            $('.message').addClass('d-block');
                            $('.message').removeClass('d-none');
                            let classList = $('#table_point_filter').attr('class').split(/\s+/);
                            $.each(classList, function(index, item) {
                                if (item === 'd-block') {
                                     $('#table_point_filter').removeClass('d-block');
                                     $('#table_point_filter').addClass('d-none');
                                }
                            });
                            
                            
                        }
                    },
                    error: function(xhr, thrownError) {
                        if (xhr.status == 500) {
                            $('.card-error').removeClass('d-none');
                            $('.card-success-data').addClass('d-none');
                        }
                        console.log(thrownError);
                    }
                });
            });

            function filterClass(dataset) {
                let tbody = $('.filter_show');
                let arr_lh = '';
                if (tbody.empty()) {
                    dataset.forEach(element => {
                        arr_lh += `<tr>
                        <td></td>
                        <td>${element.ma_hoc_vien} - ${element.ten}</td>
                        <td>${element.ngay}</td>
                        <td>${element.diem}</td>
                    </tr>`;
                    });
                    tbody.append(arr_lh);
                };
            };
        });
    </script>
@endsection