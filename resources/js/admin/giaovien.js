$(function() {
    var elementData = $('.mess-data');
    var urlDataTable = elementData.data('url-datatable');
    var urlEdit = elementData.data('url-edit');
    var urlShow = elementData.data('url-show');
    var urlDelete = elementData.data('url-delete');
    var dataAdmin = $('.mess-role').data('role-admin');
    $('#table_gv').DataTable({
        "ajax": urlDataTable,
        "language": {
            "url": "/admin_assets/plugins/datatables-bs4/lang/vietnamese-lang.json"
        },
        "columns": [
            { "data": "id" },
            { "data": "ten" },
            { "data": "email" },
            { "data": "so_dien_thoai" },
            { "data": "ngay_sinh" },
            { "data": "hephai.ten" },
            { "data": null },
        ],
        "columnDefs": [{
                'targets': 0,
                'class': "text-center align-middle"
            }, {
                'targets': 1,
                'class': "text-center align-middle"
            }, {
                'targets': 2,
                'class': "text-center align-middle"
            }, {
                'targets': 3,
                'class': "text-center align-middle"
            }, {
                'targets': 4,
                'class': "text-center align-middle"
            }, {
                'targets': 5,
                'sortable': false,
                'class': "text-center align-middle"
            },
            {
                'targets': 6,
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
            let showLink = urlShow.replace('ID_REPLY_IN_URL', data.id);
            if (dataAdmin == 1) {
                $('td', row).eq(6).empty().append(`
                <div>
                    <a href="${editLink}" class="btn btn-info">
                        <i class="far fa-edit"></i> Cập nhật
                    </a>
                    <a href="${showLink}" title="Danh sách học viên" class="btn btn-success">
                        <i class="fas fa-info-circle"></i> Thông tin 
                    </a>
                    <a type="submit" class="btn btn-default delete-trigger" data-id="${data.id}">
                        <i class="fas fa-trash"></i> Xoá
                    </a>
                </div>
            `);
            } else {
                $('td', row).eq(6).empty().append(`
                <div>
                    <a href="${editLink}" class="btn btn-info">
                        <i class="far fa-edit"></i> Cập nhật
                    </a>
                    <a href="${showLink}" title="Danh sách học viên" class="btn btn-success">
                        <i class="fas fa-info-circle"></i> Thông tin
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
        $('#delete-giaovien-form').attr('action', action);
    })

    $('body').on('click', '#modal-danger .yes-confirm', e => {
        $('#delete-giaovien-form').submit();
    })

    // show one image
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#avatar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
            $('.show-fileiamge').removeClass('d-none');
        }
    }

    $("#fileupload").change(function() {
        readURL(this);
    });

    // show array image
    let parent_e = document.getElementById('multipe_img');

    function readArrURL(input, parent_e) {

        if (input.files) {
            let ip_length = input.files.length;
            for (let i = 0; i < input.files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    let block_img = `
            <div class="col-lg-3">
              <img width="100%" src=${e.target.result}>
            </div>
          `;
                    $(block_img).appendTo(parent_e);
                }
                reader.readAsDataURL(input.files[i]);
            };
        }
    }

    $("#multifileupload").change(function() {
        readArrURL(this, parent_e);
    });
    // $('body').on('submit', '#create_giaovien', function(e) {
    //     e.preventDefault();
    //     let urlIndex = $(this).data('url-index');
    //     let url = $(this).attr('action');
    //     let type = $("input[name='_method']").val();
    //     let formData = new FormData()
    //     let formElement = $(this);
    //     formElement.find('input[name],select[name]').each(function(i, e) {
    //         if (Array.isArray($(e).val())) {
    //             $(e).val().forEach(function(v) {
    //                 formData.append($(e).attr('name'), v);
    //             })
    //         } else {
    //             formData.append($(e).attr('name'), $(e).val());
    //         }
    //     });

    //     let file = $("#fileupload")[0].files;
    //     formData.append('anh_dai_dien', file);

    //     $.ajax({
    //         url: url,
    //         type: type,
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
        console.log(htmlCode);
    }

    function showMessErrForm(errors) {

        $.each(errors, (key, val) => {
            switch (true) {
                case key == 'ten':
                    appendMes(val, 'ten')
                    break
                case key == 'email':
                    appendMes(val, 'email')
                    break
                case key == 'he_phai':
                    appendMes(val, 'he_phai')
                    break
                case key == 'chuc_vu':
                    appendMes(val, 'chuc_vu')
                    break
                case key == 'quoc_gia':
                    appendMes(val, 'quoc_gia')
                    break
                case key == 'ngay_sinh':
                    appendMes(val, 'ngay_sinh')
                    break
                case key == 'doi_tac':
                    appendMes(val, 'doi_tac')
                    break
                case key == 'so_dien_thoai':
                    appendMes(val, 'so_dien_thoai')
                    break
                case key == 'anh_dai_dien':
                    appendMes(val, 'anh_dai_dien')
                    break
                case key == 'nguoi_gioi_thieu':
                    appendMes(val, 'nguoi_gioi_thieu')
                    break
            }
        })
    }


});