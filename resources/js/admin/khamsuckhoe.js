$(function() {
    var elementData = $('.mess-data');
    var urlDataTable = elementData.data('url-datatable');
    var urlShow = elementData.data('url-show');
    var urlCreated = elementData.data('url-create');
    var urlCount = elementData.data('url-count');
    var urlExcel = elementData.data('url-excel');
    var dataAdmin = $('.mess-role').data('role-admin');
    $('#hv_kyluat').DataTable({
        "ajax": urlDataTable,
        "language": {
            "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
        },
        "columns": [
            { "data": "id" },
            { "data": "ma_hoc_vien" },
            { "data": null },
            { "data": "ten" },
            { "data": "so_lan" },
            { "data": "ngay" },
            { "data": null },
        ],
        'columnDefs': [{
                'targets': 0,
                'sortable': false,
                'class': 'text-center  align-middle'
            }, {
                'targets': 1,
                'sortable': false,
                'class': 'text-center  align-middle'
            },
            {
                'targets': 2,
                'sortable': false,
                'class': 'text-center align-middle'
            },
            {
                'targets': 3,
                'class': 'text-center align-middle'
            },
            {
                'targets': 4,
                'class': 'text-center align-middle'
            },
            {
                'targets': 5,
                'class': 'text-center align-middle'
            },
            {
                'targets': 6,
                'class': 'text-center align-middle'
            },

        ],
        "paging": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "createdRow": function(row, data, index) {
            let showLink = urlShow.replace('ID_REPLY_IN_URL', data.id);
            let createdLink = urlCreated.replace('ID_REPLY_IN_URL', data.id);
            let countLink = urlCount.replace('ID_REPLY_IN_URL', data.id);
            let excelLink = urlExcel.replace('ID_REPLY_IN_URL', data.id);
            let random = Math.random().toString(36).substring(2) + (new Date()).getTime().toString();
            let random_string = `${random}_${data.id}`;
            let dir_path = "";
            if (data.avatar_url == null) {
                dir_path = window.location.origin + "/admin_assets/images/logo/logo-aq-h.png";
            } else {
                dir_path = window.location.origin + "/storage/uploads/user_avatar/icon128/" + data.avatar_url;
            }
            $('td', row).eq(2).empty().append(`
                <img class="profile-user-img img-circle" src="${dir_path}" alt="${data.ten}">
                `);
            $('td', row).eq(6).empty().append(`
                <div>
                    <a href="${createdLink}" class="btn btn-success btn-sm btn-block"">
                        <i class="far fa-edit"></i> Đánh giá 
                    </a>
                    <a href="${countLink}" title="Xem chi tiết" class="btn btn-info btn-sm btn-block"">
                        <i class="fas fa-info-circle"></i> Chi tiết
                    </a>
                    <a href="${excelLink}" title="Xuất file excel" class="btn btn-success btn-sm btn-block"">
                        <i class="fas fa-file-excel"></i> Excel
                    </a>
                </div>
            `);

        },
    });

    $('body').on('click', '.rule_update', function(event) {
        event.preventDefault();
        $('#modal-edit').modal('show', { backdrop: 'true' });
        let rule_value = $(this).data('id');
        let ip_value = $('input[name="hoc_vien_id"]');
        ip_value.attr('value', rule_value);
    });
    // ck editor 
    CKEDITOR.replace('event_content');

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
})