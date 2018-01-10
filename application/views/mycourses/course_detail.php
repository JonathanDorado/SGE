<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $event[0]->name; ?> <small>Detalle</small></h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                    <div class="profile_img">
                        <div id="crop-avatar">
                            <!-- Current avatar -->
                            <?php
                            if (isset($event_resources)) {
                                $img_logo = $event_resources[0]->url_logo_event;
                            } else {
                                $img_logo = "";
                            }
                            ?>
                            <img class="img-responsive avatar-view" src="<?php echo base_url() . "uploads/events/logo/" . $img_logo ?>">
                        </div>
                    </div>
                    <h3><?php echo $event[0]->name; ?></h3>



                    <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $event[0]->city; ?>
                        </li>
                        <li><i class="fa fa-calendar user-profile-icon"></i> <?php echo translateMonth(date("F", strtotime($event[0]->date_from))) . " " . date('d Y', strtotime($event[0]->date_from)); ?>
                        </li>

                        <li>
                            <i class="fa fa-briefcase user-profile-icon"></i> <?php echo $event[0]->event_type; ?>
                        </li>
                    </ul>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tab_memories" id="memories-tab" role="tab" data-toggle="tab" aria-expanded="true">Memorias</a>
                            </li>
                            <li role="presentation" class=""><a href="#tab_certificates" role="tab" id="certificates-tab" data-toggle="tab" aria-expanded="false">Certificados</a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_memories" aria-labelledby="home-tab">

                                <?php foreach ($memories as $memorie) { ?>
                                    <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                                        <div class="well profile_view">
                                            <div class="col-sm-12">
                                                <h4 class="brief"><i><?php echo $memorie->topic ?></i></h4>
                                                <div class="left col-xs-7">
                                                    <h3><?php echo $memorie->provider_name . " " . $memorie->provider_lastname; ?></h3>
                                                </div>
                                                <div class="right col-xs-5 text-center">
                                                    <?php
                                                    if ($memorie->url_img_profile != "") {
                                                        echo '<img class="img-circle img-responsive" src="' . base_url() . 'uploads/providers/profile/' . $memorie->url_img_profile . '" alt = "speaker img">';
                                                    } else {
                                                        echo '<img class="img-circle img-responsive" src="' . base_url() . 'resources/img/speaker_avatar.jpg" alt = "speaker img">';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 bottom text-center">

                                                <div class="col-xs-12 col-sm-6 emphasis">
                                                    <a href="<?php echo base_url() . "uploads/events/memories/" . $memorie->url_memories ?>" target="_blank" class='btn btn-success btn-xs'>
                                                        <i class="fa fa-download"> </i> Descargar
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="tab_certificates" aria-labelledby="home-tab">
                                <br>
                                <div class="form-horizontal form-label-left" novalidate>

                                    <div class="item form-group">
                                        <label class="control-label col-md-5 col-sm-5 col-xs-12">Certificado de Asistencia
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <a href='../mycourses/generateAssistanceCertificate?event_id=<?php echo $event[0]->event_id ?>&client_id=<?php echo $this->session->userdata('client_id') ?>&event_client_id=<?php echo $event_client_payment[0]->event_client_id ?>' target='_blank' class='btn btn-success btn-xs'>
                                                <i class="fa fa-download"> </i> Descargar
                                            </a>
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-md-5 col-sm-5 col-xs-12">Certificado de Curso
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <a href='../mycourses/generateCertificate?event_id=<?php echo $event[0]->event_id ?>&client_id=<?php echo $this->session->userdata('client_id') ?>&event_client_id=<?php echo $event_client_payment[0]->event_client_id ?>' target='_blank' class='btn btn-success btn-xs'>
                                                <i class="fa fa-download"> </i> Descargar
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>