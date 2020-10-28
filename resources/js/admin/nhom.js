$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function() {
    var elementData = $('.mess-data');
    var urlDataTable = elementData.data('url-datatable');
    var urlEdit = elementData.data('url-edit');
    var urlDelete = elementData.data('url-delete');
    var urlHocVien = elementData.data('url-hocvien');
    var urlHocVienList = elementData.data('url-hocvien-list');
    var urlHocVienExport = elementData.data('url-hocvien-export');
    var dataAdmin = $('.mess-role').data('role-admin');
    $('#example2').DataTable({
        "ajax": urlDataTable,
        "language": {
            "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
        },
        "columns": [
            { "data": "id" },
            { "data": "ten" },
            { "data": "ten_truong_nhom" },
            { "data": "ngay_bat_dau" },
            { "data": "ghi_chu" },
            { "data": "ket_qua" },
            { "data": "nhom_cha" },
            { "data": null },
        ],
        "columnDefs": [{
                'targets': 0,
                'class': "text-center align-middle"
            }, {
                'targets': 1,
                'class': "text-center align-middle"
            },
            {
                'targets': 2,
                'class': "text-center align-middle"
            },
            {
                'targets': 3,
                'class': "text-center align-middle"
            },
            {
                'targets': 4,
                'class': "text-center align-middle"
            },
            {
                'targets': 5,
                'class': "text-center align-middle"
            },
            {
                'targets': 6,
                'class': "text-center align-middle"
            },
            {
                'targets': 7,
                'class': "text-center align-middle",
                'sortable': false
            }
        ],
        "paging": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "createdRow": function(row, data, index) {
            let editShow = urlEdit.replace('ID_REPLY_IN_URL', data.id);
            let hocvienShow = urlHocVien.replace('ID_REPLY_IN_URL', data.id);
            let hocvienListShow = urlHocVienList.replace('ID_REPLY_IN_URL', data.id);
            let hocvienListExport = urlHocVienExport.replace('ID_REPLY_IN_URL', data.id);
            if (dataAdmin == 1) {
                $('td', row).eq(7).empty().append(`
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown show">
                        <a class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" href="#" aria-expanded="true">
                            Tác vụ
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="${hocvienShow}" title="Cập nhật" class="dropdown-item">
                                <i class="fas fa-user-plus"></i> Thêm học viên
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="${editShow}" title="Cập nhật" class="dropdown-item">
                                <i class="fas fa-edit"></i> Cập nhật nhóm
                            </a>
                            <div class="dropdown-divider"></div>
                            <a type="submit" title="Xoá" class="dropdown-item delete-trigger" data-id="${data.id}">
                                <i class="fas fa-trash"></i> Xoá nhóm
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="${hocvienListShow}" title="Cập nhật" class="dropdown-item">
                                <i class="fas fa-users"></i> Chi tiết nhóm
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="${hocvienListExport}" title="Cập nhật" class="dropdown-item">
                                <i class="fas fa-file-export"></i> Xuất dữ liệu nhóm
                            </a>
                        </div>
                    </li>
                </ul>
            `);
            } else {
                $('td', row).eq(7).empty().append(`
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown show">
                            <a class="btn btn-info btn-block dropdown-toggle dropdown-icon" data-toggle="dropdown" href="#" aria-expanded="true">
                                Tác vụ
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <a href="${hocvienShow}" title="Cập nhật" class="dropdown-item">
                                    <i class="fas fa-user-plus"></i> Thêm học viên
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${editShow}" title="Cập nhật" class="dropdown-item">
                                    <i class="fas fa-edit"></i> Cập nhật nhóm
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${hocvienListShow}" title="Cập nhật" class="dropdown-item">
                                    <i class="fas fa-users"></i> Chi tiết nhóm
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="${hocvienListExport}" title="Cập nhật" class="dropdown-item">
                                    <i class="fas fa-file-export"></i> Xuất dữ liệu nhóm
                                </a>
                            </div>
                        </li>
                    </ul>
                `);
            }
        },
    });

    $('body').on('click', '.delete-trigger', function(event) {
        event.preventDefault();
        $('#modal-danger').modal('show', { backdrop: 'true' });
        let action = urlDelete.replace('ID_REPLY_IN_URL', $(this).data('id'));
        $('#delete-nhom-form').attr('action', action);
    })

    $('body').on('click', '#modal-danger .yes-confirm', e => {
        $('#delete-nhom-form').submit();
    })

    $('body').on('submit', '#create_nhom', function(e) {
        e.preventDefault();
        let urlIndex = $(this).data('url-index');
        let url = $(this).attr('action');
        let formData = new FormData()
        let formElement = $(this);
        formElement.find('input[name],select[name],textarea[name]').each(function(i, e) {
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
                window.location.href = urlIndex
            },
            error: data => {
                if (data.status == 422) {
                    console.log(data.responseJSON.errors)
                    showMessErrForm(data.responseJSON.errors)
                }
            },
            // xhr: progressUpload,
        })
    })
    $('#leader_group').select2();
    $('#parent_group').select2();

    function appendMes(messages, classEl) {
        let htmlCode = ''

        $.each(messages, (key1, val1) => {
            htmlCode += `<strong>${val1}</strong><br>`
        })

        $('.text-danger.' + classEl).html(htmlCode)
    }

    function showMessErrForm(errors) {
        $.each(errors, (key, val) => {
            switch (true) {
                case key == 'ten':
                    appendMes(val, 'ten')
                    break
                case key == 'ngay_bat_dau':
                    appendMes(val, 'ngay_bat_dau')
                    break
                case key == 'ngay_ket_thuc':
                    appendMes(val, 'ngay_ket_thuc')
                    break
                case key == 'nhom_cha_id':
                    appendMes(val, 'nhom_cha_id')
                    break
            }
        })
    }
});