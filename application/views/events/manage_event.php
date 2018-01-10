
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Gestión de Evento </h2>
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
                <div class="clearfix">
                </div>

            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-lg-12">
                        <?php if ($this->session->flashdata('error')) { ?>
                            <div class="alert alert-danger alert-dismissible fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>Whoops!</strong> <?php echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php } ?>
                    </div>

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

                <div class="row">

                    <?php
                    $active_guests = "";
                    $active_preregister = "";
                    $active_confirmation = "";
                    $active_assistance = "";
                    $active_content_guests = "";
                    $active_content_preregister = "";
                    $active_content_confirmation = "";
                    $active_content_assistance = "";
                    switch ($manage_event_action) {
                        case "guests":
                            $active_tab_guests = "active";
                            $active_content_guests = "in active";
                            break;
                        case "preregister":
                            $active_tab_preregister = "active";
                            $active_content_preregister = " in active";
                            break;
                        case "confirmation":
                            $active_tab_confirmation = "active";
                            $active_content_confirmation = "fade in active";
                            break;
                        case "assistance":
                            $active_tab_assistance = "active";
                            $active_content_assistance = "fade in active";
                            break;
                    }
                    ?>

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <?php
                            $permissions_guest = array(INVITE_EVENT);
                            if (array_intersect($permissions_guest, $this->session->userdata('permissions'))) {
                                ?>
                                <li role="presentation" class='<?php echo $active_tab_guests; ?>'><a href="#tab-guests" onclick="list_Guests(<?php echo $event[0]->event_id ?>);" id="guests-tab" role="tab" data-toggle="tab" aria-expanded="true">Invitados</a></li>
                                <?php
                            }
                            $permissions_preregister = array(PRE_REGISTER_EVENT);
                            if (array_intersect($permissions_preregister, $this->session->userdata('permissions'))) {
                                ?>
                                <li role="presentation" class='<?php echo $active_tab_preregister; ?>'><a href="#tab-preregister" onclick="list_Clients(<?php echo $event[0]->event_id ?>);" id="preregister-tab" role="tab" data-toggle="tab" aria-expanded="true">Pre-registro</a></li>
                                <?php
                            }
                            $permissions_confirmed = array(CONFIRM_EVENT);
                            if (array_intersect($permissions_confirmed, $this->session->userdata('permissions'))) {
                                ?>
                                <li role="presentation" class='<?php echo $active_tab_confirmation; ?>'><a href="#tab-confirmation" onclick="list_PreregisteredClients(<?php echo $event[0]->event_id ?>);" role="tab" id="confirmation-tab" data-toggle="tab" aria-expanded="false">Confirmación</a></li>
                                <?php
                            }
                            $permissions_assistance = array(ASSISTANCE_EVENT);
                            if (array_intersect($permissions_assistance, $this->session->userdata('permissions'))) {
                                ?>
                                <li role="presentation" class='<?php echo $active_tab_assistance; ?>'><a href="#tab-assistance" onclick="list_ConfirmedClients(<?php echo $event[0]->event_id ?>);" role="tab" id="assistance-tab" data-toggle="tab" aria-expanded="false">Asistencia</a></li>
                            <?php } ?>    
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <?php
                            $permissions_guest = array(INVITE_EVENT);
                            if (array_intersect($permissions_guest, $this->session->userdata('permissions'))) {
                                ?>
                                <div role="tabpanel" class="tab-pane <?php echo $active_content_guests; ?>" id="tab-guests" aria-labelledby="guests-tab">
                                    <div id="result_list_guests"></div>
                                </div>
                                <?php
                            }
                            $permissions_preregister = array(PRE_REGISTER_EVENT);
                            if (array_intersect($permissions_preregister, $this->session->userdata('permissions'))) {
                                ?>
                                <div role="tabpanel" class="tab-pane <?php echo $active_content_preregister; ?>" id="tab-preregister" aria-labelledby="preregister-tab">
                                    <div id="result_list_preregister"></div>
                                </div>
                                <?php
                            }
                            $permissions_confirmed = array(CONFIRM_EVENT);
                            if (array_intersect($permissions_confirmed, $this->session->userdata('permissions'))) {
                                ?>
                                <div role="tabpanel" class="tab-pane <?php echo $active_content_confirmation; ?>" id="tab-confirmation" aria-labelledby="confirmation-tab">
                                    <div id="result_list_confirmation"></div>
                                </div>
                                <?php
                            }
                            $permissions_assistance = array(ASSISTANCE_EVENT);
                            if (array_intersect($permissions_assistance, $this->session->userdata('permissions'))) {
                                ?>
                                <div role="tabpanel" class="tab-pane <?php echo $active_content_assistance; ?>" id="tab-assistance" aria-labelledby="assistance-tab">
                                    <div id="result_list_assistance"></div>
                                </div>
                            <?php } ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/jquery/dist/jquery.min.js"></script>
<script>
                                    $(document).ready(function () {
                                        var manage_event_action = '<?php echo $manage_event_action; ?>';
                                        switch (manage_event_action) {
                                            case 'guests':
                                                list_Guests(<?php echo $event[0]->event_id ?>);
                                                break;
                                            case 'preregister':
                                                list_Clients(<?php echo $event[0]->event_id ?>);
                                                break;
                                            case 'confirmation':
                                                list_PreregisteredClients(<?php echo $event[0]->event_id ?>);
                                                break;
                                            case 'assistance':
                                                list_ConfirmedClients(<?php echo $event[0]->event_id ?>);
                                                break;
                                        }
                                    });

</script>