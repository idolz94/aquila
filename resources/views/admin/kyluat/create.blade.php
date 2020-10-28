@extends('admin.layouts.index')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 mb-3">
                    <h1>Đánh giá kỷ luật học viên : {{$hocvien->ten}}</h1>
                </div>
                <div class="col-lg-12">
                    <a  href="{{ URL::previous() }}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
                <!-- ./col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fab fa-buromobelexperte"></i> Kỷ luật</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('admin.kyluat.store')}}"  role="form" method="post">
                        @csrf    
                        <input type="hidden" value="{{$hocvien->id}}" name="hoc_vien_id"> 
                        <div class="card-body">
                            <div class="form-group">
                                <label>Ghi chú</label>
                                <input type="text" name="ghi_chu" class="form-control" placeholder="Ghi chú">
                            </div>
                            <div class="form-group">
                                <label>Lý do</label>
                                <input type="text" name="ly_do" class="form-control" placeholder="Lý Co">
                            </div>
                        </div>
                        <div class="col-lg-12 mb-4 text-right">
                            <a href="{{ URL::previous() }}" class="btn btn-default mr-2" ><i class="fas fa-times"></i> Hủy bỏ</a>
                            <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Lưu thông tin</button>
                        </div>
                        </form> 
                    </div>
                    <!-- /.card-body -->
                </div>            
            </div>
        </div>
    </section>
@endsection