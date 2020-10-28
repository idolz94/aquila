$(function() {
    var elementData = $('.mess-data');
    var urlShow = elementData.data('url-show');

    $('body').on('submit', '#create_sukien', function(e) {
        e.preventDefault();
        let urlIndex = $(this).data('url-index');
        let url = $(this).attr('action');
        let formData = new FormData()
        let formElement = $(this);
        formElement.find('input[name],select[name],textarea[name]').each(function(i, e) {
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
                console.log(data)
                window.location.href = urlIndex
            },
            error: data => {
                if (data.status == 422) {
                    showMessErrForm(data.responseJSON.errors)
                }
            },
            // xhr: progressUpload,
        })
    });
    /* initialize the calendar
        -----------------------------------------------------------------*/
    $.ajax({
        url: urlShow,
        type: 'GET',
        success: function(result) {
            renderCalendar(result.data);
        },
        error: function(xhr, thrownError) {
            if (xhr.status == 500) {
                $('.card-error').removeClass('d-none');
                $('.card-success-data').addClass('d-none');
            }
            console.log(thrownError);
        }
    });

    function renderCalendar(data) {
        let Calendar = FullCalendar.Calendar;
        let calendarEl = document.getElementById('calendar');

        let calendar = new Calendar(calendarEl, {
            selectable: true,
            plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            locale: 'vi',
            //Random default events
            eventRender: function(info) {

                var tooltip = new Tooltip(info.el, {
                    title: info.event.extendedProps.description,
                    placement: 'top',
                    trigger: 'hover',
                    container: 'body'
                });
            },
            eventClick: function(info) {
                info.jsEvent.preventDefault();
                if (info.event.url) {
                    window.open(info.event.url);
                }
            },
            events: data
        });

        calendar.render();
    };

    //Colorpicker
    $('.my-colorpicker1').colorpicker()

    function appendMes(messages, classEl) {
        let htmlCode = ''

        $.each(messages, (key1, val1) => {
            htmlCode += `<strong>${val1}</strong><br>`
        })

        $('.text-danger.' + classEl).html(htmlCode)
    }
    // ck editor 
    CKEDITOR.replace('event_content');

    function showMessErrForm(errors) {
        $.each(errors, (key, val) => {
            switch (true) {
                case key == 'ten':
                    appendMes(val, 'ten')
                    break
                case key == 'ngay_bat_dau':
                    appendMes(val, 'ngay_bat_dau')
                    break
                case key == 'ngay_ket_thuc':
                    appendMes(val, 'ngay_ket_thuc')
                    break
            }
        })
    }
});