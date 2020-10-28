@extends('admin.layouts.index')
<style>
    #hv_table tbody tr td{
        vertical-align:middle;
    }
</style>
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"> 
                    <h4>Thêm điểm cho học viên lớp : <strong>{{$lophoc->ma_lop_hoc}}</strong></h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"> Điểm </li>
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
            <form action="{{route('admin.lophoc.diem.store')}}"  role="form" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$lophoc->id}}">
                <input type="hidden" name="idMonHoc" value="{{$lophoc->id}}">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title flex-grow-1"><i class="fas fa-users"></i> Danh sách học viên</h3>
                        <div class="dt-buttons btn-group flex-wrap">
                            <select name="ly_do_id" id="" class="form-control select2_form">
                                @foreach ( $ly_dos as $ly_do )
                                    <option value="{{$ly_do->id}}">{{ $ly_do->ten }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="table_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <table id="hv_table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead class="text-center">
                                    <tr>
                                        <th width="5%">STT</th>
                                        <th>Mã học viên</th>
                                        <th>Ảnh học viên</th>
                                        <th>Học viên</th>
                                        <th width="10%">Điểm số</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center" data-count="{{ $count=1 }}">
                                    
                                    @foreach ( $hocviens as $hocvien )
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>{{ $hocvien->ma_hoc_vien }}</td>
                                            <td>
                                                @if( $hocvien->avatar_url !== NULL )
                                                    <img class="profile-user-img img-fluid img-circle" src="{{"/storage/uploads/user_avatar/icon128/".$hocvien->avatar_url}}" alt=""></td>
                                                @else 
                                                    <img class="profile-user-img img-fluid img-circle" src="/admin_assets/images/logo/logo-aq-h.png" alt=""></td>
                                                @endif
                                            </td>
                                            <td>{{ $hocvien->ten }}</td>
                                            <td> 
                                                <input type="text" name="diem[{{$hocvien->id}}]" value="" class="form-control">
                                            </td>
                                        </tr>
                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <button type="submit" class="btn btn-default mr-2"><i class="fas fa-times"></i> Huỷ bỏ</button>
                            <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Lưu thông tin</button>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</section>
@endsection

                                                