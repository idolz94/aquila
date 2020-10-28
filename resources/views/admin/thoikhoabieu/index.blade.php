@extends('admin.layouts.index')
<style>
    .fc-content{
        padding:5px;
        font-size:20px;
        color: #fff;
    }
</style>
@section('content')
    <section class="content-header">
        <div class="container-fluid">
        <H1>Thêm mới thời khóa biểu cho lớp học: <strong>{{ $ma_lop_hoc }}</strong></H1>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- THE CALENDAR -->
                
                <div class="card timeable ">
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div> 
            </div>
        </div>
  
    </section>

    <div class="mess-data"
        data-url-update="{{ route('admin.thoi-khoa-bieu.update', 'ID_REPLY_IN_URL') }}">
    </div>

    @component('admin.components.modals.form-modal')
        @slot('title')
            Thêm giờ học
        @endslot
        @slot('form')
            <form action="{{route('admin.thoi-khoa-bieu.store')}}" id="create_hours" role="form" method="post" data-url-index="">
                @csrf
                <input type="hidden" name="start_date">
                <input type="hidden" name="end_date">
                <input type="hidden" name="current_date">
                <input type="hidden" name="lop_hoc_id">
                <div class="card-body" style="min-height:300px;">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Ca học sáng</label>

							<div class="input-group date" id="timepicker_moring_start" data-target-input="nearest">
								<input type="text" class="form-control datetimepicker-input" name="time_start_sang" data-target="#timepicker_moring_start" placeholder="Giờ bắt đầu">
								<div class="input-group-append" data-target="#timepicker_moring_start" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="far fa-clock"></i></div>
								</div>
							</div>

							<div class="input-group date mt-3" id="timepicker_moring_end" data-target-input="nearest">
								<input type="text" class="form-control datetimepicker-input" name="time_end_sang" data-target="#timepicker_moring_end" placeholder="Giờ kết thúc">
								<div class="input-group-append" data-target="#timepicker_moring_end" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="far fa-clock"></i></div>
								</div>
							</div>

                            <span class="text-danger ten" role="alert"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Ca học chiều</label>

							<div class="input-group date" id="timepicker_afternoon_start" data-target-input="nearest">
								<input type="text" class="form-control datetimepicker-input" name="time_start_chieu" data-target="#timepicker_afternoon_start" placeholder="Giờ bắt đầu">
								<div class="input-group-append" data-target="#timepicker_afternoon_start" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="far fa-clock"></i></div>
								</div>
							</div>

							<div class="input-group date mt-3" id="timepicker_afternoon_end" data-target-input="nearest">
								<input type="text" class="form-control datetimepicker-input" name="time_end_chieu" data-target="#timepicker_afternoon_end" placeholder="Giờ kết thúc">
								<div class="input-group-append" data-target="#timepicker_afternoon_end" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="far fa-clock"></i></div>
								</div>
							</div>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Hủy bỏ</button>
                    <button type="submit" class="btn btn-success float-right"><i class="far fa-save"></i> Cập nhật</button>
                </div>
            </form>
        @endslot
    @endcomponent

    @component('admin.components.modals.edit-modal')
        @slot('title')
            Cập nhật giờ học 
        @endslot
        @slot('form')
            <form action="" id="update_hours" role="form" method="post">
                @csrf
                <input name="_method" type="hidden" value="PUT">
                <input type="hidden" name="start_date">
                <input type="hidden" name="end_date">
                <input type="hidden" name="current_date">
                <input type="hidden" name="lop_hoc_id">
                <input type="hidden" name="id">
                <div class="card-body" style="min-height:300px;">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Ca học sáng</label>

							<div class="input-group date" id="timepicker_moring_start" data-target-input="nearest">
								<input type="text" class="form-control datetimepicker-input" name="time_start_sang" id="update_time_sang_start" data-target="#timepicker_moring_start" placeholder="Giờ bắt đầu">
								<div class="input-group-append" data-target="#timepicker_moring_start" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="far fa-clock"></i></div>
								</div>
							</div>

							<div class="input-group date mt-3" id="timepicker_moring_end" data-target-input="nearest">
								<input type="text" class="form-control datetimepicker-input" name="time_end_sang" id="update_time_sang_end" data-target="#timepicker_moring_end" placeholder="Giờ kết thúc">
								<div class="input-group-append" data-target="#timepicker_moring_end" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="far fa-clock"></i></div>
								</div>
							</div>

                            <span class="text-danger ten" role="alert"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Ca học chiều</label>

							<div class="input-group date" id="timepicker_afternoon_start" data-target-input="nearest">
								<input type="text" class="form-control datetimepicker-input" name="time_start_chieu" id="update_time_chieu_start" data-target="#timepicker_afternoon_start" placeholder="Giờ bắt đầu">
								<div class="input-group-append" data-target="#timepicker_afternoon_start" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="far fa-clock"></i></div>
								</div>
							</div>

							<div class="input-group date mt-3" id="timepicker_afternoon_end" data-target-input="nearest">
								<input type="text" class="form-control datetimepicker-input" name="time_end_chieu" id="update_time_chieu_end" data-target="#timepicker_afternoon_end" placeholder="Giờ kết thúc">
								<div class="input-group-append" data-target="#timepicker_afternoon_end" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="far fa-clock"></i></div>
								</div>
							</div>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Hủy bỏ</button>
                    <button type="submit" class="btn btn-success float-right"><i class="far fa-save"></i> Cập nhật</button>
                </div>
            </form>
        @endslot
    @endcomponent

@endsection
@section('scripts')
<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
        let times = @json($times),
            data = @json($data),
            class_id = @json($id);
    	//Timepicker
		$('#timepicker_moring_start, #timepicker_moring_end, #timepicker_afternoon_start, #timepicker_afternoon_end').datetimepicker({
			format: 'HH:mm'
		});
		function renderCalendar(data, times) {
            console.log(times);

            let Calendar = FullCalendar.Calendar;
            let calendarEl = document.getElementById('calendar');

            let calendar = new Calendar(calendarEl, {
                selectable: true,
                plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                validRange: times,
                locale: 'vi',

                //Random default events
                eventRender: function(info) {
                   
                    var tooltip = new Tooltip(info.el, {
                        title: info.event.extendedProps.description,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                },
                select: function(info) {
                    // let now = moment().format('ddmmYYYY');
                    let start_time = moment(info.startStr).format('DD-MM-YYYY'),
                        end_time = moment(info.endStr).format('DD-MM-YYYY');

                    Swal.fire({
                        title: 'Bạn đã chọn từ  ' + start_time + ' đến ' + end_time,
                        type: 'warning',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                        }).then((result) => {
                        if (result.value) {
                            info.jsEvent.preventDefault(); // don't let the browser navigate
                            $('#modal-default').modal();
                            $('input[name="start_date"]').val(info.startStr);
                            $('input[name="end_date"]').val(info.endStr);
                            $('input[name="lop_hoc_id"]').val(class_id);
                            $('input[name="current_date"]').val("");
                            //thoi-khoa-bieu/id method (put)
                            //PUT|PATCH | thoi-khoa-bieu/{thoi_khoa_bieu}            | admin.thoi-khoa-bieu.update 
                        }
                    });
                      
                },
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    let start_time = moment(info.event.start).format('YYYY-MM-DD');
                    if(info.event.extendedProps.id_thoikhoabieu !== ""){
                        let update = $('.mess-data').data('url-update');
                        let url_update = update.replace('ID_REPLY_IN_URL', info.event.extendedProps.id_thoikhoabieu);
                        
                        $('#update_hours').attr('action', url_update);
                        let cahoc_sang = info.event.extendedProps.cahoc.ca_sang.replace("-","").split(" "),
                            cahoc_chieu = info.event.extendedProps.cahoc.ca_chieu.replace("-","").split(" ");
                        $('#update_time_sang_start').val(cahoc_sang[0]);
                        $('#update_time_sang_end').val(cahoc_sang[2]);
                        $('#update_time_chieu_start').val(cahoc_chieu[0]);
                        $('#update_time_chieu_end').val(cahoc_chieu[2]);
                        $('#modal-edit').modal();

                    } else{
                        $('#modal-default').modal();
                        $('input[name="current_date"]').val(start_time);
                        $('input[name="start_date"]').val("");
                        $('input[name="lop_hoc_id"]').val(class_id);
                        $('input[name="end_date"]').val("");
                    }
                   
                },
                events: data
            });

            calendar.render();
        };

        renderCalendar(data, times, class_id);

	</script>
    {{ Html::script(mix('admin/thoikhoabieu.js')) }}
@endsection