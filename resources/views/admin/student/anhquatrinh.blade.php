@extends('admin.layouts.index')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-lg-12 mb-4">
                    <h1>Cập nhật ảnh quá trình học viên : {{$hocvien->ten}}</h1>
                </div>
                <div class="col-lg-12">
                    <a  href="{{ URL::previous() }}" class="btn btn-success"><i class="fas fa-undo"></i> Trở về</a>
                </div>
                <!-- ./col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card card-success card-outline">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('admin.hoc-vien.anhquatrinh.post')}}"  role="form" method="post" enctype="multipart/form-data">
                        @csrf    
                        <input type="hidden" name="id" value="{{$hocvien->id}}">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="card card-primary card-outline col-12">
                                    <div class="card-header">
                                      <h3 class="card-title"><i class="far fa-images"></i> Ảnh quá trình tại trung tâm <span class="text-danger">*</span></h3>
                                      <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                          <i class="fas fa-minus"></i></button>
                                      </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">     
                                      <div classs="row">
                                        <!-- ./ col   -->
                                        <div class="col-lg-8 d-inline-block">
                                          <div id="multipe_img" class="row">
                                          </div>
                                          <div class="form-group file-upload m-auto">
                                            <label class="input-file-trigger" for="multifileupload"><i class="fas fa-file-upload"></i> Tải ảnh ( Tối đa 5 ảnh) </label>
                                            <input type="file" multiple class="form-control input-file" id="multifileupload" placeholder="" name="images[]">
                                          </div>
                                        </div>
                                        <div class="col-lg-3 mt-4 d-inline-block ">
                                          <select name="images_type" id="" class="form-control">
                                              <option value="0">Xoá ảnh cũ và cập nhật</option>
                                              <option value="1">Giữ ảnh cũ và cập nhật</option>
                                          </select>
                                        </div>
                                  
                                      </div>
                                    </div>
                                    <!-- /.card-body -->
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
@section('scripts')
<script>
  // show one image
  

  // show array image
  let parent_e = document.getElementById('multipe_img');
  function readArrURL(input,parent_e) {
    if (input.files) {
      let ip_length = input.files.length;
      for(let i=0; i<input.files.length; i++){
        var reader = new FileReader();
        reader.onload = function (e) {
          let block_img = `
            <div class="col-lg-3">
              <img width="100%" src=${e.target.result}>
            </div>
          `;
          $(block_img).appendTo(parent_e);
        }
        reader.readAsDataURL(input.files[i]);
      };
    }
  }
  
  $("#multifileupload").change(function(){
    readArrURL(this,parent_e);
  });


</script>

  {{ Html::script(mix('admin/student.js')) }}
@endsection