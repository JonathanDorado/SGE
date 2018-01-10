<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3>Asignación de Temáticas</h3>

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

                    <div class="col-lg-12">
                        <?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert alert-success">
                                <?php
                                echo $this->session->flashdata('success');
                                ?>
                            </div>
                        <?php } ?>
                    </div>

                    <?php echo form_open_multipart('event/store_AssignTopicsEvent', array('id' => 'assignTopicsEventForm')) ?>                      
                    <input type="hidden" value="<?php echo $event[0]->event_id; ?>" name="event">


                    <div class="item form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label><b>**Importante: Las memorias de cada instructor deben estar incluidas en un solo archivo comprimido .ZIP o .RAR</b></label>
                        </div>
                    </div>

                    <table id="table-assign-topics-events" class="table">
                        <thead>
                            <tr>
                                <th class="text-center">Temática</th>
                                <th class="text-center">Instructor</th>
                                <th class="text-center">Fecha y Hora</th>
                                <th class="text-center">Memorias</th>
                                <th class="text-center"></th>
                                <th class="text-center"><a onclick="addNewAssignTopicEvent()"><span class="fa fa-plus-circle"></span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $position = 1;
                            if (count($existent_topics) > 0) {
                                foreach ($existent_topics as $existent_topic) {
                                    ?>
                                    <tr id="assign-topics-row-<?php echo $position; ?>" class="assign-topics-row">
                                        <td class="text-center">
                                            <input type="hidden" class="form-control required-assign-topics" name="edit_event_topic_id[]" value="<?php echo $existent_topic->event_topic_id ?>" required>
                                            <select class="form-control required-assign-topics" onchange="chargeInstructorsByTopic(this.id, <?php echo $position; ?>)" id="training-<?php echo $position; ?>" name="edit_topic[]">
                                                <option thematic_area_type="" value="">Selecciona...</option>
                                                <?php
                                                foreach ($topics as $topic) {
                                                    if ($existent_topic->topic_id == $topic->topic_id) {
                                                        echo "<option selected thematic_area_type='$topic->thematic_area_type_id' value='$topic->topic_id'>" . $topic->name . "</option>";
                                                    } else {
                                                        echo "<option thematic_area_type='$topic->thematic_area_type_id' value='$topic->topic_id'>" . $topic->name . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <select class="form-control required-assign-topics" id="instructor-<?php echo $position; ?>" name="edit_instructor[]">
                                                <option value="">Selecciona...</option>
                                                <?php
                                                foreach ($providers as $provider) {
                                                    if ($existent_topic->thematic_area_type_id == $provider->thematic_area_type_id) {
                                                        if ($existent_topic->provider_id == $provider->provider_id) {
                                                            echo "<option selected value='$provider->provider_id'>" . $provider->name . "</option>";
                                                        } else {
                                                            echo "<option value='$provider->provider_id'>" . $provider->name . "</option>";
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <fieldset>
                                                <div class="control-group">
                                                    <div class="controls">
                                                        <div class="input-prepend input-group">
                                                            <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                                            <input readonly="" type="text" name="edit_date_hour[]" class="form-control required-assign-topics datetimepicker" value="<?php echo $existent_topic->date_hour ?>" id="date-hour-<?php echo $position; ?>" />

                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!--<input style="width:100px" class="form-control required-assign-topics integer datetimepicker" value="<?php echo $existent_topic->total_hours ?>" id="total-hours-<?php echo $position; ?>" name="edit_total_hours[]">-->
                                        </td>
                                        <td class="text-center">
                                            <input type="file" class="form-control" id="memories-<?php echo $position; ?>" onchange="memoriesValidator(this.id, 'error-memories-ext-<?php echo $position; ?>')" name ="edit_memories[]">
                                            <div class="error-message error-memories-ext-<?php echo $position; ?>">*Verifica la extensión del archivo</div>
                                        </td>
                                        <td class="text-center">
                                            <a href='<?php echo base_url() . "uploads/events/memories/" . $existent_topic->url_memories ?>' class='btn btn-success dropdown-toggle btn-sm'><i  class='fa fa-download'></i> Descargar </a>
                                        </td>
                                        <td class="text-center">
                                            <a href='#' onclick="removeEditRowTopicEvent('assign-topics-row-<?php echo $position; ?>',<?php echo $existent_topic->event_topic_id ?>)" class='btn btn-danger dropdown-toggle btn-sm'><i  class='fa fa-trash-o'></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $position++;
                                }
                            } else {
                                ?>
                                <tr id = "assign-topics-row-<?php echo $position; ?>" class = "assign-topics-row">
                                    <td class="text-center">
                                        <select class = "form-control required-assign-topics" onchange = "chargeInstructorsByTopic(this.id, <?php echo $position; ?>)" id = "training-<?php echo $position; ?>" name = "topic[]">
                                            <option thematic_area_type = "" value = "">Selecciona...</option>
                                            <?php
                                            foreach ($topics as $topic) {
                                                echo "<option thematic_area_type='$topic->thematic_area_type_id' value='$topic->topic_id'>" . $topic->name . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <select class="form-control required-assign-topics" id="instructor-<?php echo $position; ?>" name="instructor[]">
                                            <option value="">Selecciona...</option>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <fieldset>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <div class="input-prepend input-group">
                                                        <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                                        <input readonly="" type="text" name="date_hour[]" id="date-hour-<?php echo $position; ?>" class="form-control required-assign-topics datetimepicker" value="<?php echo date("Y/m/d H:i"); ?>" />

                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </td>
                                    <td class="text-center">
                                        <input type="file" class="form-control required-assign-topics" onchange="memoriesValidator(this.id, 'error-memories-ext-<?php echo $position; ?>')" id="memories-<?php echo $position; ?>" name="memories[]">
                                        <div class="error-message error-memories-ext-<?php echo $position; ?>">*Verifica la extensión del archivo</div>
                                    </td>
                                    <td class="text-center"></td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>

                    <div class = "form-group">
                        <div class = "col-md-12 col-md-offset-6">
                            <button type="button" onclick="store_AssignTopics()" class="btn btn-primary">
                                Guardar
                            </button>
                        </div>
                    </div>
                    <?php echo form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>