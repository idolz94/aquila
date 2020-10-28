@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Cập nhật thông tin môn học </h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Môn học</li>
                    </ol>
                </div> 
                <div class="col-12 mt-2">
                    <a  href="{{ URL::previous() }}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('admin.monhoc.update',$monhoc->id)}}"  role="form" method="post">
                    @csrf
                    <input name="_method" type="hidden" value="PUT">
                    <div class="card card-success card-outline">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Tên môn học</label>
                                        <input type="text" name="mon_hoc" class="form-control" value="{{$monhoc->mon_hoc}}" placeholder="Tên môn học">
                                        <span class="text-danger mon_hoc" role="alert"></span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Thuộc bộ môn</label>
                                        <select name="bo_mon_id" id="" class="form-control">
                                            @foreach ($bomons as $item)
                                                <option value="{{$item->id}}"  {{ ( $item->id == $monhoc->bo_mon_id) ? 'selected' : '' }}>{{$item->ten_bo_mon}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger bo_mon_id" role="alert"></span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Loại hình môn học</label>
                                        <select name="loai_hinh" id="" class="form-control">
                                            <option value="0" {{ ( $monhoc->loai_hinh == 0) ? 'selected' : '' }}>Cố định</option>
                                            <option value="1"  {{ ( $monhoc->loai_hinh == 1) ? 'selected' : '' }}>Phát sinh</option>
                                        </select>
                                        <span class="text-danger ghi_chu" role="alert"></span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Thuộc giai đoạn</label>
                                        <select name="giai_doan" id="" class="form-control">
                                            <option value="0"  {{ ( $monhoc->giai_doan == 0) ? 'selected' : '' }}>0 - 3 Tháng</option>
                                            <option value="1"  {{ ( $monhoc->giai_doan == 1) ? 'selected' : '' }}>3 - 6 Tháng</option>
                                        </select>
                                        <span class="text-danger giai_doan" role="alert"></span>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nhận xét</label>
                                        <textarea name="nhan_xet" class="form-control" rows="4" placeholder="Enter ...">{{$monhoc->nhan_xet}} </textarea>
                                        <span class="text-danger nhan_xet" role="alert"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Ghi chú</label>
                                        <textarea name="ghi_chu" class="form-control" rows="4" placeholder="Enter ...">{{$monhoc->ghi_chu}} </textarea>
                                        <span class="text-danger ghi_chu" role="alert"></span>
                                    </div>          
                                </div> --}}

                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="{{ URL::previous() }}" class="btn btn-default mr-2"><i class="fas fa-times"></i> Huỷ bỏ</a>
                                <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Lưu thông tin</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection