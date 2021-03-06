<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <?php
                if (isset($event)) {
                    echo "<h2>";
                    if (isset($only_read)) {
                        echo "Información de Evento";
                    } else {
                        echo "Edición de Evento";
                    }
                    echo "<small>" . $event[0]->name . "</small></h2>";
                } else {
                    echo "<h2>Nuevo Evento</h2>";
                }
                ?>
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

                <div class="row">
                    <div class="col-lg-12">
                        <?php if (validation_errors() != false or $this->session->flashdata('error')) { ?>
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> Hay algunos errores en el formulario.<br><br>
                                <ul>
                                    <?php echo validation_errors(); ?>
                                </ul>
                                <ul>
                                    <?php
                                    echo $this->session->flashdata('error');
                                    ?>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div id="form_event_wizard" class="form_wizard wizard_horizontal">   
                    <?php
                    $disable_info = '';
                    $disable_design = '';
                    $disable_score = '';
                    $disable_projections = '';
                    if (isset($only_read)) {
                        $disable_info = 'disabled';
                        $disable_design = 'disabled';
                        $disable_score = 'disabled';
                        $disable_projections = 'disabled';
                    } else {
                        $permissions_info = array(CREATE_PRESENTIAL_EVENT, CREATE_VIRTUAL_EVENT);
                        if (!array_intersect($permissions_info, $this->session->userdata('permissions'))) {
                            $disable_info = 'disabled';
                        }
                        $permissions_design = array(ADD_DESIGN_EVENT);
                        if (!array_intersect($permissions_design, $this->session->userdata('permissions'))) {
                            $disable_design = 'disabled';
                        }
                        $permissions_score = array(ADD_SCORE_EVENT);
                        if (!array_intersect($permissions_score, $this->session->userdata('permissions'))) {
                            $disable_score = 'disabled';
                        }
                        $permissions_projection = array(ADD_PROJECTION_EVENT);
                        if (!array_intersect($permissions_projection, $this->session->userdata('permissions'))) {
                            $disable_projections = 'disabled';
                        }
                    }

                    if (isset($event)) {
                        echo "<input type='hidden' value='" . $event[0]->event_id . "' name='event_id'>";
                    }

                    if (isset($step_selected)) {
                        echo "<input type='hidden' id='step_selected' value='" . $step_selected . "'>";
                    } else {
                        echo "<input type='hidden' id='step_selected' value='0'>";
                    }
                    ?>

                    <ul class="wizard_steps">
                        <li>
                            <a href="#step-1">
                                <span class="step_no">1</span>
                                <span class="step_descr">
                                    Información General<br />
                                    <!--<small>Step 4 description</small>-->
                                </span>
                            </a>
                        </li>
                        <?php if (isset($event)) { ?>
                            <li>
                                <a href="#step-2">
                                    <span class="step_no">2</span>
                                    <span class="step_descr">
                                        Artes<br />
                                        <!--<small>Step 4 description</small>-->
                                    </span>
                                </a>
                            </li>
                            <?php
                        }

                        if (isset($event)) {
                            ?>
                            <li>
                                <a href="#step-3">
                                    <span class="step_no">3</span>
                                    <span class="step_descr">
                                        Certificación<br />
                                    </span>
                                </a>
                            </li>
                            <?php
                        }

                        if (isset($event)) {
                            ?>
                            <li>
                                <a href="#step-4">
                                    <span class="step_no">4</span>
                                    <span class="step_descr">
                                        Proyección Evento<br />
                                        <!--<small>Step 4 description</small>-->
                                    </span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                    <div id="step-1">
                        <?php echo form_open('event/store', array('id' => 'EventForm')); ?>
                        <div class="form-horizontal form-label-left">

                            <?php
                            if (isset($event)) {
                                echo "<input type='hidden' value='" . $event[0]->event_id . "' name='event_id'>";
                            }
                            ?>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre Evento</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input <?php echo $disable_info; ?> id="name" type="text" class="form-control col-md-7 col-xs-12 required-step-1 required-event" name="name" value="<?php echo (isset($event)) ? $event[0]->name : set_value('name'); ?>" autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date">Fecha de Realización</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <fieldset>
                                        <div class="control-group">
                                            <div class="controls">
                                                <div class="input-prepend input-group">
                                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                                    <input readonly="" <?php echo $disable_info; ?> type="text" style="width: 200px" name="date" id="date" class="form-control required-step-1 datepicker-range required-event" value="<?php echo (isset($event)) ? $event[0]->date_from : date("Y/m/d"); ?> - <?php echo (isset($event)) ? $event[0]->date_until : date("Y/m/d"); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_assistance_type">Tipo Asistencia</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select <?php echo $disable_info; ?> class="form-control col-md-7 col-xs-12 required-step-1 required-event" id="event_assistance_type" name="event_assistance_type">
                                        <option value="">Selecciona...</option>
                                        <?php
                                        foreach ($event_assistance_types as $event_assistance_type) {
                                            $show_option = true;
                                            if ($this->session->userdata('profile_id') == 3) {
                                                if ($event_assistance_type->event_assistance_type_id == 3) {
                                                    $show_option = false;
                                                }
                                            } else if ($this->session->userdata('profile_id') == 4) {
                                                if ($event_assistance_type->event_assistance_type_id == 1) {
                                                    $show_option = false;
                                                }
                                            }

                                            if ($show_option) {
                                                if (isset($event)) {
                                                    if ($event[0]->event_assistance_type_id == $event_assistance_type->event_assistance_type_id) {
                                                        echo "<option selected value='$event_assistance_type->event_assistance_type_id'>" . $event_assistance_type->name . "</option>";
                                                    } else {
                                                        echo "<option value='$event_assistance_type->event_assistance_type_id'>" . $event_assistance_type->name . "</option>";
                                                    }
                                                } else {
                                                    if (set_value('event_assistance_type') == $event_assistance_type->event_assistance_type_id) {
                                                        echo "<option selected value='$event_assistance_type->event_assistance_type_id'>" . $event_assistance_type->name . "</option>";
                                                    } else {
                                                        echo "<option value='$event_assistance_type->event_assistance_type_id'>" . $event_assistance_type->name . "</option>";
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_audience_type">Dirigido a:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select <?php echo $disable_info; ?> class="form-control col-md-7 col-xs-12 required-step-1 required-event" id="event_audience_type" name="event_audience_type">
                                        <option value="">Selecciona...</option>
                                        <?php
                                        foreach ($event_audience_types as $event_audience_type) {
                                            if (isset($event)) {
                                                if ($event[0]->event_audience_type_id == $event_audience_type->event_audience_type_id) {
                                                    echo "<option selected value='$event_audience_type->event_audience_type_id'>" . $event_audience_type->name . "</option>";
                                                } else {
                                                    echo "<option value='$event_audience_type->event_audience_type_id'>" . $event_audience_type->name . "</option>";
                                                }
                                            } else {
                                                if (set_value('event_audience_type') == $event_audience_type->event_audience_type_id) {
                                                    echo "<option selected value='$event_audience_type->event_audience_type_id'>" . $event_audience_type->name . "</option>";
                                                } else {
                                                    echo "<option value='$event_audience_type->event_audience_type_id'>" . $event_audience_type->name . "</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_type">Tipo Evento</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select <?php echo $disable_info; ?> class="form-control col-md-7 col-xs-12 required-step-1 required-event" id="event_type" name="event_type">
                                        <option value="">Selecciona...</option>
                                        <?php
                                        foreach ($event_types as $event_type) {
                                            if (isset($event)) {
                                                if ($event[0]->event_type_id == $event_type->event_type_id) {
                                                    echo "<option selected value='$event_type->event_type_id'>" . $event_type->name . "</option>";
                                                } else {
                                                    echo "<option value='$event_type->event_type_id'>" . $event_type->name . "</option>";
                                                }
                                            } else {
                                                if (set_value('event_type') == $event_type->event_type_id) {
                                                    echo "<option selected value='$event_type->event_type_id'>" . $event_type->name . "</option>";
                                                } else {
                                                    echo "<option value='$event_type->event_type_id'>" . $event_type->name . "</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>    
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="training_platform">Plataforma de Capacitación</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select <?php echo $disable_info; ?> class="form-control col-md-7 col-xs-12 required-step-1 required-event" id="training_platform" name="training_platform">
                                        <option value="">Selecciona...</option>
                                        <?php
                                        foreach ($training_platforms as $training_platform) {
                                            $show_option = true;
                                            if ($this->session->userdata('profile_id') == 3) {
                                                if ($training_platform->training_platform_id == 1 or $training_platform->training_platform_id == 2) {
                                                    $show_option = false;
                                                }
                                            } else if ($this->session->userdata('profile_id') == 4) {
                                                if ($training_platform->training_platform_id == 3) {
                                                    $show_option = false;
                                                }
                                            }

                                            if ($show_option) {
                                                if (isset($event)) {
                                                    if ($event[0]->training_platform_id == $training_platform->training_platform_id) {
                                                        echo "<option selected value='$training_platform->training_platform_id'>" . $training_platform->name . "</option>";
                                                    } else {
                                                        echo "<option value='$training_platform->training_platform_id'>" . $training_platform->name . "</option>";
                                                    }
                                                } else {
                                                    if (set_value('training_platform') == $training_platform->training_platform_id) {
                                                        echo "<option selected value='$training_platform->training_platform_id'>" . $training_platform->name . "</option>";
                                                    } else {
                                                        echo "<option value='$training_platform->training_platform_id'>" . $training_platform->name . "</option>";
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city">Ciudad del Evento</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select <?php echo $disable_info; ?> class="form-control col-md-7 col-xs-12 required-step-1 required-event" id="city" name="city">
                                        <option value="">Selecciona...</option>
                                        <?php
                                        foreach ($cities as $city) {
                                            if (isset($event)) {
                                                if ($event[0]->city_id == $city->city_id) {
                                                    echo "<option selected value='$city->city_id'>" . $city->name . "</option>";
                                                } else {
                                                    echo "<option value='$city->city_id'>" . $city->name . "</option>";
                                                }
                                            } else {
                                                if (set_value('city') == $city->city_id) {
                                                    echo "<option selected value='$city->city_id'>" . $city->name . "</option>";
                                                } else {
                                                    echo "<option value='$city->city_id'>" . $city->name . "</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="place">Lugar del Evento</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input <?php echo $disable_info; ?> id="place" type="text" class="form-control col-md-7 col-xs-12 required-step-1 required-event" name="place" value="<?php echo (isset($event)) ? $event[0]->place : set_value('place'); ?>" autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total_hours_event">Duración Total del Evento (Horas)</label>
                                <div class="col-md-2 col-sm-2 col-xs-4">
                                    <input <?php echo $disable_info; ?> id="total_hours_event" type="text" class="form-control col-md-7 col-xs-12 required-step-1 integer required-event" name="total_hours_event" value="<?php echo (isset($event)) ? $event[0]->total_hours : set_value('total_hours_event'); ?>" autofocus>
                                </div>
                            </div>

                            <?php if ($disable_info == "") { ?>
                                <div class = "form-group">
                                    <div class = "col-md-6 col-md-offset-3">
                                        <button type="button" onclick="store_Event()" class="btn btn-primary">
                                            <?php if (!isset($event)) {
                                                ?>
                                                Guardar
                                            <?php } else { ?>
                                                Actualizar
                                            <?php }
                                            ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <?php echo form_close(); ?>
                    </div>

                    <?php if (isset($event)) { ?>
                        <div id="step-2">

                            <?php
                            echo form_open_multipart('event/store_resources', array('id' => 'EventResourcesForm'));

                            if (isset($event)) {
                                echo "<input type='hidden' value='" . $event[0]->event_id . "' name='event_id'>";
                                if (isset($event_resources)) {
                                    echo "<input type='hidden' value='" . $event_resources[0]->event_resource_id . "' name='event_resource_id'>";
                                    echo "<input type='hidden' value='2' id='event_resource_action' name='event_resource_action'>";
                                } else {
                                    echo "<input type='hidden' value='1' id='event_resource_action' name='event_resource_action'>";
                                }
                            }
                            ?>

                            <div class="form-horizontal form-label-left">
                                <?php
                                if (!isset($event_resources)) {
                                    echo '<div class="alert alert-danger col-md-12 col-sm-12 col-xs-12">Aún no se han configurado los artes para este evento</div>';
                                }
                                ?>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url_logo_event">Logo Evento </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <?php if (isset($event_resources)) { ?>
                                            <input name="url_logo_event_old" type="hidden" value="<?php echo $event_resources[0]->url_logo_event ?>" />
                                        <?php } ?>
                                        <input <?php echo $disable_design; ?> id="url_logo" type="file" class="form-control required-resource-event" name="url_logo_event" onchange="imageValidator(this.id, 2000, 300, 2000, 300, 'error-logo-event-ext', 'error-logo-event-size')"/>
                                        <div class="error-message error-logo-event-ext">*Verifica la extensión del archivo</div>
                                        <div class="error-message error-logo-event-size">*Verifica el tamaño de la imagen</div>   
                                    </div>
                                    <?php if (isset($event_resources)) { ?>
                                        <div class="col-md-1 col-sm-1 col-xs-12">
                                            <a href="<?php echo base_url() . "uploads/events/logo/" . $event_resources[0]->url_logo_event ?>" data-lightbox="example-1" class='btn btn-default example-image-link'>
                                                <i class='fa fa-eye'></i> 
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="notice-message">*Formato PNG, JPG o JPEG</div>
                                        <div class="notice-message">*Tamaño Mín 300*300</div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url_template_certificate">Plantilla de Diploma </label>
                                    <div class="col-md-4 col-sm-4 col-xs-8">
                                        <?php if (isset($event_resources)) { ?>
                                            <input name="url_template_certificate_old" type="hidden" value="<?php echo $event_resources[0]->url_template_certificate ?>" />
                                        <?php } ?>
                                        <input <?php echo $disable_design; ?> id="url_template_certificate" type="file" class="form-control required-resource-event" name="url_template_certificate" onchange="imageValidator(this.id, 2000, 700, 2000, 700, 'error-certificate-ext', 'error-certificate-size')"/>
                                        <div class="error-message error-certificate-ext">*Verifica la extensión del archivo</div>
                                        <div class="error-message error-certificate-size">*Verifica el tamaño de la imagen</div>   
                                    </div>
                                    <?php if (isset($event_resources)) { ?>
                                        <div class="col-md-1 col-sm-1 col-xs-12">
                                            <a href="<?php echo base_url() . "uploads/events/certificate/" . $event_resources[0]->url_template_certificate ?>" data-lightbox="example-1" class='btn btn-default example-image-link'>
                                                <i class='fa fa-eye'></i> 
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-3 col-sm-3 col-xs-4">
                                        <div class="notice-message">*Formato PNG, JPG o JPEG</div>
                                        <div class="notice-message">*Tamaño Mín 700*700</div>
                                    </div>
                                </div>

                                <?php
                                $checked_default = "";
                                $checked_yes = "";
                                $checked_no = "";
                                $img_landing_disabled = "disabled";
                                $class_landing_required = "";
                                if (isset($event_resources)) {
                                    if ($event_resources[0]->isLandingRequired == 0) {
                                        $checked_yes = "";
                                        $checked_no = "checked";
                                        $img_landing_disabled = "disabled";
                                    } else {
                                        $checked_yes = "checked";
                                        $checked_no = "";
                                        $img_landing_disabled = "";
                                        $class_landing_required = "required-resource-event-edit";
                                    }
                                } else {
                                    $checked_default = "checked";
                                }
                                ?>

                                <div class = "form-group">
                                    <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "chk_landing_page">Generar Landing Page </label>
                                    <div class = "col-md-4 col-sm-4 col-xs-8">
                                        <label class="radio-inline"><input <?php echo $disable_design . " " . $checked_yes; ?> type="radio" onclick="setLandingPageFile(1)" id="isLandingRequired" name="isLandingRequired" value="1">Si</label>
                                        <label class="radio-inline"><input <?php echo $disable_design . " " . $checked_no . " " . $checked_default; ?> type="radio" onclick="setLandingPageFile(0)" name="isLandingRequired" value="0">No</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url_logo_landing">Imagen Landing Page</label>
                                    <div class="col-md-4 col-sm-4 col-xs-8">
                                        <?php if (isset($event_resources)) { ?>
                                            <input name="url_logo_landing_old" type="hidden" value="<?php echo $event_resources[0]->url_logo_landing ?>" />
                                        <?php } ?>
                                        <input <?php echo $disable_design . " " . $img_landing_disabled; ?> id="url_logo_landing" type="file" class="form-control" name="url_logo_landing" onchange="imageValidator(this.id, 2000, 700, 2000, 700, 'error-landing-ext', 'error-landing-size')"/>
                                        <div class="error-message error-landing-ext">*Verifica la extensión del archivo</div>
                                        <div class="error-message error-landing-size">*Verifica el tamaño de la imagen</div>   
                                    </div>
                                    <?php if ($img_landing_disabled == "") { ?>
                                        <div class="col-md-1 col-sm-1 col-xs-12">
                                            <a href="<?php echo base_url() . "uploads/events/landing/" . $event_resources[0]->url_logo_landing ?>" data-lightbox="example-1" class='btn btn-default example-image-link'>
                                                <i class='fa fa-eye'></i> 
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-3 col-sm-3 col-xs-4">
                                        <div class="notice-message">*Formato PNG, JPG o JPEG</div>
                                        <div class="notice-message">*Tamaño Mín 700*700</div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="landing_description">Descripción del Evento</label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <!--<textarea rows="3" id="comment" value="" name="comment" class="form-control col-md-7 col-xs-12"><?php echo (isset($event_client_payment)) ? $event_client_payment[0]->comment : set_value('comment') ?></textarea>-->

                                        <textarea maxlength="1000" rows="3" <?php echo $disable_design . " " . $img_landing_disabled; ?> id="landing_description" class="form-control col-md-7 col-xs-12 <?php echo $class_landing_required; ?>" name="landing_description" autofocus><?php echo (isset($event_resources)) ? $event_resources[0]->landing_description : set_value('landing_description'); ?></textarea>
                                    </div>
                                </div>

                                <?php
                                if (isset($event_resources)) {
                                    if ($event_resources[0]->isLandingRequired == 1) {
                                        ?>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url_landing">URL Landing Page</label>
                                            <div class="col-md-4 col-sm-4 col-xs-8">
                                                <label class="control-label text-landing"> <a href="<?php echo 'http://' . IP_SERVER . '/sge/landing?id=' . $event_resources[0]->event_id; ?>" target="_blank"> <?php echo 'http://' . IP_SERVER . '/sge/landing?id=' . $event_resources[0]->event_id; ?></a></label>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                                <?php if ($disable_design == "") { ?>
                                    <div class = "form-group">
                                        <div class = "col-md-6 col-md-offset-3">
                                            <?php if (!isset($event_resources)) {
                                                ?>
                                                <button type="button" onclick="store_EventResources(1)" class="btn btn-primary">
                                                    Guardar
                                                </button>
                                            <?php } else { ?>
                                                <button type="button" onclick="store_EventResources(2)" class="btn btn-primary">
                                                    Actualizar
                                                </button>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                        <?php
                    }

                    if (isset($event)) {
                        ?>

                        <div id="step-3">
                            <?php
                            echo form_open('event/store_score', array('id' => 'EventScoreForm'));

                            if (isset($event)) {
                                echo "<input type='hidden' value='" . $event[0]->event_id . "' name='event_id'>";
                                if (isset($event_scores)) {
                                    echo "<input type='hidden' value='" . $event_scores[0]->event_score_id . "' name='event_score_id'>";
                                }
                            }

                            $checked_yes = "";
                            $checked_no = "";
                            $checked_default = "";
                            if (isset($event_scores)) {
                                if ($event_scores[0]->isScoreRequired == 0) {
                                    $checked_yes = "";
                                    $checked_no = "checked";
                                } else {
                                    $checked_yes = "checked";
                                    $checked_no = "";
                                }
                            } else {
                                $checked_default = "checked";
                            }
                            ?>

                            <div class="form-horizontal form-label-left">
                                <?php
                                if (!isset($event_scores)) {
                                    echo '<div class="alert alert-danger col-md-12 col-sm-12 col-xs-12">Aún no se han configurado las calificaciones para este evento</div>';
                                }
                                ?>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="score">Generar Diploma por Calificación</label>
                                    <div class="col-md-4 col-sm-4 col-xs-8">
                                        <label class="radio-inline"><input <?php echo $disable_score . " " . $checked_yes . " " . $checked_default; ?> type="radio" onclick="setScore(1)" name="isScoreRequired" value="1" checked>Si</label>
                                        <label class="radio-inline"><input <?php echo $disable_score . " " . $checked_no; ?> type="radio" name="isScoreRequired" onclick="setScore(0)" value="0" >No</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="score_assistance">Calificación Mínima Asistencia (%)</label>
                                    <div class="col-md-2 col-sm-2 col-xs-4">
                                        <input <?php echo $disable_score; ?> id="score_assistance" type="text" class="form-control col-md-7 col-xs-12 required-step-3 float required-event" name="score_assistance" value="<?php echo (isset($event_scores)) ? $event_scores[0]->score_assistance : set_value('score_assistance'); ?>" autofocus>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="score_attention">Calificación Mínima Atención (%)</label>
                                    <div class="col-md-2 col-sm-2 col-xs-4">
                                        <input <?php echo $disable_score; ?> id="score_attention" type="text" class="form-control col-md-7 col-xs-12 required-step-3 float required-event" name="score_attention" value="<?php echo (isset($event_scores)) ? $event_scores[0]->score_attention : set_value('score_attention'); ?>" autofocus>
                                    </div>
                                </div>

                                <?php if ($disable_score == "") { ?>
                                    <div class = "form-group">
                                        <div class = "col-md-6 col-md-offset-3">
                                            <button type="button" onclick="store_EventScores()" class="btn btn-primary">
                                                <?php if (!isset($event_scores)) {
                                                    ?>
                                                    Guardar
                                                <?php } else { ?>
                                                    Actualizar
                                                <?php }
                                                ?>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                            <?php echo form_close(); ?>
                        </div>
                        <?php
                    }

                    if (isset($event)) {
                        ?>

                        <div id="step-4">
                            <?php
                            echo form_open('event/store_projection', array('id' => 'EventProjectionForm'));

                            if (isset($event)) {
                                echo "<input type='hidden' value='" . $event[0]->event_id . "' name='event_id'>";
                                if (isset($event_projections)) {
                                    echo "<input type='hidden' value='" . $event_projections[0]->event_projection_id . "' name='event_projection_id'>";
                                }
                            }
                            ?>

                            <div class="form-horizontal form-label-center">
                                <?php
                                if (!isset($event_projections)) {
                                    echo '<div class="alert alert-danger col-md-12 col-sm-12 col-xs-12">Aún no se han configurado las proyecciones para este evento</div>';
                                }
                                ?>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="projected_guests">Cantidad Clientes Invitados</label>
                                    <div class="col-md-2 col-sm-2 col-xs-4">
                                        <input <?php echo $disable_projections; ?> id="projected_guests" type="text" class="form-control col-md-7 col-xs-12 required-step-4 integer required-event" name="projected_guests" value="<?php echo (isset($event_projections)) ? $event_projections[0]->projected_guests : set_value('projected_guests'); ?>" autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="projected_guests">Cantidad Clientes Pre-registrados</label>
                                    <div class="col-md-2 col-sm-2 col-xs-4">
                                        <input <?php echo $disable_projections; ?> id="projected_pre_registered" type="text" class="form-control col-md-7 col-xs-12 required-step-4 integer required-event" name="projected_pre_registered" value="<?php echo (isset($event_projections)) ? $event_projections[0]->projected_pre_registered : set_value('projected_pre_registered'); ?>" autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="projected_guests">Cantidad Clientes Confirmados</label>
                                    <div class="col-md-2 col-sm-2 col-xs-4">
                                        <input <?php echo $disable_projections; ?> id="projected_confirmed" type="text" class="form-control col-md-7 col-xs-12 required-step-4 integer required-event" name="projected_confirmed" value="<?php echo (isset($event_projections)) ? $event_projections[0]->projected_confirmed : set_value('projected_confirmed'); ?>" autofocus>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="projected_assistants">Cantidad Clientes Aistentes</label>
                                    <div class="col-md-2 col-sm-2 col-xs-4">
                                        <input <?php echo $disable_projections; ?> id="projected_assistants" type="text" class="form-control col-md-7 col-xs-12 required-step-4 integer required-event" name="projected_assistants" value="<?php echo (isset($event_projections)) ? $event_projections[0]->projected_assistants : set_value('projected_assistants'); ?>" autofocus>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="projected_new_clients">Cantidad Clientes Nuevos (Día del Evento)</label>
                                    <div class="col-md-2 col-sm-2 col-xs-4">
                                        <input <?php echo $disable_projections; ?> id="projected_new_clients" type="text" class="form-control col-md-7 col-xs-12 required-step-4 integer required-event" name="projected_new_clients" value="<?php echo (isset($event_projections)) ? $event_projections[0]->projected_new_clients : set_value('projected_new_clients'); ?>" autofocus>
                                    </div>
                                </div>

                                <?php if ($disable_projections == "") { ?>
                                    <div class = "form-group">
                                        <div class = "col-md-6 col-md-offset-3">
                                            <button type="button" onclick="store_EventProjections()" class="btn btn-primary">
                                                <?php if (!isset($event_projections)) {
                                                    ?>
                                                    Guardar
                                                <?php } else { ?>
                                                    Actualizar
                                                <?php }
                                                ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</div>









