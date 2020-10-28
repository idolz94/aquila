@extends('admin.layouts.index')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cập nhật tài chính - diễn giải</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Block Buttons</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.diengiai-taichinh.update',$data->id)}}" role="form" method="POST" data-url-index="{{ route('admin.diengiai-taichinh.index') }}">
                            @csrf
                            <input name="_method" type="hidden" value="PUT">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Diễn Giải</label>
                                    <input type="text" name="ten_dien_giai" value="{{$data->ten_dien_giai}}" class="form-control" id="exampleInputEmail1" placeholder="Tên Diễn Giải">
                                    <span class="text-danger ten_dien_giai" role="alert"></span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ URL::previous() }}" class="btn btn-default" data-dismiss="modal">Hủy bỏ</a>
                                <button type="submit" class="btn btn-primary float-right">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
@endsection
