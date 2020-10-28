$(function() {
    var dataAdmin = $('.mess-role').data('role-admin')
    let elementData = $('.mess-data'),
        urlDataTable = elementData.data('url-datatable'),
        urlUpdate = elementData.data('url-update'),
        urlCreateHocVien = elementData.data('url-create_hocvien'),
        urlShow = elementData.data('url-show'),
        urllistTKB = elementData.data('url-listtkb'),
        urlDelete = elementData.data('url-delete'),
        urlFilter = elementData.data('url-filter'),
        urlDiem = elementData.data('url-diem'),
        urlExport = elementData.data('url-export'),
        urlDiemDanh = elementData.data('url-diemdanh'),
        urlImages = elementData.data('url-images'),
        dataTable = $('#table_lh').DataTable({
            "ajax": urlDataTable,
            "language": {
                "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
            },
            "columns": [
                { "data": "id" },
                { "data": "ma_lop_hoc" },
                { "data": "mon_hoc_id" },
                { "data": "giaovien.ten" },
                { "data": "ngay_bat_dau" },
                { "data": "ngay_ket_thuc" },
                { "data": null },
            ],
            'columnDefs': [{
                    'targets': 0,
                    'sortable': false,
                    'class': 'text-center align-middle'
                },
                {
                    'targets': 1,
                    'sortable': false,
                    'class': 'text-center align-middle'

                },
                {
                    'targets': 2,
                    'sortable': false,
                    'class': 'text-center align-middle'
                },
                {
                    'targets': 3,
                    'sortable': false,
                    'class': 'text-center align-middle'
                },
                {
                    'targets': 4,
                    'sortable': false,
                    'class': 'text-center align-middle'
                },
                {
                    'targets': 5,
                    'sortable': false,
                    'class': 'text-center align-middle'
                }
            ],
            "paging": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
            "createdRow": function(row, data, index) {
                let showLink = urlShow.replace('ID_REPLY_IN_URL', data.id),
                    listTkbLink = urllistTKB.replace('ID_REPLY_IN_URL', data.id),
                    addHocVienLink = urlCreateHocVien.replace('ID_REPLY_IN_URL', data.id);
                linkExport = urlExport.replace('ID_REPLY_IN_URL', data.id);
                diemLink = urlDiem.replace('ID_REPLY_IN_URL', data.id);
                diemdanhLink = urlDiemDanh.replace('ID_REPLY_IN_URL', data.id);
                imagesLink = urlImages.replace('ID_REPLY_IN_URL', data.id);
                console.log(imagesLink)
                if (dataAdmin == 1) {
                    $('td', row).eq(6).empty().append(`
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown show">
                            <a class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" href="#" aria-expanded="true">
                                Tác vụ
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <a href="" title="Cập nhật" 
                                    class="dropdown-item update_class" 
                                    data-id="${data.id}" 
                                    data-name="${data.ma_lop_hoc}"
                                    data-start-date="${data.ngay_bat_dau}"
                                    data-end-date="${data.ngay_ket_thuc}"
                                    data-ghichu="${data.ghi_chu}"
                                >
                                    <i class="fas fa-edit"></i> Cập nhật
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${addHocVienLink}"  title="Thêm học viên vào lớp"  class="dropdown-item">
                                <i class="fas fa-user-plus"></i> Thêm học viên vào lớp
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${listTkbLink}" class="dropdown-item" title="Thời khóa biểu">
                                    <i class="fab fa-buromobelexperte"></i> Thêm thời khóa biểu
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${showLink}" class="dropdown-item" title="Danh sách môn học" >
                                    <i class="fas fa-list"></i> Danh sách học viên
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${diemLink}" class="dropdown-item" title="Danh sách môn học" >
                                    <i class="fas fa-plus"></i> Thêm điểm học viên
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${diemdanhLink}" class="dropdown-item" title="Danh sách môn học" >
                                    <i class="fas fa-plus"></i> Điểm danh học viên
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${linkExport}" title="Cập nhật" class="dropdown-item">
                                    <i class="fas fa-file-export"></i> Xuất dữ liệu lớp
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${imagesLink}" class="dropdown-item" title="Thêm ảnh lớp học" >
                                    <i class="fas fa-plus"></i> Thêm ảnh lớp học
                                </a>
                                <div class="dropdown-divider"></div>
                                <a type="submit" title="Xoá" class="dropdown-item delete-trigger" data-id="${data.id}">
                                    <i class="fas fa-trash"></i> Xoá
                                </a>
                            </div>
                        </li>
                    </ul>
                `);
                } else {
                    $('td', row).eq(6).empty().append(`
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown show">
                            <a class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" href="#" aria-expanded="true">
                                Tác vụ
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <a href="" title="Cập nhật" 
                                    class="dropdown-item update_class" 
                                    data-id="${data.id}" 
                                    data-name="${data.ma_lop_hoc}"
                                    data-start-date="${data.ngay_bat_dau}"
                                    data-end-date="${data.ngay_ket_thuc}"
                                    data-ghichu="${data.ghi_chu}"
                                >
                                    <i class="fas fa-edit"></i> Cập nhật
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${addHocVienLink}"  title="Thêm học viên vào lớp"  class="dropdown-item">
                                <i class="fas fa-user-plus"></i> Thêm học viên vào lớp
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${listTkbLink}" class="dropdown-item" title="Thời khóa biểu">
                                    <i class="fab fa-buromobelexperte"></i> Thời khóa biểu
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${showLink}" class="dropdown-item" title="Danh sách môn học" >
                                    <i class="fas fa-list"></i> Danh sách học viên
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${diemLink}" class="dropdown-item" title="Danh sách môn học" >
                                    <i class="fas fa-plus"></i> Thêm điểm học viên
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${diemdanhLink}" class="dropdown-item" title="Danh sách môn học" >
                                    <i class="fas fa-plus"></i> Điểm danh học viên
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${imagesLink}" class="dropdown-item" title="Thêm ảnh lớp học" >
                                    <i class="fas fa-plus"></i> Thêm ảnh lớp học
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${linkExport}" title="Cập nhật" class="dropdown-item">
                                    <i class="fas fa-file-export"></i> Xuất dữ liệu lớp
                                </a>
                            </div>
                        </li>
                    </ul>
                `);
                }
            },
        });

    dataTable.on('order.dt search.dt', function() {
        dataTable.column(0, { search: 'applied', order: 'applied' }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

    $('body').on('click', '.delete-trigger', function(event) {
        event.preventDefault();
        $('#modal-danger').modal('show', { backdrop: 'true' });
        let action = urlDelete.replace('ID_REPLY_IN_URL', $(this).data('id'));
        $('#delete-lophoc-form').attr('action', action);
    });

    $('body').on('click', '#modal-danger .yes-confirm', e => {
        $('#delete-lophoc-form').submit();
    });

    /* Create class */
    $('body').on('submit', '#create_lophoc', function(e) {
        e.preventDefault();
        let urlIndex = $(this).data('url-index'),
            url = $(this).attr('action'),
            formData = new FormData(),
            formElement = $(this);
        formElement.find('input[name], textarea[name],select[name]').each(function(i, e) {
            if (Array.isArray($(e).val())) {
                $(e).val().forEach(function(v) {
                    formData.append($(e).attr('name'), v);
                })
            } else {
                formData.append($(e).attr('name'), $(e).val());
            }
        });
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: data => {
                Swal.fire({
                    type: 'success',
                    title: 'Đã thêm thành công!',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = urlIndex;
                    }
                });
            },
            error: data => {
                if (data.status == 422) {
                    showMessErrForm(data.responseJSON.errors)
                }
            },
            // xhr: progressUpload,
        });
    });
    /* Update class */
    $('body').on('click', '.update_class', function(event) {
        event.preventDefault();
        $('#modal-edit').modal('show', { backdrop: 'true' });
        let action = urlUpdate.replace('ID_REPLY_IN_URL', $(this).data('id')),
            start_date = moment($(this).data('start-date'), 'DD-MM-YYYY'),
            end_date = moment($(this).data('end-date'), 'DD-MM-YYYY');
        $('#update_lophoc').attr('action', action);
        $('#update_lophoc input[name="ma_lop_hoc"]').attr('value', $(this).data('name'));
        $('#update_lophoc input[name="ngay_bat_dau"]').attr('value', moment(start_date).format("YYYY-MM-DD"));
        $('#update_lophoc input[name="ngay_ket_thuc"]').attr('value', moment(end_date).format("YYYY-MM-DD"));
    });

    $('body').on('submit', '#update_lophoc', function(e) {
        e.preventDefault();
        let urlIndex = $(this).data('url-index');
        let action = $('#update_lophoc').attr('action');
        console.log(action);
        let formData = new FormData()
        let formElement = $(this);

        formElement.find('input[name], textarea[name],select[name]')
            .each(function(i, e) {
                if (Array.isArray($(e).val())) {
                    $(e).val().forEach(function(v) {
                        formData.append($(e).attr('name'), v);
                    })
                } else {
                    formData.append($(e).attr('name'), $(e).val());
                }
            });

        console.log(formElement);

        $.ajax({
            url: action,
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: data => {
                window.location.href = urlIndex;
            },
            error: data => {
                let htmlCode = `<strong>Mã lớp học đã có, mời nhập tên khác</strong><br>`;
                $('.text-danger.ma_lop_hoc').html(htmlCode);
            },
            // xhr: progressUpload,
        })

    });


    $('.close').on('click', function() {
        $('.text-danger.ma_lop_hoc').html('');
    })

    function appendMes(messages, classEl) {
        let htmlCode = '';
        $.each(messages, (key1, val1) => {
            htmlCode += `<strong>${val1}</strong><br>`
        })

        $('.text-danger.' + classEl).html(htmlCode)
    };

    function showMessErrForm(errors) {
        $.each(errors, (key, val) => {
            switch (true) {
                case key == 'ma_lop_hoc':
                    appendMes(val, 'ma_lop_hoc')
                    break
                case key == 'ngay_bat_dau':
                    appendMes(val, 'ngay_bat_dau')
                    break
                case key == 'ngay_ket_thuc':
                    appendMes(val, 'ngay_ket_thuc')
                    break
                case key == 'mon_hoc_id':
                    appendMes(val, 'mon_hoc_id')
                    break
            }
        })
    };

    /* filter */
    $('#filter_status').on('change', function() {
        let status = $(this).val();
        $.ajax({
            url: urlFilter,
            type: 'POST',
            data: {
                ngay_bat_dau: status,
            },
            beforeSend: function() {
                $('.lds-ellipsis').show();
            },
            complete: function() {
                $('.lds-ellipsis').hide();
            },
            success: function(result) {
                if (result.length > 0) {
                    filterClass(result);
                    $('#table_filter').removeClass('d-none');
                    $('#table_wrapper').addClass('d-none');
                    $('#table_filter').addClass('d-block');
                } else {
                    Swal.fire({
                        type: 'warning',
                        title: 'Hiện tại không có lớp học nào !'
                    })
                }
            },
            error: function(xhr, thrownError) {
                if (xhr.status == 500) {
                    $('.card-error').removeClass('d-none');
                    $('.card-success-data').addClass('d-none');
                }
                console.log(thrownError);
            }
        });
    });

    function filterClass(dataset) {
        let tbody = $('.filter_show');
        let arr_lh = '';
        console.log(dataset);
        if (tbody.empty()) {
            dataset.forEach(element => {
                arr_lh += `<tr>
                <td></td>
                <td>${element.ma_lop_hoc}</td>
                <td>${element.mon_hoc_id}</td>
                <td>${element.giao_vien_id}</td>
                <td>${element.ngay_bat_dau}</td>
                <td>${element.ngay_ket_thuc}</td>
                <td>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown show">
                            <a class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" href="#" aria-expanded="true">
                                Tác vụ
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <a type="submit" title="Xoá" class="dropdown-item delete-trigger" data-id="${element.id}">
                                    <i class="fas fa-trash"></i> Xoá lớp học
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="" title="Cập nhật" 
                                    class="dropdown-item update_class" 
                                    data-id="${element.id}" 
                                    data-name="${element.ma_lop_hoc}"
                                    data-start-date="${element.ngay_bat_dau}"
                                    data-end-date="${element.ngay_ket_thuc}"
                                    data-ghichu="${element.ghi_chu}"
                                >
                                    <i class="fas fa-edit"></i> Cập nhật thông tin
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${ urlCreateHocVien.replace('ID_REPLY_IN_URL', element.id) }"  title="Thêm học viên vào lớp"  class="dropdown-item">
                                    <i class="fas fa-user-plus"></i> Thêm học viên vào lớp
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${ urllistTKB.replace('ID_REPLY_IN_URL', element.id) }" class="dropdown-item" title="Thời khóa biểu">
                                    <i class="fab fa-buromobelexperte"></i> Thời khóa biểu
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${ urlShow.replace('ID_REPLY_IN_URL', element.id) }" class="dropdown-item" title="Danh sách học viên" >
                                    <i class="fas fa-users"></i> Danh sách học viên 
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${diemLink}" class="dropdown-item" title="Danh sách môn học" >
                                    <i class="fas fa-plus"></i> Thêm điểm học viên
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${diemdanhLink}" class="dropdown-item" title="Danh sách môn học" >
                                    <i class="fas fa-plus"></i> Điểm danh học viên
                                </a>
                            </div>
                        </li>
                    </ul>
                </td>
             </tr>`;
            });
            tbody.append(arr_lh);
        };
    };
    //Initialize Select2 Elements
    $('#monhoc_select2').select2();

});