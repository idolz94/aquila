$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function() {
    var elementData = $('.mess-data');
    var urlDataTable = elementData.data('url-datatable');
    var urlEdit = elementData.data('url-edit');
    var urlUpdate = elementData.data('url-update');
    var urlDelete = elementData.data('url-delete');
    var dataAdmin = $('.mess-role').data('role-admin');
    let dataTable = $('#table_bm').DataTable({
        "ajax": urlDataTable,
        "language": {
            "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
        },
        "columns": [
            { "data": "id" },
            { "data": "ten_bo_mon" },
            { "data": null },
        ],
        'columnDefs': [{
                'targets': 0,
                'class': 'text-center align-middle'
            }, {
                'targets': 1,
                'sortable': false,
                'class': 'text-center align-middle text-capitalize'
            },
            {
                'targets': 2,
                'sortable': false,
                'class': 'text-center align-middle',
                'width': '20%'
            },

        ],
        "paging": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "createdRow": function(row, data, index) {
            let editLink = urlEdit.replace('ID_REPLY_IN_URL', data.id);
            if (dataAdmin == 1) {
                $('td', row).eq(2).empty().append(`
                <div>
                    <a href="#" class="btn btn-info update_bm" data-name="${data.ten_bo_mon}" data-id="${data.id}">
                        <i class="far fa-edit"></i> Cập nhật
                    </a>
                    <a type="submit" class="btn btn-default delete-trigger" data-id="${data.id}">
                        <i class="fas fa-trash"></i> Xoá
                    </a>
                </div>
            `);
            } else {
                $('td', row).eq(2).empty().append(`
                <div>
                    <a href="#" class="btn btn-info update_bm" data-name="${data.ten_bo_mon}" data-id="${data.id}">
                        <i class="far fa-edit"></i> Cập nhật
                    </a>
                </div>
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
        $('#delete-bomon-form').attr('action', action);
    });
    /* edit */

    $('body').on('click', '#modal-danger .yes-confirm', e => {
        $('#delete-bomon-form').submit();
    });
    // update
    $('body').on('click', '.update_bm', function(event) {
        event.preventDefault();
        $('#modal-edit').modal('show', { backdrop: 'true' });
        let url = urlUpdate.replace('ID_REPLY_IN_URL', $(this).data('id'));
        let name_bm = $(this).data("name");
        // let type = $('input[name="_method_"]').val();
        $('input[name="ten_bo_mon"]').val(name_bm);
        $('#update_bomon').attr('action', url);

        $('body').on('submit', '#update_bomon', function(e) {
            e.preventDefault();
            let urlIndex = $(this).data('url-index');
            let formData = new FormData()
            let formElement = $(this);
            let type = $(this).attr('method');
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
                type: type,
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: data => {
                    window.location.href = urlIndex
                },
                error: data => {
                    if (data.status == 422) {
                        let htmlCode = `<strong>Tên bộ môn đã có, mời nhập tên khác</strong><br>`
                        $('.text-danger.ten_bo_mon_update').html(htmlCode)
                    }
                },
                // xhr: progressUpload,
            })
        })
    });



    // create
    $('body').on('submit', '#create_bomon', function(e) {
        e.preventDefault();
        let urlIndex = $(this).data('url-index');
        let url = $(this).attr('action');
        let type = $(this).attr('method');
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
            type: type,
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
                case key == 'ten_bo_mon':
                    appendMes(val, 'ten_bo_mon')
                    break
            }
        })
    }
});