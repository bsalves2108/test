<style>
    .container {
        padding: 20px;
    }
</style>
<div class="container">
    <div id="calendar"></div>
</div>

<?= $this->element('Flash/toast');?>

<script>
    $(document).ready(function () {
        let calendar = $('#calendar').fullCalendar({
            defaultView: 'month',
            events: function (start, end, timezone, callback) {
                $.ajax({
                    url: '/api/calendar.json',
                    dataType: 'json',
                    data: {
                        start: start.format('YYYY-MM-DD'),
                        end: end.format('YYYY-MM-DD')
                    },
                    success: function (doc) {
                        let events = [];
                        $(doc).each(function () {
                            events.push({
                                id: $(this).attr('id'),
                                allDay: $(this).attr('all_day'),
                                title: $(this).attr('title'),
                                start: $(this).attr('start_at'),
                                end: $(this).attr('end_at')
                            });
                        });
                        callback(events);
                    }
                });
            },
            displayEventTime: false,
            editable: true,
            selectable: true,
            selectHelper: true,
            select: async function (start, end, allDay) {

                Swal.fire({
                    title: 'Cadastro de evento',
                    input: 'text',
                    inputLabel: 'Nome do evento',
                    showCancelButton: true,
                    inputValidator: (title) => {
                        let startDate = $.fullCalendar.formatDate(start, "Y-MM-DD");
                        let endDate = $.fullCalendar.formatDate(end, "Y-MM-DD");
                        $.ajax({
                            url: "/api/calendar",
                            data: {
                                title: title,
                                start_at: startDate,
                                end_at: endDate,
                                all_day: true
                            },
                            type: "POST",
                            success: (data) => {
                                displayMessage("Evento criado com sucesso!");

                                calendar.fullCalendar('renderEvent', {
                                    id: data.id,
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: allDay
                                }, true);

                                calendar.fullCalendar('unselect');
                            }
                        });
                    }
                });
            },

            eventDrop: function (event, delta) {
                let start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                let end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                $.ajax({
                    url: '/api/calendar/' + event.id,
                    data: {
                        title: event.title,
                        start_at: start,
                        end_at: end,
                        id: event.id
                    },
                    type: "PUT",
                    success: function () {
                        displayMessage("Evento atualizado com sucesso!");
                    }
                });
            },

            eventClick: function (event) {
                Swal.fire({
                    title: 'Editar ou excluir ?',
                    input: 'text',
                    inputValue: event.title,
                    inputLabel: 'Nome do evento',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Remover',
                    confirmButtonText: 'Editar',
                    showCancelButton: true,
                    inputValidator: (title) => {
                        $.ajax({
                            url: "/api/calendar/" + event.id,
                            data: {
                                id: event.id,
                                title: title
                            },
                            type: "PATCH",
                            success: (data) => {
                                displayMessage("Evento Alterado com sucesso!");
                                calendar.fullCalendar('removeEvents', event.id);
                                calendar.fullCalendar('renderEvent', {
                                    id: data.id,
                                    title: title,
                                    start: data.start_at,
                                    end: data.end_at,
                                    allDay: data.all_day
                                }, true);

                                calendar.fullCalendar('unselect');
                            }
                        });
                    }
                }).then((result) => {
                    if (!result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: '/api/calendar/' + event.id,
                            success: function () {
                                calendar.fullCalendar('removeEvents', event.id);
                                displayMessage("Evento apagado com sucesso!");
                            }
                        });
                    }
                });
            }

        });
    });
</script>
