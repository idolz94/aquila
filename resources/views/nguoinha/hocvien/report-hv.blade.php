@extends('nguoinha.layouts.index')
@section('content')
<div class="content-header mb-4 bg-white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h5 class="m-0 text-dark">Gửi khiếu nại</h5>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Hồ sơ cá nhân</li>
                    <li class="breadcrumb-item active"><a href="#">Khiếu nại</a></li>
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
          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Form report học viên</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{ route('nguoibaoho.submitReport') }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label >Vấn đề khiếu nại</label>
                    <select class="form-control" name="category_report">
                      <option value="">Vui lòng chọn vấn đề khiếu nại</option>
                      @foreach (Config::get('admin.category_report') as $key => $category)
                        <option value="{{ $category['val'] }}">{{ $category['text'] }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nội dung</label>
                    <textarea name="content" id="report_content" class="form-control" rows="4" placeholder="Enter ..."></textarea>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Gửi khiếu nại</button>
                </div>
              </form>
          </div>
          <!-- .card -->
        </div>
        <!-- .col -->
      </div>
      <!-- /.row -->
    </div>
</section>
@endsection
@section('scripts')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
    
    </script>
@endsection