$(function() {
    var elementData = $('.mess-data');
    var urlDataTable = elementData.data('url-datatable');
    var urlEdit = elementData.data('url-edit');
    var urlShow = elementData.data('url-show');
    var urlDelete = elementData.data('url-delete');
    $('#table_mng').DataTable({
        "ajax": urlDataTable,
        "language": {
            "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
        },
        "columns": [
            { "data": "id" },
            { "data": "ten" },
            { "data": "email" },
            { "data": "role" },
            { "data": "gender" },
            { "data": null },
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
            },
            {
                'targets': 5,
                'sortable': false,
                'class': 'text-center align-middle'
            },
            {
                'targets': 6,
                'sortable': false,
                'class': 'text-center align-middle'
            }
        ],
        "paging": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "createdRow": function(row, data, index) {
            let showLink = urlShow.replace('ID_REPLY_IN_URL', data.id);
            let dir_path = "";
            if (data.avatar == null) {
                dir_path = window.location.origin + "/admin_assets/images/logo/logo-aq-h.png";
            } else {
                dir_path = window.location.origin + "/storage/uploads/admin_avatar/icon128/" + data.avatar;
            }
            $('td', row).eq(5).empty().append(`
                <img src="${dir_path}" alt="${data.ten}" class="profile-user-img img-circle">
                `);
            if (data.role !== 'Super Admin')
                $('td', row).eq(6).empty().append(`
                <div>
                    <a type="submit" title="Xoá" class="btn btn-default" data-id="${data.id}">
                        <i class="fas fa-trash"></i> Xoá 
                    </a>
                    <a href="${showLink}" class="btn btn-info">
                        <i class="fas fa-info-circle"></i> Chi tiết
                    </a>
                </div>
            `);
            else
                $('td', row).eq(6).empty().append(`
                <a href="${showLink}" class="btn btn-info">
                    <i class="fas fa-info-circle"></i> Chi tiết
                </a>
                `);
        },
    });

    // update form modal
    $('body').on('click', '.edit-admin', function(event) {
        event.preventDefault();
        $('#modal-edit').modal('show', { backdrop: 'true' });
        // let action = urlDelete.replace('ID_REPLY_IN_URL', $(this).data('id'));
        // $('#delete-lophoc-form').attr('action', action);
    });

    $('body').on('click', '.edit-admin', function(event) {
        event.preventDefault();
        let element = $(this);
        let formElement = $('#update_manage');
        let url = element.attr('href');
        let role = formElement.find('select[name="role"] option');
        let gender = formElement.find('select[name="gender"] option');
        let urlUpdate = formElement.attr('action');
        $.ajax({
            url: url,
            type: 'GET',
            contentType: false,
            cache: false,
            processData: false,
            success: data => {
                formElement.find('input[name="ten"]').val(data.data.ten);

                role.each(function(i, e) {
                    if ($(e).val() == data.data.role) {
                        $(e).attr('selected', 'selected')
                    }
                });

                gender.each(function(i, e) {
                    if ($(e).val() == data.data.gender) {
                        $(e).attr('selected', 'selected')
                    }
                });

                formElement.attr('action', urlUpdate.replace('ID_REPLY_IN_URL', data.data.id))
            },
            error: data => {
                if (data.status == 422) {
                    showMessErrForm(data.responseJSON.errors)
                }
            },
        });

    });

    // delete form modal
    $('body').on('click', '.delete-trigger', function(event) {
        event.preventDefault();
        $('#modal-danger').modal('show', { backdrop: 'true' });
        let action = urlDelete.replace('ID_REPLY_IN_URL', $(this).data('id'));
        $('#delete-lophoc-form').attr('action', action);
    });

    $('body').on('click', '#modal-danger .yes-confirm', e => {
        $('#delete-admin-form').submit();
    });


    //update
    // $('body').on('click', '#update-admin', function(event) {
    //     event.preventDefault();
    //     let formElement = $('#update_manage');
    //     let urlIndex = formElement.data('url-index');
    //     let url = formElement.attr('action');
    //     let formData = new FormData();
    //     formElement.find('input[name],select[name]').each(function(i, e) {
    //         if (Array.isArray($(e).val())) {
    //             $(e).val().forEach(function(v) {
    //                 formData.append($(e).attr('name'), v);
    //             })
    //         } else {
    //             formData.append($(e).attr('name'), $(e).val());
    //         }
    //     });

    //     $.ajax({
    //         url: url,
    //         type: 'PUT',
    //         data: formData,
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         success: data => {
    //             Swal.fire({
    //                 type: 'success',
    //                 title: 'Đã sửa thành công!',
    //                 confirmButtonText: 'Ok'
    //             }).then((data) => {
    //                 if (data.value) {
    //                     window.location.href = urlIndex;
    //                 }
    //             });
    //         },
    //         error: data => {
    //             if (data.status == 422) {
    //                 showMessErrForm(data.responseJSON.errors)
    //             }
    //         },
    //     });
    // });

    // create form modal 
    $('body').on('click', '#create_admin', function(e) {
        e.preventDefault();
        let formElement = $('#create_manage');
        let urlIndex = formElement.data('url-index');
        let url = formElement.attr('action');
        let formData = new FormData();
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
                Swal.fire({
                    type: 'success',
                    title: 'Đã thêm thành công!',
                    confirmButtonText: 'Ok'
                }).then((data) => {
                    if (data.value) {
                        window.location.href = urlIndex;
                    }
                });
            },
            error: data => {
                if (data.status == 422) {
                    showMessErrForm(data.responseJSON.errors)
                }
            },
        });
    });

    function appendMes(messages, classEl) {
        let htmlCode = ''

        $.each(messages, (key1, val1) => {
            htmlCode += `<strong>${val1}</strong><br>`
        })

        $('.text-danger.' + classEl).html(htmlCode)
    };

    function showMessErrForm(errors) {
        $.each(errors, (key, val) => {
            switch (true) {
                case key == 'ten':
                    appendMes(val, 'ten')
                    break
                case key == 'email':
                    appendMes(val, 'email')
                    break
                case key == 'role':
                    appendMes(val, 'role')
                    break
            }
        })
    };

    //Initialize Select2 Elements


});