$(function() {
    var elementData = $('.mess-data');
    var urlDataTable = elementData.data('url-datatable');
    console.log(urlDataTable);
    var urlDelete = elementData.data('url-delete');
    var dataAdmin = $('.mess-role').data('role-admin');
    $('#report').DataTable({
        "ajax": urlDataTable,
        "language": {
            "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
        },
        "dt-responsive": true,
        "columns": [
            { "data": "id" },
            { "data": "nguoibaoho.ten" },
            { "data": "nguoibaoho.hocvien.ten" },
            { "data": "category_report" },
            { "data": "content" },
            { "data": null },
        ],
        'columnDefs': [{
                'targets': 1,
                'sortable': false
            },
            {
                'targets': 2,
                'sortable': false
            },

        ],
        "paging": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
        "createdRow": function(row, data, index) {
            if (dataAdmin == 1) {
                $('td', row).eq(5).empty().append(`
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown show">
                        <a type="submit" title="Xoá" class="dropdown-item delete-trigger" data-id="${data.id}">
                            <i class="fas fa-trash"></i> Xoá report
                        </a>
                    </li>
                </ul>
                `);
            } else {
                $('td', row).eq(5).empty().append(`
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown show">
                        <a class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" href="#" aria-expanded="true">
                            Tác vụ
                        </a>
                    </li>
                </ul>
                `);
            }
        },
    });

    // submit del
    $('body').on('click', '.delete-trigger', function(event) {
        event.preventDefault();
        $('#modal-danger').modal('show', { backdrop: 'true' });
        let action = urlDelete.replace('ID_REPLY_IN_URL', $(this).data('id'));
        $('#delete-report-form').attr('action', action);
    });
    // confirm del
    $('body').on('click', '#modal-danger .yes-confirm', e => {
        $('#delete-report-form').submit();
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