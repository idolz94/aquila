$(function() {
    var elementData = $('.mess-data');
    var urlDataTable = elementData.data('url-datatable');
    var urlEdit = elementData.data('url-edit');
    var urlDelete = elementData.data('url-delete');
    var dataAdmin = $('.mess-role').data('role-admin');
    $('#table_mh').DataTable({
        "ajax": urlDataTable,
        "language": {
            "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
        },
        "columns": [
            { "data": "id" },
            { "data": "mon_hoc" },
            { "data": "loai_hinh", render: function(dataField) { return dataField == 0 ? 'Cố Định' : "Phát Sinh" } },
            { "data": "giao_doan", render: function(dataField) { return dataField == 0 ? 'Sơ Cấp' : "Trung Cấp" } },
            { "data": "do_kho", render: function(dataField) { return dataField == 0 ? 'Cơ Bản' : "Nâng Cao" } },
            { "data": null },
        ],
        'columnDefs': [{
                'targets': 0,
                'sortable': false,
                'class': "text-center align-middle"
            },
            {
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
            },
            {
                'targets': 5,
                'sortable': false,
                'class': "text-center align-middle"
            }
        ],
        "paging": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
        "createdRow": function(row, data, index) {
            let editLink = urlEdit.replace('ID_REPLY_IN_URL', data.id);
            if (dataAdmin == 1) {
                $('td', row).eq(5).empty().append(`
                <div>
                    <a href="${editLink}" class="btn btn-info">
                        <i class="far fa-edit mr-1"></i> Cập nhật
                    </a>
                    <a href="#" title="Xem chi tiết" class="btn btn-success d-none">
                        <i class="fas fa-info-circle mr-1"></i> Xem chi tiết
                    </a>
                    <a type="submit" class="btn btn-default delete-trigger" data-id="${data.id}">
                        <i class="fas fa-trash mr-1"></i> Xoá
                    </a>
                </div>
            `);
            } else {
                $('td', row).eq(5).empty().append(`
                <div>
                    <a href="${editLink}" class="btn btn-info">
                        <i class="far fa-edit mr-1"></i> Cập nhật
                    </a>
                    <a href="#" title="Xem chi tiết" class="btn btn-success">
                        <i class="fas fa-info-circle mr-1"></i> Xem chi tiết
                    </a>
                </div>
                `);
            }
        },
    });
    // get date



    $('body').on('click', '.delete-trigger', function(event) {
        event.preventDefault();
        $('#modal-danger').modal('show', { backdrop: 'true' });
        let action = urlDelete.replace('ID_REPLY_IN_URL', $(this).data('id'));
        $('#delete-monhoc-form').attr('action', action);
    })

    $('body').on('click', '#modal-danger .yes-confirm', e => {
        $('#delete-monhoc-form').submit();
    })

    $('body').on('submit', '#create_monhoc', function(e) {
        e.preventDefault();
        let urlIndex = $(this).data('url-index'),
            url = $(this).attr('action'),
            formData = new FormData(),
            formElement = $(this);

        let today = moment().format('DD/MM/YYYY');
        $('#start_date').attr('value', today);
        console.log(today);

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
                case key == 'mon_hoc':
                    appendMes(val, 'mon_hoc')
                    break
                case key == 'bo_mon_id':
                    appendMes(val, 'bo_mon_id')
                    break
                case key == 'loai_hinh':
                    appendMes(val, 'loai_hinh')
                    break
            }
        })
    }

    //Initialize Select2 Elements
    $('.select2_form').select2();

});