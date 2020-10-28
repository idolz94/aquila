$(function() {
    let elementData = $('.mess-data'),
        urlDataTable = elementData.data('url-datatable'),
        urlEdit = elementData.data('url-edit'),
        urlDelete = elementData.data('url-delete'),
        urlUpdate = elementData.data('url-update');
    var dataAdmin = $('.mess-role').data('role-admin');
    $('#table_tc').DataTable({
        "ajax": urlDataTable,
        "language": {
            "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
        },
        "columns": [
            { "data": "id" },
            { "data": "ten_dien_giai" },
            { "data": "thu_chi", render: function(dataField) { if (dataField == null) { return "" } else if (dataField == 0) { return "Thu" } else { return "Chi" } } },
            { "data": null },
        ],
        'columnDefs': [{
                'targets': 0,
                'sortable': false,
                'class': 'text-center align-middle'
            },
            {
                'targets': 1,
                'class': 'text-center align-middle'
            },
            {
                'targets': 2,
                'class': 'text-center align-middle'
            },
        ],
        "paging": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "createdRow": function(row, data, index) {
            let editLink = urlEdit.replace('ID_REPLY_IN_URL', data.id);
            if (dataAdmin == 1) {
                $('td', row).eq(3).empty().append(`
                <div>
                    <a href="#" title="Cập nhật" class="btn btn-info btn-sm btn-block update-tc" data-id="${data.id}"  data-name="${data.ten_dien_giai}" data-status="${data.thu_chi}">
                        <i class="fas fa-edit"></i> Cập nhật
                    </a>
                    <a class="btn btn-default btn-sm btn-block delete-trigger" type="submit" title="Xoá" data-id="${data.id}">
                        <i class="fas fa-trash"></i> Xoá 
                    </a>
                </div>
            `);
            } else {
                $('td', row).eq(3).empty().append(`
                <div>
                    <a href="#" title="Cập nhật" class="btn btn-info btn-sm btn-block update-tc" data-id="${data.id}"  data-name="${data.ten_dien_giai}" data-status="${data.thu_chi}">
                        <i class="fas fa-edit"></i> Cập nhật
                    </a>
                </div>
            `);
            }
        },
    });

    /* delete */
    $('body').on('click', '.delete-trigger', function(event) {
        event.preventDefault();
        $('#modal-danger').modal('show', { backdrop: 'true' });
        let action = urlDelete.replace('ID_REPLY_IN_URL', $(this).data('id'));
        $('#delete-diengiai-taichinh-form').attr('action', action);
    });

    $('body').on('click', '#modal-danger .yes-confirm', e => {
        $('#delete-diengiai-taichinh-form').submit();
    })

    /* create */
    $('body').on('submit', '#create_diengiai-taichinh', function(e) {
        e.preventDefault();
        let urlIndex = $(this).data('url-index');
        let url = $(this).attr('action');
        let method = $(this).attr('method');
        let formData = new FormData()
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
            type: method,
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
        });
    });

    /* edit */
    $('body').on('click', '.update-tc', function(event) {
        event.preventDefault();
        $('#modal-edit').modal('show', { backdrop: 'true' });
        let action = urlUpdate.replace('ID_REPLY_IN_URL', $(this).data('id'));
        let name_tc = $(this).data('name');
        let status = $(this).data('status');
        console.log(status);
        $('#update_diengiai-taichinh').attr('action', action);
        $('#update_diengiai-taichinh input[name="ten_dien_giai"]').attr('value', name_tc);
        $('#update_diengiai-taichinh select[name="thu_chi"]').val(status);

    });

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
                case key == 'ten_dien_giai':
                    appendMes(val, 'ten_dien_giai')
                    break
            }
        })
    }
});