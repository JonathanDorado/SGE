
<div class="row">


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Declaración Tratamiento Datos Personales</h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <?php echo form_open('mycourses/store_habeas'); ?>
                    <div class="panel-body">

                        <div class="col-lg-12 text-center">
                            <br>
                            <h4>
                                Deseo autorizar al Consejo Colombiano de Seguridad para que dé a mis datos aquí recopilados 
                                el tratamiento señalado en la <a href="http://ccs.org.co/politica_privacidad/GC320_2013_PDF_HABEAS_DATA_CCS.pdf" target="_blank" alt="Política de Privacidad" title="Política de Privacidad">
                                    Política de Privacidad para el Tratamiento de Datos Personales</a> 
                                del Consejo Colombiano de Seguridad, el cual incluye, entre otras, 
                                el envío de información promocional, así como la invitación a eventos. 
                                El titular de los datos podrá, en cualquier momento, solicitar que la información 
                                sea modificada, actualizada o retirada de las bases de datos del Consejo Colombiano 
                                de Seguridad.
                            </h4>
                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-6 text-center">
                                <div class="radio">
                                    <label><input type="radio" checked class="radio-inline" name="habeas_data" value="1"> <b>Si, Estoy de Acuerdo</b></label>
                                </div>
                            </div>
                            <div class="col-lg-6 text-center">
                                <div class="radio">
                                    <label><input type="radio" class="radio-inline" name="habeas_data" value="0"> <b>No Estoy de Acuerdo</b></label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <button class="btn btn-primary">Guardar</button>
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