<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3>Asignación de Encuesta</h3>

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
                            <div class="alert alert-info">
                                <?php
                                echo $this->session->flashdata('success');
                                ?>
                            </div>
                        <?php } ?>
                    </div>

                    <?php
                    echo form_open('event/store_AssignSurveyEvent', array('id' => 'assignSurveyEventForm'));
                    ?>
                    <input type="hidden" value="<?php echo $event[0]->event_id; ?>" name="event">


                    <table id="table-survey-events" class="table">
                        <thead>
                            <tr>
                                <th class="text-center">Pregunta</th>
                                <th class="text-center"><a onclick="addNewAssignSurveyEvent()"><span class="fa fa-plus-circle"></span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $position = 1;
                            if (count($questions) > 0) {
                                foreach ($questions as $question) {
                                    ?>
                                    <tr id="survey-row-<?php echo $position; ?>" class="survey-row">
                                        <td>
                                            <input type="hidden" class="form-control required-survey" name="edit_event_survey_id[]" value="<?php echo $question->event_survey_id ?>" required>
                                            <input type="text" class="form-control required-survey" name="edit_question[]" value="<?php echo $question->question ?>" required>
                                        </td>
                                        <td  class="text-center">
                                            <a href='#' onclick="removeEditRowSurveyEvent('survey-row-<?php echo $position; ?>',<?php echo $question->event_survey_id ?>)" class='btn btn-danger '><i  class='fa fa-trash-o'></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $position++;
                                }
                            } else {
                                ?>
                                <tr id="survey-row-<?php echo $position; ?>" class="survey-row">
                                    <td>
                                        <input type="text" class="form-control required-survey" name="question[]" value="" required>
                                    </td>
                                    <td></td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>

                    <div class = "form-group">
                        <div class = "col-md-12 col-md-offset-6">
                            <button type="button" onclick="store_AssignSurvey()" class="btn btn-primary">
                                Guardar
                            </button>
                        </div>
                    </div>

                    <?php
                    echo form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>