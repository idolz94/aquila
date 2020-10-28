$(function() {
    let elementData = $('.mess-data');
    let urlDataTable = elementData.data('url-datatable');
    let urlEdit = elementData.data('url-edit');
    let urlShow = elementData.data('url-show');
    let urlDelete = elementData.data('url-delete');
    let url_update = elementData.data('url-taichinh');
    let urlTheoDoiYTe = elementData.data('url-theodoiyte');
    let urlVePhep = elementData.data('url-vephep');
    let urlAnhQuaTrinh = elementData.data('url-anhquatrinh');
    let dataAdmin = $('.mess-role').data('role-admin');
    $('#hoc_vien').DataTable({
        "ajax": urlDataTable,
        "language": {
            "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
        },
        "columns": [
            { "data": "id" },
            { "data": "ma_hoc_vien" },
            { "data": null },
            { "data": "ten" },
            { "data": "gioi_tinh" },
            { "data": null },
        ],
        'columnDefs': [{
                'targets': 0,
                'class': "text-center align-middle"
            }, {
                'targets': 1,
                'class': "text-center align-middle"
            },
            {
                'targets': 2,
                'sortable': false,
                'class': "text-center align-middle"
            },
            {
                'targets': 3,
                'class': "text-center align-middle"
            },
            {
                'targets': 4,
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
        "autoWidth": false,
        "createdRow": function(row, data, index) {
            let editLink = urlEdit.replace('ID_REPLY_IN_URL', data.id);
            let detailLink = urlShow.replace('ID_REPLY_IN_URL', data.id);
            let showTheoDoiYTe = urlTheoDoiYTe.replace('ID_REPLY_IN_URL', data.id);
            let showVePhep = urlVePhep.replace('ID_REPLY_IN_URL', data.id);
            let taichinhLink = url_update.replace('ID_REPLY_IN_URL', `hoc_vien_id=${data.id}`);
            let anhQuaTrinh = urlAnhQuaTrinh.replace('ID_REPLY_IN_URL', data.id);
            let dir_path = "";
            if (data.avatar_url == null) {
                dir_path = window.location.origin + "/admin_assets/images/logo/logo-aq-h.png";
            } else {
                dir_path = window.location.origin + "/storage/uploads/user_avatar/icon128/" + data.avatar_url;
            }
            $('td', row).eq(2).empty().append(`
                <img src="${dir_path}" class="profile-user-img img-circle" alt="${data.ten}">
                `);
            if (dataAdmin == 1) {
                $('td', row).eq(5).empty().append(`
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown show">
                    <a class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" href="#" aria-expanded="true">
                        Tác vụ
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"> 
                        <div class="dropdown-divider"></div>
                        <a href="${editLink}" title="Cập nhật" class="dropdown-item">
                            <i class="fas fa-edit"></i> Cập nhật thông tin
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="${anhQuaTrinh}" title="Xem chi tiết" class="dropdown-item">
                            <i class="far fa-images"></i> Thêm ảnh học viên tại trung tâm
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="${detailLink}" title="Xem chi tiết" class="dropdown-item">
                            <i class="fas fa-info-circle"></i> Xem chi tiết
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="${taichinhLink}" title="Xem chi tiết" class="dropdown-item">
                            <i class="fas fa-money-check-alt"></i> Thêm tài chính
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="${showTheoDoiYTe}" target="_blank" title="Xem chi tiết" class="dropdown-item">
                            <i class="fas fa-notes-medical"></i> Theo dõi y tế
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="${showVePhep}" title="Xem chi tiết" class="dropdown-item">
                            <i class="fas fa-clipboard"></i> Về phép / Trốn về 
                        </a>
                        <div class="dropdown-divider"></div>
                        <a type="submit" title="Xoá" class="dropdown-item delete-trigger" data-id="${data.id}">
                            <i class="fas fa-trash"></i> Xoá học viên
                        </a>
                    </div>
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
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            <a href="${editLink}" title="Cập nhật" class="dropdown-item">
                                <i class="fas fa-edit"></i> Cập nhật thông tin
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="${anhQuaTrinh}" title="Xem chi tiết" class="dropdown-item">
                                <i class="far fa-images"></i> Thêm ảnh học viên tại trung tâm
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="${detailLink}" title="Xem chi tiết" class="dropdown-item">
                                <i class="fas fa-info-circle"></i> Xem chi tiết
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="${showTheoDoiYTe}" target="_blank" title="Xem chi tiết" class="dropdown-item">
                                <i class="fas fa-notes-medical"></i> Theo dõi y tế
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="${showVePhep}" title="Xem chi tiết" class="dropdown-item">
                                <i class="fas fa-clipboard"></i> Về phép / Trốn về 
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
        $('#delete-class-form').attr('action', action);
    })

    $('body').on('click', '#modal-danger .yes-confirm', e => {
            $('#delete-class-form').submit();
        })
        // $('body').on('submit', '#create_class', function(e) {
        //     e.preventDefault();
        //     let urlIndex = $(this).data('url-index');
        //     let url = $(this).attr('action');
        //     let formData = new FormData()
        //     let formElement = $(this);

    //     formElement.find('input[name], textarea[name]').each(function(i, e) {

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
    //         type: 'POST',
    //         data: formData,
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         success: data => {
    //             window.location.href = urlIndex
    //         },
    //         error: data => {
    //             if (data.status == 422) {
    //                 showMessErrForm(data.responseJSON.errors)
    //             }
    //         },
    //         // xhr: progressUpload,
    //     })
    // })

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
                case key == 'ma_lop_hoc':
                    appendMes(val, 'ma_lop_hoc')
                    break
                case key == 'ngay_bat_dau':
                    appendMes(val, 'ngay_bat_dau')
                    break
                case key == 'ngay_ket_thuc':
                    appendMes(val, 'ngay_ket_thuc')
                    break
                case key == 'ghi_chu':
                    appendMes(val, 'ghi_chu')
                    break
            }
        })
    }

});