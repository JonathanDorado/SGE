var data_events;
$(document).ready(function () {
    
    $.post("event/checkStateEventsByDate", function () {
        console.log("Validate");
    });

    var date = new Date(),
            d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear(),
            started,
            categoryClass;

    var calendar = $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listMonth'
        },
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
            $('#fc_create').click();

            started = start;
            ended = end;

            $(".antosubmit").on("click", function () {
                var title = $("#title").val();
                if (end) {
                    ended = end;
                }

                categoryClass = $("#event_type").val();

                if (title) {
                    calendar.fullCalendar('renderEvent', {
                        title: title,
                        start: started,
                        end: end,
                        allDay: allDay
                    },
                            true // make the event "stick"
                            );
                }

                $('#title').val('');

                calendar.fullCalendar('unselect');

                $('.antoclose').click();

                return false;
            });
        },
        eventClick: function (calEvent, jsEvent, view) {
//            alert('Hola');
            $(".modal-body").html("");

            $.post("event/show", {event_id: calEvent.event_id, modal: '1'}, function (data) {
//                alert(data);
                $('#fc_edit').click();
                $(".modal-body").html(data);
            }).done(function () {
                $('.buttonFinish').attr('display', 'none');
                $('.buttonFinish').prop('display', 'none');
            });

//            $('#fc_edit').click(function () {
//                alert('Hola');
//            });
//            $('#title2').val(calEvent.title);
//
//            categoryClass = $("#event_type").val();
//
//            $(".antosubmit2").on("click", function () {
//                calEvent.title = $("#title2").val();
//
//                calendar.fullCalendar('updateEvent', calEvent);
//                $('.antoclose2').click();
//            });

            calendar.fullCalendar('unselect');
        },
        editable: true,
        events: data_events
    });





//    var $calPopOver;
//    $('#calendar').fullCalendar({
//        header: {
//            left: 'prev,next today',
//            center: 'title',
//            right: 'month,agendaWeek,agendaDay,listWeek'
//        },
//        eventClick: function (calEvent, jsEvent, view) {
//
//            $(this).children().popover({
//                title: '<span class="text-info"><strong>Acciones</strong></span>' +
//                        '<button type="button" id="close" class="close" onclick="destroyPopover()">&times;</button>',
//                placement: "top",
//                content: '<div class="row"><div class="col-md-12"><a href="#" onclick="edit_Event(' + calEvent.event_id + ')">Ver Evento</a></div></div>\n\
//                          <div class="row"><div class="col-md-12"><a href="#" onclick="create_AssignTopics(' + calEvent.event_id + ')">Asignar Temáticas</a></div></div>\n\
//                          <div class="row"><div class="col-md-12"><a href="#" onclick="create_AssignSurvey(' + calEvent.event_id + ')">Asignar Encuesta</a></div></div>\n\
//                          <div class="row"><div class="col-md-12"><a href="#" onclick="list_Clients(' + calEvent.event_id + ')">Pre-registrar</a></div></div>\n\
//                          <div class="row"><div class="col-md-12"><a href="#" onclick="list_PreregisteredClients(' + calEvent.event_id + ')">Confirmación</a></div></div>\n\
//                          <div class="row"><div class="col-md-12"><a href="#" onclick="list_ConfirmedClients(' + calEvent.event_id + ')">Asistencia</a></div></div>',
//                html: true,
//                container: 'body'
//            });
//            if ($calPopOver)
//                $calPopOver.popover('destroy');
//        },
//        defaultDate: new Date(),
//        navLinks: false, // can click day/week names to navigate views
//        editable: false,
//        eventLimit: true, // allow "more" link when too many events
//        events: data_events, //This variable comes from list_events
//    });
});