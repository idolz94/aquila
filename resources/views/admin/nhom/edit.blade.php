@extends('admin.layouts.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cập nhật thông tin nhóm</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Nhóm</li>
                    </ol>
                </div> 
                <div class="col-12 mt-3">
                    <a  href="{{ URL::previous() }}" class="btn btn-default"><i class="fas fa-undo"></i> Trở về</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fab fa-buromobelexperte mr-1"></i>{{$nhom->ten}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ route('admin.nhom.update',$nhom->id)}}"  role="form" method="post">
                        <div class="card-body">
                            @csrf    
                            <input name="_method" type="hidden" value="PUT"> 
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Tên nhóm</label>
                                    <input type="text" name="ten" value="{{$nhom->ten}}" class="form-control" id="ten" placeholder="Tên nhóm">
                                    <span class="text-danger ten" role="alert"></span>
                                </div>
                                <div class="form-group col-md-4 d-flex flex-column">
                                    <label>Trưởng nhóm</label>
                                    <select name="truong_nhom_id"  class="form-control" id="leader_group">
                                        @foreach ($hocviens as $item)
                                            <option value="{{$item->id}}" {{$item->id == $nhom->truong_nhom_id ? "selected":""}}>{{$item->ten}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger ten_truong_nhom" role="alert"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Thuộc nhóm cha</label>
                                    <select name="nhom_cha_id" id="" class="form-control">
                                        @foreach ($nhomCha as $item)
                                            <option value="{{$item->id}}"  {{$item->id == $nhom->nhom_cha_id ? "selected":""}}>{{$item->ten}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger nhom_nao" role="alert"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Thời gian bắt đầu:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="date" name="ngay_bat_dau" value="{{$nhom->ngay_bat_dau}}"  class="form-control float-right" id="reservation">
                                    </div>
                                    <span class="text-danger ngay_bat_dau" role="alert"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Thời gian kết thúc:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="date" name="ngay_ket_thuc" value="{{$nhom->ngay_ket_thuc}}" class="form-control float-right" id="reservation">
                                    </div>
                                    <span class="text-danger ngay_ket_thuc" role="alert"></span>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Ghi chú</label>
                                    <textarea rows="3" name="ghi_chu" class="form-control" id="ten" placeholder="Ghi chú ...">{{$nhom->ghi_chu}}</textarea>
                                    <span class="text-danger ghi_chu" role="alert"></span>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="col-lg-12 mb-4 text-right">
                            <a href="{{ URL::previous() }}" class="btn btn-default mr-2" ><i class="fas fa-times"></i> Hủy bỏ</a>
                            <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Lưu thông tin</button>
                        </div>
                    </form>
                </div>            
            </div>
        </div>
    </section>
@endsection