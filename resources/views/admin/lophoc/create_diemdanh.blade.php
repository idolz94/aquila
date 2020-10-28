@extends('admin.layouts.index')
<style>
    .fc-content{
        padding:0px;
        font-size:18px;
    }
    .fc-more-cell>div {
        padding: 6px;
        background: #17a2b8 !important;
        border-radius: 3px;
    }
</style>
@section('content')
    <!-- Content Header (Page header) -->
   <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"> 
                    <h4>Điểm danh lớp: <strong>{{$lophoc->ma_lop_hoc}}</strong></h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Điểm danh</li>
                    </ol>
                </div> 
                <div class="col-12 mt-2">
                  <a  href="{{route('admin.lophoc.index')}}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div> 
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        let calendar_list = {!! json_encode($events) !!};
        console.log(calendar_list);
        let lophoc = {!! json_encode($lophoc) !!};
		function renderCalendar(calendar_list, lophoc) {
            let Calendar = FullCalendar.Calendar;
            let calendarEl = document.getElementById('calendar');

            let calendar = new Calendar(calendarEl, {
                plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                validRange: {
                    start: lophoc.ngay_bat_dau,
                    end: lophoc.ngay_ket_thuc
                },
                locale: 'vi',
                //Random default events
                eventClick: function(info) {
                    let start_time = moment(info.event.start).format('DD-MM-YYYY');
                    let hours = moment(info.event.start).format('HH');
                    // connsole.log(hours);
                    info.jsEvent.preventDefault();
                    Swal.fire({
                        title: `Bạn đã chọn điểm danh cho ngày : ${start_time}`,
                        type: 'success',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                        }).then((result) => {
                        if (result.value) {
                            info.jsEvent.preventDefault(); // don't let the browser navigate
                            if (info.event.url) {
                                window.open(info.event.url);
                            };  
                        }
                    });
                },
                dateClick: function(info) {
                    let start_time = moment(info.dateStr).format('DD-MM-YYYY');
                    info.jsEvent.preventDefault();
                    Swal.fire({
                        title: `Bạn đã chọn điểm danh cho ngày : ${start_time}`,
                        type: 'success',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                        }).then((result) => {
                        if (result.value) {
               
                            info.jsEvent.preventDefault(); // don't let the browser navigate
                            if (info.url) {
                                window.open(info.url);
                            };  
                        }
                    });
                },
                navLinks: true, 
			    editable: true,
                eventLimit: true,
                events: calendar_list
            });

            calendar.render();
        };
        renderCalendar(calendar_list, lophoc);
	</script>
@endsection
