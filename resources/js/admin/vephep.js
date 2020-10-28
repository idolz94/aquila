$(function() {
    let elementData = $('.mess-data');
    let urlDataTable = elementData.data('url-datatable');
    let urlEdit = elementData.data('url-edit');
    let urlDelete = elementData.data('url-delete');
    let url_group_edit = elementData.data('url-update');
    var dataAdmin = $('.mess-role').data('role-admin');
    $('#example2').DataTable({
        "ajax": urlDataTable,
        "language": {
            "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
        },
        "columns": [
            { "data": "id" },
            { "data": "ngay_ve" },
            { "data": "ngay_vao" },
            { "data": "ly_do", render: function(dataField) { return dataField == 0 ? 'Xin Về' : "Trốn" } },
            { "data": "tinh_trang" },
            { "data": "ghi_chu" },

            { "data": null },
        ],
        "paging": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "createdRow": function(row, data, index) {
            let editShow = urlEdit.replace('ID_REPLY_IN_URL', data.id);
            if (dataAdmin == 1) {
                $('td', row).eq(6).empty().append(`
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown show">
                            <a class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" href="#" aria-expanded="true">
                                Tác vụ
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <div class="dropdown-divider"></div>
                                <a type="submit" title="Xoá" class="dropdown-item update-vp" data-id="${data.id}" data-date="${data.ngay_ve}" data-date-end="${data.ngay_vao}" data-tinh-trang="${data.tinh_trang}" data-ghi-chu="${data.ghi_chu}">
                                    <i class="fas fa-trash"></i> Cập nhật về phép
                                </a>
                                <div class="dropdown-divider"></div>
                                <a type="submit" title="Xoá" class="dropdown-item delete-trigger" data-id="${data.id}">
                                    <i class="fas fa-trash"></i> Xoá về phép
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
                            <div class="dropdown-divider"></div>
                            <a type="submit" title="Xoá" class="dropdown-item update-vp" data-id="${data.id}" data-date="${data.ngay_ve}" data-date-end="${data.ngay_vao}" data-tinh-trang="${data.tinh_trang}" data-ghi-chu="${data.ghi_chu}">
                                <i class="fas fa-trash"></i> Cập nhật về phép
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
        $('#delete-ve-phep-form').attr('action', action);
    });

    $('body').on('click', '#modal-danger .yes-confirm', e => {
        $('#delete-ve-phep-form').submit();
    });

    $('body').on('click', '.update-vp', function(event) {
        event.preventDefault();
        $('#modal-edit').modal('show', { backdrop: 'true' });
        let id_vp = $(this).data('id');
        let start_date = $(this).data('date');
        let end_date = $(this).data('date-end');
        let tinh_trang = $(this).data('tinh-trang');
        let ghi_chu = $(this).data('ghi-chu');
        url_group_edit = urlEdit.replace('ID_REPLY_IN_URL', id_vp);
        $('#update_vephep input[name="ngay_vao"]').attr('value', moment(end_date).format("YYYY-MM-DD"));
        $('#update_vephep input[name="ngay_ve"]').attr('value', moment(start_date).format("YYYY-MM-DD"));
        $('#update_vephep input[name="tinh_trang"]').attr('value', tinh_trang);
        $('#update_vephep textarea[name="ghi_chu"]').val(ghi_chu);
        $('#update_vephep').attr('action', url_group_edit);
    });
    // submit form update
    $('body').on('submit', '#update_vephep', function(e) {
        e.preventDefault();
        console.log(url_group_edit);
        let urlIndex = $(this).data('url-index');
        let formData = new FormData()
        let formElement = $(this);
        formElement.find('input[name],select[name],textarea[name').each(function(i, e) {
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
                window.location.href = urlIndex
            },
            error: data => {
                if (data.status == 422) {
                    showMessErrForm(data.responseJSON.errors)
                }
            },
            // xhr: progressUpload,
        })
    })

    // submit form create
    $('body').on('submit', '#create_vephep', function(e) {
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
                    showMessErrForm(data.responseJSON.errors)
                }
            },
            // xhr: progressUpload,
        })
    })
    $('#leader_group').select2();

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
                case key == 'ngay_ve':
                    appendMes(val, 'ngay_ve')
                    break
                case key == 'ngay_vao':
                    appendMes(val, 'ngay_vao')
                    break
                case key == 'hoc_vien_id':
                    appendMes(val, 'hoc_vien_id')
                    break
            }
        })
    }
});