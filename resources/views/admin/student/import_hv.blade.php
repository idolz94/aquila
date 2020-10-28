@extends('admin.layouts.index')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Nhập dữ liệu học viên</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Học viên</li>
                    </ol>
                </div>    
                   
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form  method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="custom-file">
                                            <input type="file" name="import" class="custom-file-input" id="importFile" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                                            <label class="custom-file-label" for="importFile">Chọn file nhập dữ liệu</label>
                                        </div>
                                        <span class="fileName p-2" style="display:none">Bạn đã chọn file: <strong></strong> </span>
                                        <button type="submit" class="btn btn-info mt-3 btn-import">
                                            <i class="fas fa-download mr-1"></i> Nhập dữ liệu học viên
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <table id="list_success" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%; display:none;">
                                        <thead>
                                            <tr>
                                                <th colspan="7" class="text-center">Danh sách học viên nhập thành công</th>
                                            </tr>
                                            <tr class="text-center">
                                                <th width="3%">STT</th>
                                                <th>Họ và tên</th>
                                                <th style="width: 120px;">Ngày sinh</th>
                                                <th>Số điện thoại</th>
                                                <th>Địa chỉ</th>
                                                <th>Ngày vào trung tâm</th>
                                                <th>Ma tuý sử dụng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>

                                    <table id="list_failed" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%; display:none;">
                                        <thead>
                                            <tr>
                                                <th colspan="7" class="text-center">Danh sách học viên nhập không thành công( Đã tồn tại trong danh sách )</th>
                                            </tr>
                                            <tr class="text-center">
                                                <th width="3%">STT</th>
                                                <th>Họ và tên</th>
                                                <th style="width: 120px;">Ngày sinh</th>
                                                <th>Số điện thoại</th>
                                                <th>Địa chỉ</th>
                                                <th>Ngày vào trung tâm</th>
                                                <th>Ma tuý sử dụng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div>                  
                </div>
            </div>
        </div>
        
    </section>
    <div class="data-mess" data-url-import="{{route('admin.hoc-vien.import')}}"></div> 
@endsection

@section('scripts')
    <script>
        $(function() {
            let json_object;
            $('#importFile').on('change',function(e){
                $('.fileName').css('display','block');
                $('.fileName strong').html($(this)[0].files[0].name);

                var selectedFile = e.target.files[0];
                fileRead(selectedFile);
            });
            function fileRead(selectedFile){
                var reader = new FileReader();
                reader.onload = function(event) {
                    var data = event.target.result;
                    var workbook = XLSX.read(data, {
                        type: 'binary'
                    });
                    workbook.SheetNames.forEach(function(sheetName) {
                    
                        var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                        json_object = JSON.stringify(XL_row_object);

                    });
                };

                reader.onerror = function(event) {
                    console.error("File could not be read! Code " + event.target.error.code);
                };

                reader.readAsBinaryString(selectedFile);
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.btn-import').on('click', function(e){
                e.preventDefault();
                let url = $('.data-mess').data('url-import');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        data:json_object,
                    },
                    success: result => {
                        if (result.length) {
                            importShow(result);
                        } else{
                            Swal.fire({
                                type: 'warning',
                                title: 'Vui lòng kiểm tra lại dữ liệu trong file nhập'
                            })
                        }
                    },
                    error: data => {
                        if ( data.status == 422 ) {
                            showMessErrForm(data.responseJSON.errors);
                        } else if( data.status = 500){
                            Swal.fire({
                                type: 'error',
                                title: 'Không thành công, vui lòng kiểm tra lại.'
                            })
                        }
                    },
                    // xhr: progressUpload,
                })
            });
            $(document).ajaxStart(function () {
                $('.btn-import').attr("disabled", true);
                $('.bg-load').show();

            });
            $(document).ajaxComplete(function () {
                $('.btn-import').attr("disabled", false);
                $('.bg-load').hide();
            });


            // render import

            function importShow(data){
                let list_failed = data.filter( function(el){
                    return el.success === 0;
                });
            
                let list_success = data.filter( function(el){
                    return el.success === 1;
                });
                
                let table_failed = $('#list_failed'),
                    table_success = $('#list_success');

                table_failed.hide();
                table_success.hide();
                if( list_failed.length > 0 ){
                    let arr_failed = ' ';
                    
                    table_failed.find('tbody').empty();
                    list_failed.forEach( function(element,i){
                        arr_failed += `<tr class="text-center">
                            <td>${i+1}</td>
                            <td>${element.ten}</td>
                            <td>${element.ngay_sinh}</td>
                            <td>${element.sdt}</td>
                            <td>${element.dia_chi}</td>
                            <td>${element.ngay_vao}</td>
                            <td>${element.ma_tuy_su_dung}</td>
                        </tr>`;
                    });
                    setTimeout(function(){
                        table_failed.find('tbody').append(arr_failed);
                        table_failed.show();
                    }, 1500);
                };
                if( list_success.length > 0 ){
                    let arr_success = ' ';
                    
                    table_failed.find('tbody').empty();
                    list_success.forEach( function(element,i){
                        arr_success += `<tr class="text-center">
                            <td>${i+1}</td>
                            <td>${element.ten}</td>
                            <td>${element.ngay_sinh}</td>
                            <td>${element.sdt}</td>
                            <td>${element.dia_chi}</td>
                            <td>${element.ngay_vao}</td>
                            <td>${element.ma_tuy_su_dung}</td>
                        </tr>`;
                    });
                    console.log(arr_success);
                    table_success.find('tbody').append(arr_success);
                    table_success.show();
                }


            };

        });
    </script>

@endsection
