<div class="">

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Calendario de Eventos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div id='calendar'></div>

                </div>
            </div>
        </div>
    </div>
</div>

<div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Información de Evento</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer" style="display:none">
                <button type="button" class="btn btn-default antoclose2" >Close</button>
            </div>
        </div>
    </div>
</div>

<div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
<div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>


<script>
    data_events =<?php echo $events_calendar; ?>
//    console.log(data_events);

    //    var data = [
    //        {
    //            title: 'Todo el dia',
    //            start: '2017-05-01'
    //        },
    //        {
    //            title: 'Long Event',
    //            start: '2017-05-07',
    //            end: '2017-05-10'
    //        },
    //        {
    //            id: 999,
    //            title: 'Repeating Event',
    //            start: '2017-05-09T16:00:00'
    //        },
    //        {
    //            id: 999,
    //            title: 'Repeating Event',
    //            start: '2017-05-16T16:00:00'
    //        },
    //        {
    //            title: 'Conference',
    //            start: '2017-05-11',
    //            end: '2017-05-13'
    //        },
    //        {
    //            title: 'Meeting',
    //            start: '2017-05-12T10:30:00',
    //            end: '2017-05-12T12:30:00'
    //        },
    //        {
    //            title: 'Lunch',
    //            start: '2017-05-12T12:00:00'
    //        },
    //        {
    //            title: 'Meeting',
    //            start: '2017-05-12T14:30:00'
    //        },
    //        {
    //            title: 'Happy Hour',
    //            start: '2017-05-12T17:30:00'
    //        },
    //        {
    //            title: 'Dinner',
    //            start: '2017-05-12T20:00:00'
    //        },
    //        {
    //            title: 'Birthday Party',
    //            start: '2017-05-13T07:00:00'
    //        },
    //        {
    //            title: 'Click for Google',
    //            url: 'http://google.com/',
    //            start: '2017-05-28'
    //        }
    //    ];

</script>
