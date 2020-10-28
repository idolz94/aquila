@extends('admin.layouts.index')
<style>
    .fc-content{
        padding:5px;
        font-size:20px;
        color:#fff;
    }
    .fc-content .fc-title{
        display: block;
        overflow: auto;
        font-size: 14px;
        white-space: break-spaces;
    }
</style>
@section('content')
    <section class="content-header">
        <div class="container-fluid">
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('admin.thoi-khoa-bieu.lophoc') }}" id="create_monhoc" role="form" method="post">
                            @csrf
                            <label for="">Chọn lớp:</label>
                            <select name="id" class="form-control mb-2" id="select_class">
                                <option onclick="event.preventDefault();">Vui lòng chọn lớp học</option>
                                <option value="">Tất cả lớp học</option>
                                @foreach ($lophocs as $lophoc)
                                    @if(!isset($lophoc->active))
                                        <option value="{{$lophoc->id}}">{{$lophoc->ma_lop_hoc}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span class="mt-2 d-block font-11">Chọn lớp học để hiển thị môn học</span>
                        </form>
                    </div>
                </div>
                <!-- THE CALENDAR -->
                <div class="card card_dnone timeable d-none">
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div> 
            </div>
        </div>
  
    </section>

@endsection

<div class="mess-data"
data-url-index="{{ route('admin.thoi-khoa-bieu.lophoc') }}">
</div>
@section('scripts')
<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$(document).ready(function() {
             // submit form update
             let url_getAjax = $('#create_monhoc').attr('action'); 
             $('#select_class').on('change', function(){
                let class_id = $(this).val();

                $.ajax({
					url: url_getAjax,
					type: 'POST',
					data: {
                        id: class_id
                    },
					success: result => {
                        $('.timeable').removeClass('d-none');
                        renderCalendar(result.data, result.times,class_id);
					},
					error: data => {
						if (data.status == 422) {
							showMessErrForm(data.responseJSON.errors)
						}
					},
					// xhr: progressUpload,
				})
             });

		});
    	
		function renderCalendar(data, times,class_id) {
            let Calendar = FullCalendar.Calendar;
            let calendarEl = document.getElementById('calendar');
            calendarEl.innerHTML = '';
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
                events: data
            });

            calendar.render();
        };

	</script>
    {{ Html::script(mix('admin/thoikhoabieu.js')) }}
@endsection