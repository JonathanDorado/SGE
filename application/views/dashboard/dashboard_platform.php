<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="page-title">
            <div class="title_left">
                <h3>Dashboard Plataforma</h3>
            </div>

            <?php if (in_array(DASHBOARD_EVENT, $this->session->userdata('permissions'))) { ?>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <select class="form-control" id="event_dashboard" name="event_dashboard">
                                <option value="">Selecciona un Evento...</option>
                                <?php
                                foreach ($events as $event) {
                                    echo "<option value='$event->event_id'>" . $event->name . "</option>";
                                }
                                ?>
                            </select>
                            <span class="input-group-btn">
                                <button class="btn btn-default" onclick="show_event_dashboard(1)" type="button">Ir</button>
                            </span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="clearfix"></div>

        <?php if (in_array(DASHBOARD_PLATFORM, $this->session->userdata('permissions'))) { ?>
            <div class="row">
                <div class="row top_tiles">
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-calendar"></i></div>
                            <div class="count"><?php echo $total_events[0]->total ?></div>
                            <br><h3>Eventos</h3>
                            <p>Registrados</p>
                        </div>
                    </div>

                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-user"></i></div>
                            <div class="count"><?php echo $total_clients[0]->total ?></div>
                            <br><h3>Clientes</h3>
                            <p>Registrados</p>
                        </div>
                    </div>

                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-truck"></i></div>
                            <div class="count"><?php echo $total_providers[0]->total ?></div>
                            <br><h3>Provedores</h3>
                            <p>Registrados</p>
                        </div>
                    </div>

                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-lock"></i></div>
                            <div class="count"><?php echo $total_users[0]->total ?></div>
                            <br><h3>Usuarios</h3>
                            <p>Registrados</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Eventos por Mes</h2>
                            <div class="filter" style="width: 17% !important">
                                <select id="resume_event_year" onchange="chargeResumeEvents(this.id)" style="width:200px" class="form-control" id="event_dashboard" name="event_dashboard">
                                    <?php
                                    for ($i = 2017; $i <= date('Y'); $i++) {
                                        if ($i == date('Y')) {
                                            echo "<option selected value='" . $i . "'>Mostrar Resumen " . $i . "</option>";
                                        } else {
                                            echo "<option value='" . $i . "'>Mostrar Resumen " . $i . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div>
                                    <div class="x_content">
                                        <div id="graph_events_by_month" style="height: 400px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
