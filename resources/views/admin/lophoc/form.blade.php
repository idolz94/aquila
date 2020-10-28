@extends('admin.layouts.index')
@section('content')

    <section class="content pt-5">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <a  href="{{ URL::previous() }}" class="btn btn-success"><i class="fas fa-undo"></i> Trở về</a>
            </div>
            <!-- col -->
            <div class="col-12">
                <form action="{{route('admin.lophoc.monhoc',$lophoc->id)}}"  role="form" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="far fa-edit"></i> Cập nhật thông tin lớp học {{$lophoc->ma_lop_hoc}}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <h4 for="">Danh Sách Môn Học</h4>
                                            <br>
                                            <select class="select2 select_mh" multiple="multiple" name="mon_hoc_id[]" data-placeholder="Chọn môn học" style="width: 100%;">
                                                @foreach ($monhocs as $item)
                                                    <option value="{{$item->id}}">{{$item->mon_hoc}}</option>
                                                @endforeach
                                            </select>
                                            <span class="font-11">Vui lòng chọn môn học</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./card-body -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-4 text-right">
                        <button type="submit" class="btn btn-default mr-2"><i class="fas fa-times"></i> Huỷ bỏ</button>
                        <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Lưu thông tin</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>

        $(function () {
            $('.select_mh').select2()
        });

    </script>
@endsection