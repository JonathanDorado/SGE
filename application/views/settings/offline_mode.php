<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="page-title">
            <div class="title_left">
                <h3>Modo Offline</h3>
            </div>
        </div>
        <div class="clearfix"></div>

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


        <?php if (MODE == "ONLINE") { ?>
        <!--<div class="row">-->
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h4>Sincronización de Datos</h4>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <?php echo form_open_multipart('settings/processOfflineData'); ?>
                    <div class="item form-group">
                        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="file">Adjunta el archivo descargado desde la versión Offline
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="offline_data" type="file" class="form-control col-md-7 col-xs-12" name="offline_data" value="" required>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <br>
                        <button type = "submit" id = "submit" class = "btn btn-success">
                            Procesar
                        </button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h4>Base de Datos Offline</h4>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php echo form_open('settings/backup_database'); ?>
                    <div class="item form-group">
                        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="file">Descarga la base de datos con los datos necesarios para el funcionamiento offline
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class = "form-group">
                                <div class = "col-md-6 col-md-offset-3">
                                    <button type = "submit" id = "submit" class = "btn btn-primary">
                                        Descargar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if (MODE == "OFFLINE") { ?>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h4>Exportar Datos</h4>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php echo form_open('settings/getDataOffline'); ?>
                        <div class="item form-group">
                            <label class="control-label col-md-6 col-sm-6 col-xs-12" for="file">Descarga el archivo txt con los datos almacenados de la versión offline
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class = "form-group">
                                    <div class = "col-md-6 col-md-offset-3">
                                        <button type = "submit" id = "submit" class = "btn btn-primary">
                                            Descargar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!--</div>-->
    </div>
</div>