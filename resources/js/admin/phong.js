$(function() {
    var elementData = $('.mess-data');
    var urlDataTable = elementData.data('url-datatable');
    var urlEdit = elementData.data('url-edit');
    var urlShow = elementData.data('url-show');
    var urlCreateHv = elementData.data('url-createhv');
    var urlExport = elementData.data('url-export');
    var urlTruongPhong = elementData.data('url-truongphong');
    var urlDelete = elementData.data('url-delete');
    var dataAdmin = $('.mess-role').data('role-admin');
    $('#student_room').DataTable({
        "ajax": urlDataTable,
        "language": {
            "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
        },
        "dt-responsive": true,
        "columns": [
            { "data": "id" },
            { "data": "ten_phong" },
            { "data": "vi_tri" },
            { "data": "ten" },
            { "data": null },
        ],
        'columnDefs': [{
                'targets': 0,
                'sortable': false,
                'class': "text-center align-middle"
            }, {
                'targets': 1,
                'sortable': false,
                'class': "text-center align-middle"
            },
            {
                'targets': 2,
                'sortable': false,
                'class': "text-center align-middle"
            },
            {
                'targets': 3,
                'sortable': false,
                'class': "text-center align-middle"
            },
            {
                'targets': 4,
                'sortable': false,
                'class': "text-center align-middle"
            }
        ],
        "paging": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "createdRow": function(row, data, index) {
            let editShow = urlShow.replace('ID_REPLY_IN_URL', data.id);
            let createHV = urlCreateHv.replace('ID_REPLY_IN_URL', data.id);
            let linkExport = urlExport.replace('ID_REPLY_IN_URL', data.id);
            let createTruongPhong = urlTruongPhong.replace('ID_REPLY_IN_URL', data.id);
            if (dataAdmin == 1) {
                $('td', row).eq(4).empty().append(`
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown show">
                        <a class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" href="#" aria-expanded="true">
                            Tác vụ
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="#" title="Cập nhật" class="dropdown-item update_room" data-id="${data.id}" data-name="${data.ten_phong}" data-loction="${data.vi_tri}" data-leader-name="${data.ten}">
                                <i class="fas fa-edit"></i> Cập nhật
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="${createHV}" title="Thêm mới học viên" class="dropdown-item">
                                <i class="fas fa-user-plus"></i> Thêm mới học viên
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="${editShow}" title="Danh sách học viên" class="dropdown-item">
                                <i class="fas fa-info-circle"></i> Danh sách học viên
                            </a> 
                            <div class="dropdown-divider"></div>
                            <a href="${createTruongPhong}" title="Danh sách học viên" class="dropdown-item">
                                <i class="fas fa-user-edit"></i> Thay trưởng phòng
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="${linkExport}" title="Danh sách học viên" class="dropdown-item">
                                <i class="fas fa-file-excel"></i> Xuất file Excel
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
                $('td', row).eq(4).empty().append(`
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown show">
                        <a class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" href="#" aria-expanded="true">
                            Tác vụ
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            <a href="#" title="Cập nhật" class="dropdown-item update_room" data-id="${data.id}" data-name="${data.ten_phong}" data-loction="${data.vi_tri}" data-leader-name="${data.ten}">
                                <i class="fas fa-edit"></i> Cập nhật
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="${createHV}" title="Thêm mới học viên" class="dropdown-item">
                                <i class="fas fa-user-plus"></i> Thêm mới học viên
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="${editShow}" title="Danh sách học viên" class="dropdown-item">
                                <i class="fas fa-info-circle"></i> Danh sách học viên
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="${createTruongPhong}" title="Danh sách học viên" class="dropdown-item">
                                <i class="fas fa-user-edit"></i> Thay trưởng phòng
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
        $('#delete-phong-form').attr('action', action);
    });
    // confirm del
    $('body').on('click', '#modal-danger .yes-confirm', e => {
        $('#delete-phong-form').submit();
    });
    // update room
    $('body').on('click', '.update_room', function(event) {
        event.preventDefault();
        $('#modal-edit').modal('show', { backdrop: 'true' });
        let name_room = $(this).data('name'),
            location = $(this).data('loction'),
            leader_name = $(this).data('leader-name');
        let random = Math.random().toString(36).substring(2) + (new Date()).getTime().toString();
        let random_string = `${random}_${ $(this).data('id') }`;
        url_group_edit = urlEdit.replace('ID_REPLY_IN_URL', random_string);

        $('#update_room').attr('action', url_group_edit);
        $('input[name="ten_phong"]').attr('value', name_room);
        $('input[name="vi_tri"]').attr('value', location);
        $('#update_room').attr('data-id', $(this).data('id'));
        let all_leader = $('select[name="ten_truong_phong"]');
        $('select[name="ten_truong_phong"]').select2();

    });

    $('body').on('submit', '#update_room', function(e) {
        e.preventDefault();
        console.log(url_group_edit);
        let urlIndex = $(this).data('url-index');
        let formData = new FormData()
        let formElement = $(this);
        formElement.find('input[name]').each(function(i, e) {
            if (Array.isArray($(e).val())) {
                $(e).val().forEach(function(v) {
                    formData.append($(e).attr('name'), v);
                })
            } else {
                formData.append($(e).attr('name'), $(e).val());
            }

        });

        $.ajax({
            url: url_group_edit,
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: data => {
                console.log(data)
                window.location.href = urlIndex;
            },
            error: data => {
                let htmlCode = `<strong>Tên Phòng đã có, mời nhập tên khác</strong><br>`
                $('.text-danger.ten_phong').html(htmlCode)
            },
            // xhr: progressUpload,
        })
    })


    // create room
    $('body').on('submit', '#create_phong', function(e) {
        e.preventDefault();
        let formData = new FormData();
        let url_index = $('#create_phong').data('url-index');
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
                if (data) {
                    window.location.href = url_index;
                }
            },
            error: data => {
                console.log(data.responseJSON.errors)
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
                case key == 'ten_phong':
                    appendMes(val, 'ten_phong')
                    break
                case key == 'ten_truong_phong':
                    appendMes(val, 'ten_truong_phong')
                    break
                case key == 'vi_tri':
                    appendMes(val, 'vi_tri')
                    break
            }
        })
    }

    $('#leader_group').select2();
});