$(function() {
    var elementData = $('.mess-data');
    var urlDataTable = elementData.data('url-datatable');
    var urlShow = elementData.data('url-show');
    $('#hv_hanhkiem').DataTable({
        "ajax": urlDataTable,
        "language": {
            "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
        },
        "columns": [
            { "data": "id" },
            { "data": "ma_hoc_vien" },
            { "data": "ten" },
            { "data": null },
            { "data": "ten_hanh_kiem" },
            { "data": "ky_luat" },
            { "data": null },
        ],
        'columnDefs': [{
                'targets': 0,
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
            let random = Math.random().toString(36).substring(2) + (new Date()).getTime().toString();
            let random_string = `${random}_${data.id}`;
            let showLink = urlShow.replace('ID_REPLY_IN_URL', data.id);
            if (data.avatar_url == null) {
                dir_path = window.location.origin + "/admin_assets/images/logo/logo-aq-h.png";
            } else {
                dir_path = window.location.origin + "/storage/uploads/user_avatar/icon128/" + data.avatar_url;
            }
            $('td', row).eq(3).empty().append(`
                <img class="profile-user-img img-circle" src="${dir_path}" alt="${data.ten}">
                `);
            $('td', row).eq(6).empty().append(`
                
                <div>
                    <a href="#" class="btn btn-info btn-sm btn-block update_conduct" data-id="${random_string}">
                        <i class="far fa-edit"></i> Đánh giá 
                    </a>
                    <a href="${showLink}" title="Xem chi tiết" class="btn btn-success btn-sm btn-block">
                        <i class="fas fa-info-circle"></i> Chi tiết
                    </a>
                </div>
             `);
        },
    });

    $('body').on('click', '.update_conduct', function(event) {
        event.preventDefault();
        $('#modal-edit').modal('show', { backdrop: 'true' });
        let rule_value = $(this).data('id');
        let ip_value = $('input[name="hoc_vien_id"]');
        ip_value.attr('value', rule_value);
    })

    $('body').on('submit', '#create_hanhkiem', function(e) {
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