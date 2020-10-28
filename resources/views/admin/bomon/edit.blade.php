@extends('admin.layouts.index')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-lg-12 mb-3">
                    <h1>Sửa Bộ Môn</h1>
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
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Block Buttons</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.bomon.update',$bomon->id)}}"  role="form" method="post">
                            @csrf
                            <input name="_method" type="hidden" value="PUT">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Tên bộ môn</label>
                                    <input type="text" name="ten_bo_mon" value="{{$bomon->ten_bo_mon}}" class="form-control" id="exampleInputEmail1" placeholder="Tên Bộ Môn">
                                    <span class="text-danger ten_bo_mon" role="alert"></span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
                                <button type="submit" class="btn btn-primary float-right">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
@endsection