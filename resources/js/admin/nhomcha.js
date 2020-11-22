$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function() {
    let elementData = $('.mess-data');
    let urlDataTable = elementData.data('url-datatable');
    let urlEdit = elementData.data('url-edit');
    let urlDelete = elementData.data('url-delete');
    let url_group_edit = '';
    var dataAdmin = $('.mess-role').data('role-admin');
    $('#example2').DataTable({
        "ajax": urlDataTable,
        "language": {
            "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
        },
        "columns": [
            { "data": "id" },
            { "data": "ten" },
            { "data": null },
        ],
        "columnDefs": [{
                'targets': 0,
                'class': "text-center align-middle"
            },
            {
                'targets': 1,
                'class': "text-center align-middle",
                'sortable': false
            },
            {
                'targets': 2,
                'class': "text-center align-middle"
            }
        ],
        "paging": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "createdRow": function(row, data, index) {
            let editShow = urlEdit.replace('ID_REPLY_IN_URL', data.id);
            if (dataAdmin == 1) {
                $('td', row).eq(2).empty().append(`
                    <div>
                        <a href="#" class="btn btn-info update_group" data-name="${data.ten}" data-id="${data.id}">
                            <i class="far fa-edit"></i> Cập nhật nhóm
                        </a>
                        <a type="submit" class="btn btn-secondary delete-trigger text-white" data-id="${data.id}">
                            <i class="fas fa-trash"></i> Xoá nhóm
                        </a>
                    </div>
                `);
            } else {
                $('td', row).eq(2).empty().append(`
                    <div>
                        <a href="#" class="btn btn-info update_group" data-name="${data.ten}" data-id="${data.id}">
                            <i class="far fa-edit"></i> Cập nhật nhóm
                        </a>
                    </div>
                `);
            }
        },
    });

    $('body').on('click', '.delete-trigger', function(event) {
        event.preventDefault();
        $('#modal-danger').modal('show', { backdrop: 'true' });
        let action = urlDelete.replace('ID_REPLY_IN_URL', $(this).data('id'));

        $('#delete-nhomcha-form').attr('action', action);
    });

    $('body').on('click', '#modal-danger .yes-confirm', e => {
        $('#delete-nhomcha-form').submit();
    });

    $('body').on('click', '.update_group', function(event) {
        event.preventDefault();
        $('#modal-edit').modal('show', { backdrop: 'true' });
        let name_group = $(this).data('name');
        let ip_value = $('input[name="ten"]');
        let random = Math.random().toString(36).substring(2) + (new Date()).getTime().toString();
        let random_string = `${random}_${ $(this).data('id') }`;
        console.log(random_string);
        url_group_edit = urlEdit.replace('ID_REPLY_IN_URL', random_string);
        ip_value.attr('value', name_group);
        $('#update_group').attr('action', url_group_edit);

    });
    // submit form update
    $('body').on('submit', '#update_group', function(e) {
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
        console.log(formData)
        $.ajax({
            url: url_group_edit,
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: data => {
                console.log(data)
                window.location.href = urlIndex
            },
            error: data => {
                // console.log(data)
                if (data.status == 500) {
                    let htmlCode = `<strong>Tên nhóm chính đã có ! mời nhập tên khác</strong><br>`;
                    $('.text-danger.ten_update').html(htmlCode);
                }

            },
            // xhr: progressUpload,
        })
    })


    // submit form create
    $('body').on('submit', '#create_nhomcha', function(e) {
        e.preventDefault();
        let urlIndex = $(this).data('url-index');
        let url = $(this).attr('action');
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
                case key == 'ten':
                    appendMes(val, 'ten')
                    break
            }
        })
    }
});