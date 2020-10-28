@extends('admin.layouts.index')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Thời khoá biểu</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Thời khoá biểu</li>
                    </ol>
                </div> 
                <div class="col-12 mt-2">
                  <a  href="{{route('admin.lophoc.index')}}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
  <section class="content pt-5">
    <div class="row">
      <div class="col-12">
      <div class="card card-primary">
          <div class="card-body p-0">
            <!-- THE CALENDAR -->
            <div id="calendar" data-id="{{$lophoc->id}}"></div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </section>
  <div class="mess-data"
    data-url-show="{{ route('admin.lophoc.tkb.list', 'ID_REPLY_IN_URL') }}">
  </div>
  @component('admin.components.modals.edit-modal')
        @slot('title')
            Cập nhật thời khoá biểu học viên
        @endslot
        @slot('form')
        <form action="" id="update_tkb" role="form" method="put" data-url-index="">
            @csrf
            <input type="hidden" value="" name="hoc_vien_id"> 
            <div class="card-body">
              <div class="row">
                  <div class="form-group col-md-6">
                      <label>Ca sáng</label>
                      <input type="text" class="form-control moring_learn" name="thoi_gian[]" placeholder="9:00 - 11:00">
                  </div>
                  <div class="form-group col-md-6">
                      <label>Ca chiều</label>
                      <input type="text" class="form-control afternoon_learn" name="thoi_gian[]" placeholder="14:00 - 16:00">
                  </div>
              </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Hủy bỏ</button>
                <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Lưu thông tin</button>
            </div>
        </form>
        @endslot
    @endcomponent
@endsection

@section('scripts')
  <script>
    $(function () {
      /* initialize the calendar
      -----------------------------------------------------------------*/
      let data = {!! json_encode($events) !!};
    
      function renderCalendar(data){
        let Calendar = FullCalendar.Calendar;
        let calendarEl = document.getElementById('calendar');
        let calendar = new Calendar(calendarEl, {
          plugins : [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
          header : {
            left  : 'prev,next today',
            center: 'title',
            right : 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          locale: 'vi',
          //Random default events
          
          eventSources: [
            {
              events : data
            }
          ],
        });

        calendar.render();
      };
      renderCalendar(data);
    });
  </script>
@endsection
