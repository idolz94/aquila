$(function() {
    var elementData = $('.mess-data');
    var urlDataTable = elementData.data('url-datatable');
    var urlEdit = elementData.data('url-edit');
    var urlShow = elementData.data('url-show');
    var urlCreated = elementData.data('url-create');
    $('#hv_kyluat').DataTable({
        "ajax": urlDataTable,
        "language": {
            "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
        },
        "columns": [
            { "data": "id" },
            { "data": "ma_hoc_vien" },
            { "data": "ten" },
            { "data": null },
            { "data": "so_lan" },
            { "data": "ly_do" },
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
            {
                'targets': 7,
                'class': 'text-center align-middle'
            }

        ],
        "paging": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "createdRow": function(row, data, index) {
            let editLink = urlEdit.replace('ID_REPLY_IN_URL', data.id);
            let showLink = urlShow.replace('ID_REPLY_IN_URL', data.id);
            let createdLink = urlCreated.replace('ID_REPLY_IN_URL', data.id);
            let random = Math.random().toString(36).substring(2) + (new Date()).getTime().toString();
            let random_string = `${random}_${data.id}`;
            if (data.avatar_url == null) {
                dir_path = window.location.origin + "/admin_assets/images/logo/logo-aq-h.png";
            } else {
                dir_path = window.location.origin + "/storage/uploads/user_avatar/icon128/" + data.avatar_url;
            }
            $('td', row).eq(3).empty().append(`
                <img class="profile-user-img img-circle" src="${dir_path}" alt="${data.ten}">
                `);
            $('td', row).eq(7).empty().append(`
                <div>
                    <a href="${createdLink}" class="btn btn-info btn-sm btn-block rule_update" data-id="${random_string}">
                        <i class="far fa-edit"></i> Đánh giá 
                    </a>
                    <a href="${showLink}" title="Xem chi tiết" class="btn btn-success btn-sm btn-block">
                        <i class="fas fa-info-circle"></i> Chi tiết
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
})