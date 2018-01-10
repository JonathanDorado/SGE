<input type='hidden' id="event_id" value="<?php echo $event[0]->event_id; ?>">
<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="page-title">
            <div class="title_left">
                <h3>Dashboard Evento
                    <small><?php echo $event[0]->name; ?></small></h3>
            </div>
        </div>
        <div class="clearfix"></div>


        <div class="row">
            <div class="row top_tiles">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-comment"></i></div>
                        <div class="count"><?php echo $guests[0]->total ?></div>
                        <br><h3>Invitados</h3>
                        <p>Clientes</p>
                    </div>
                </div>

                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-user-plus"></i></div>
                        <div class="count"><?php echo $preregister_clients[0]->total ?></div>
                        <br><h3>Pre-registrados</h3>
                        <p>Clientes</p>
                    </div>
                </div>

                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-check-square"></i></div>
                        <div class="count"><?php echo $confirmed_clients[0]->total ?></div>
                        <br><h3>Confirmados</h3>
                        <p>Clientes</p>
                    </div>
                </div>

                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-check-square"></i></div>
                        <div class="count"><?php echo $attended_clients[0]->total ?></div>
                        <br><h3>Asistentes</h3>
                        <p>Clientes</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Proyección Evento vs Avance Real</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="graph_projections" style="height:400px;"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tipos de Pago</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="echart_pie" style="height:400px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Reportes</h2>
                    <div class="clearfix"></div>
                </div>

                <table class="table">
                    <?php if (in_array(PREREGISTER_REPORT, $this->session->userdata('permissions'))) { ?>
                        <tr>
                            <td>Clientes Pre-registrados </td>
                            <td><a href="getReportClientsPreregistered?event_id=<?php echo $event[0]->event_id ?>" target="_blank" ><span class="fa fa-download"></span></a></td>
                        </tr>
                        <?php
                    }
                    if (in_array(CONFIRMED_REPORT, $this->session->userdata('permissions'))) {
                        ?>
                        <tr>
                            <td>Clientes Confirmados </td>
                            <td><a href="getReportClientsConfirmed?event_id=<?php echo $event[0]->event_id ?>" target="_blank" ><span class="fa fa-download"></span></a></td>
                        </tr>
                        <?php
                    }
                    if (in_array(ASSISTANCE_REPORT, $this->session->userdata('permissions'))) {
                        ?>
                        <tr>
                            <td>Asistencia</td>
                            <td><a href="getReportAssitance?event_id=<?php echo $event[0]->event_id ?>" target="_blank" ><span class="fa fa-download"></span></a></td>
                        </tr>
                        <?php
                    }
                    if (in_array(SURVEY_REPORT, $this->session->userdata('permissions'))) {
                        ?>
                        <tr>
                            <td>Evaluación Evento</td>
                            <td><a href="getReportAnswersSurvey?event_id=<?php echo $event[0]->event_id ?>" target="_blank" ><span class="fa fa-download"></span></a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>

        <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Promedio Encuesta</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php foreach ($average_survey_questions as $average_survey_question) { ?>
                        <div class="widget_summary">
                            <div class="w_left w_55">
                                <span><?php echo $average_survey_question->question; ?></span>
                            </div>
                            <div class="w_center w_55">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?php echo ($average_survey_question->average * 100) / 10; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($average_survey_question->average * 100) / 10; ?>%">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20">
                                <span><?php echo number_format((float) $average_survey_question->average, 1, '.', '');
                    0; ?></span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
<?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$random = rand(1, 5);
$color = "";
switch ($random) {
    case 1:$color = "aqua";
        break;
    case 2:$color = "red";
        break;
    case 3:$color = "blue";
        break;
    case 4:$color = "green";
        break;
    case 5:$color = "yellow";
        break;
}