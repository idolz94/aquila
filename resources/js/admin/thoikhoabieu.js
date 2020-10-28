$(document).ready(function() {

    let curr = new Date();
    let week = [];
    for (let i = 1; i <= 6; i++) {
        let first = curr.getDate() - curr.getDay() + i;
        let day = new Date(curr.setDate(first)).toISOString().slice(0, 10);
        week.push(day);
    };
    let input_total = $('input[name="ngay[]"]');
    let days_show = $('.day_of_week');
    let name_days = ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7"];
    for (let i = 0; i < input_total.length; i++) {
        let date_of_week = new Date(week[i]);
        let day_of_week = date_of_week.getDay();
        input_total[i].setAttribute('value', week[i]);
        switch (day_of_week) {
            case 1:
                days_show[i].innerHTML = name_days[i];
                break;
            case 2:
                days_show[i].innerHTML = name_days[i];
                break;
            case 3:
                days_show[i].innerHTML = name_days[i];
                break;
            case 4:
                days_show[i].innerHTML = name_days[i];
                break;
            case 5:
                days_show[i].innerHTML = name_days[i];
                break;
            case 6:
                days_show[i].innerHTML = name_days[i];
        };
    }
    // time morning
    $('.learn_input').on('change', function(e) {
        console.log(e.target.value);
        let time_morning = $('.moring_learn');
        for (let i = 0; i < time_morning.length; i++) {
            time_morning[i].setAttribute('value', e.target.value);
        };

    });
    // time afternoon
    $('.learn_input_two').on('change', function(e) {
        console.log(e.target.value);
        let time_afternoonc = $('.afternoon_learn');
        for (let i = 0; i < time_afternoonc.length; i++) {
            time_afternoonc[i].setAttribute('value', e.target.value);
        };

    });

    // select 2
    $('#select_class').select2();

    function renderCalendar(data) {
        let Calendar = FullCalendar.Calendar;
        let calendarEl = document.getElementById('calendar');

        let calendar = new Calendar(calendarEl, {
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
                info.jsEvent.preventDefault(); // don't let the browser navigate

                if (info.event.url) {
                    window.open(info.event.url);
                }
            },
            events: data

        });

        calendar.render();
    };


    // render time 





});