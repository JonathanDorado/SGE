
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Lista de Eventos </h2>
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
                <div class="row">
                    <div class="col-lg-12">
                        <?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert alert-success">
                                <?php
                                echo $this->session->flashdata('success');
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <table id="table-events" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Eventos</th>
                            <th class="text-center">Tipo Evento</th>
                            <th class="text-center">Tipo Asistencia</th>
                            <th class="text-center">Fecha Inicio</th>
                            <th class="text-center">Fecha Finalización</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $event) { ?>
                            <tr>
                                <td class='text-center'><?php echo $event->event_id; ?></td>
                                <td class='text-center'><?php echo $event->name; ?></td>
                                <td class='text-center'><?php echo $event->event_type; ?></td>
                                <td class='text-center'><?php echo $event->event_assistance_type; ?></td>
                                <td class='text-center'><?php echo $event->date_from; ?></td>
                                <td class='text-center'><?php echo $event->date_until; ?></td>
                                <td class='text-center'><?php echo $event->status; ?></td>
                                <td class='text-center'>
                                    <?php
                                    if ($event->state_id != 4 or $this->session->userdata('profile_id') == 1 or $this->session->userdata('profile_id') == 2) {//Only if event is not finished yet or if profile is admin or superadmin
                                        $permissions_actions_event = array(ASSIGN_TOPICS, ASSIGN_SURVEY, SCORE_CLIENTS_EVENTS, INVITE_EVENT, PRE_REGISTER_EVENT, CONFIRM_EVENT, ASSISTANCE_EVENT);
                                        if (array_intersect($permissions_actions_event, $this->session->userdata('permissions'))) {

                                            $show_manage = true;
                                            if ($this->session->userdata('profile_id') == 3 OR $this->session->userdata('profile_id') == 4) {
                                                if ($this->session->userdata('profile_id') == 3 AND $event->event_assistance_type_id == 3) {
                                                    $show_manage = false;
                                                } else if ($this->session->userdata('profile_id') == 4 AND $event->event_assistance_type_id == 1) {
                                                    $show_manage = false;
                                                }
                                            }

                                            if ($show_manage) {
                                                ?>
                                                <div class="btn-group">
                                                    <a href='#' data-toggle="dropdown" class='btn btn-danger dropdown-toggle btn-xs'> Gestionar <span class="caret"></span></a>
                                                    <ul role="menu" class="dropdown-menu">
                                                        <?php
                                                        $permissions_assign_topics = array(ASSIGN_TOPICS);
                                                        if (array_intersect($permissions_assign_topics, $this->session->userdata('permissions'))) {
                                                            ?>
                                                            <li><a href="#" onclick="create_AssignTopics(<?php echo $event->event_id; ?>)">Temáticas</a></li>
                                                            <?php
                                                        }
                                                        $permissions_assign_survey = array(ASSIGN_SURVEY);
                                                        if (array_intersect($permissions_assign_survey, $this->session->userdata('permissions'))) {
                                                            ?>
                                                            <li><a href = "#" onclick = "create_AssignSurvey(<?php echo $event->event_id; ?>)">Encuesta</a></li>
                                                            <?php
                                                        }
                                                        $permissions_manage_clients = array(ASSIGN_SURVEY, INVITE_EVENT, PRE_REGISTER_EVENT, CONFIRM_EVENT, ASSISTANCE_EVENT);
                                                        if (array_intersect($permissions_manage_clients, $this->session->userdata('permissions'))) {
                                                            ?>
                                                            <li><a href = "#" onclick = "manage_Clients(<?php echo $event->event_id; ?>)">Clientes</a></li>
                                                            <?php
                                                        }
                                                        $permissions_assign_score = array(SCORE_CLIENTS_EVENTS);
                                                        if (array_intersect($permissions_assign_score, $this->session->userdata('permissions'))) {
                                                            ?>
                                                            <li><a href = "#" onclick = "list_Score(<?php echo $event->event_id; ?>)">Calificaciones</a></li>
                                                        <?php } ?>    
                                                    </ul>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                    $permissions_view_detail = array(VIEW_EVENT_DETAIL);
                                    if (array_intersect($permissions_view_detail, $this->session->userdata('permissions'))) {
                                        ?>
                                        <div class="btn-group">
                                            <a href='#' onclick='show_Event(<?php echo $event->event_id; ?>)' class='btn btn-success dropdown-toggle btn-xs'><i  class='fa fa-search'></i> Ver </a>
                                        </div>
                                        <?php
                                    }
                                    if ($event->state_id != 4 or $this->session->userdata('profile_id') == 1 or $this->session->userdata('profile_id') == 2) {
                                        $permissions_edit_event = array(CREATE_PRESENTIAL_EVENT, CREATE_VIRTUAL_EVENT, ADD_DESIGN_EVENT, ADD_SCORE_EVENT, ADD_PROJECTION_EVENT);
                                        if (array_intersect($permissions_edit_event, $this->session->userdata('permissions'))) {

                                            $show_edit = true;
                                            if ($this->session->userdata('profile_id') == 3 OR $this->session->userdata('profile_id') == 4) {
                                                if ($this->session->userdata('profile_id') == 3 AND $event->event_assistance_type_id == 3) {
                                                    $show_edit = false;
                                                } else if ($this->session->userdata('profile_id') == 4 AND $event->event_assistance_type_id == 1) {
                                                    $show_edit = false;
                                                }
                                            }

                                            if ($show_edit) {
                                                ?>
                                                <div class="btn-group">
                                                    <a href='#' onclick='edit_Event(<?php echo $event->event_id; ?>)' class='btn btn-info dropdown-toggle btn-xs'><i  class='fa fa-pencil'></i> Editar </a>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>   

                                </td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

