$(function() {
    var elementData = $('.mess-data');
    var urlDataTable = elementData.data('url-datatable');
    var urlEdit = elementData.data('url-edit');
    var urlShow = elementData.data('url-show');
    var urlCreateHv = elementData.data('url-createhv');
    var urlHocVienList = elementData.data('url-hocvien-list');
    var urlDelete = elementData.data('url-delete');
    var dataAdmin = $('.mess-role').data('role-admin');
    $('#example2').DataTable({
        "ajax": urlDataTable,
        "language": {
            "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
        },
        "dt-responsive": true,
        "columns": [
            { "data": "id" },
            { "data": "ten" },
            { "data": "ngay_bat_dau" },
            { "data": "ngay_ket_thuc" },
            { "data": null },
        ],
        'columnDefs': [{
                'targets': 0,
                'sortable': false,
                'class': 'text-center align-middle'
            }, {
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
            }

        ],
        "paging": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
        "createdRow": function(row, data, index) {
            let editShow = urlShow.replace('ID_REPLY_IN_URL', data.id);
            let createHV = urlCreateHv.replace('ID_REPLY_IN_URL', data.id);
            let hocvienListShow = urlHocVienList.replace('ID_REPLY_IN_URL', data.id);
            if (dataAdmin == 1) {
                $('td', row).eq(4).empty().append(`
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown show">
                        <a class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" href="#" aria-expanded="true">
                            Tác vụ
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a type="submit" title="Xoá" class="dropdown-item delete-trigger" data-id="${data.id}">
                                <i class="fas fa-trash"></i> Xoá hướng nghiệp
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" title="Cập nhật" class="dropdown-item update_room" data-id="${data.id}" data-name="${data.ten}" data-date-start="${data.ngay_bat_dau}" data-date-end="${data.ngay_ket_thuc}">
                                <i class="fas fa-edit"></i> Cập nhật hướng nghiệp
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="${createHV}" title="Thêm mới học viên" class="dropdown-item">
                                <i class="fas fa-user-plus"></i> Thêm học viên
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="${hocvienListShow}" title="Cập nhật" class="dropdown-item">
                                 <i class="fas fa-users"></i> Danh sách học viên
                            </a>
                        </div>
                    </li>
                </ul>
                `);
            } else {
                $('td', row).eq(4).empty().append(`
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown show">
                        <a class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" href="#" aria-expanded="true">
                            Tác vụ
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            <a href="#" title="Cập nhật" class="dropdown-item update_room" data-id="${data.id}" data-name="${data.ten}" data-date-start="${data.ngay_bat_dau}" data-date-end="${data.ngay_ket_thuc}">
                                <i class="fas fa-edit"></i> Cập nhật hướng nghiệp
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="${createHV}" title="Thêm mới học viên" class="dropdown-item">
                                <i class="fas fa-user-plus"></i> Thêm học viên
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="${hocvienListShow}" title="Cập nhật" class="dropdown-item">
                                 <i class="fas fa-users"></i> Danh sách học viên
                            </a>
                        </div>
                    </li>
                </ul>
                `);
            }
        },
    });

    function redirectUrl() {
        console.log('das');
    }
    $('.item_click').on('click', function() {
        console.log('da');
    });
    // submit del
    $('body').on('click', '.delete-trigger', function(event) {
        event.preventDefault();
        $('#modal-danger').modal('show', { backdrop: 'true' });
        let action = urlDelete.replace('ID_REPLY_IN_URL', $(this).data('id'));
        $('#delete-huongnghiep-form').attr('action', action);
    });
    // confirm del
    $('body').on('click', '#modal-danger .yes-confirm', e => {
        $('#delete-huongnghiep-form').submit();
    });
    // update room
    $('body').on('click', '.update_room', function(event) {
        event.preventDefault();
        $('#modal-edit').modal('show', { backdrop: 'true' });
        let name_room = $(this).data('name'),
            location = $(this).data('loction'),
            leader_name = $(this).data('leader-name');
        start_date = $(this).data('date-start');
        end_date = $(this).data('date-end');
        url_group_edit = urlEdit.replace('ID_REPLY_IN_URL', $(this).data('id'));
        $('input[name="ten"]').attr('value', name_room);
        $('input[name="vi_tri"]').attr('value', location);
        $('#update_room').attr('data-id', $(this).data('id'));
        $('#update_room input[name="ngay_bat_dau"]').attr('value', moment(start_date).format("YYYY-MM-DD"));
        $('#update_room input[name="ngay_ket_thuc"]').attr('value', moment(end_date).format("YYYY-MM-DD"));
        let all_leader = $('select[name="ten_truong_phong"]');
        $('select[name="ten_truong_phong"]').select2();
        $('#update_room').attr('action', url_group_edit);


    });
    // create room
    $('body').on('submit', '#create_huongnghiep', function(e) {
        e.preventDefault();
        let formData = new FormData();
        let url_index = $('#create_huongnghiep').data('url-index');
        let url = $(this).attr('action');
        let formElement = $(this);
        formElement.find('input[name],select[name]').each(function(i, e) {
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
                console.log(data);
                if (data) {
                    window.location.href = url_index;
                }
            },
            error: data => {
                if (data.status == 422) {
                    showMessErrForm(data.responseJSON.errors);
                }
            },
            // xhr: progressUpload,
        })
    })

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
            }
        })
    }

    $('#leader_group').select2();
});