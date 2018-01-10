
<div class="row">


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3>Encuesta de Evento</h3>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <h5>Por favor llena la siguiente encuesta para acceder a los contenidos del curso y descarga de certificados<br><br></h5>

                <?php echo form_open('mycourses/store_survey'); ?>
                <input type="hidden" value="<?php echo $event[0]->event_id ?>" name="event_id">
                <input type="hidden" value="<?php echo $event_client_id ?>" name="event_client_id">
                <div class="form-horizontal form-label-left" novalidate>

                    <?php foreach ($survey as $question) { ?>
                        <input type="hidden" value="<?php echo $question->event_survey_id ?>" name="event_survey_id[]">

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12"><?php echo $question->question ?>
                            </label>
                            <div class="col-md-2 col-sm-2 col-xs-4">
                                <select class='form-control' name=answers[]>
                                    <option value='10'>10</option>
                                    <option value='9'>9</option>
                                    <option value='8'>8</option>
                                    <option value='7'>7</option>
                                    <option value='6'>6</option>
                                    <option value='5'>5</option>
                                    <option value='4'>4</option>
                                    <option value='3'>3</option>
                                    <option value='2'>2</option>
                                    <option value='1'>1</option>
                                </select>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="comment">¿Tienes alguna observación sobre el evento? 
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <textarea rows="3" id="comment" value="" placeholder="Escribe tus observaciones..." name="comment" class="form-control col-md-7 col-xs-12"></textarea>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="improve">Cuentanos como podemos mejorar 
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <textarea rows="3" id="improve" value=""  placeholder="Escribe tus sugerencias..." name="improve" class="form-control col-md-7 col-xs-12"></textarea>
                        </div>
                    </div>

                    <div class = "form-group">
                        <div class = "col-md-7 col-md-offset-3">
                            <button type="submit" class="btn btn-primary">
                                Guardar
                            </button>
                        </div>
                    </div>

                </div>
                <?php
                echo form_close();
                ?>
            </div>
        </div>
    </div>
</div>