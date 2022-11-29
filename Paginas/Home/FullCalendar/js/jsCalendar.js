document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'pt-br',
        plugins: ['interaction', 'dayGrid'],
        //defaultDate: '2019-04-12',
        editable: true,
        eventLimit: true,
        events: 'list_eventos.php',
        extraParams: function() {
            return {
                cachebuster: new Date().valueOf()
            };
        }
    });

    calendar.render();
});