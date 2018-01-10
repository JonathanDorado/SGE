
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="box box-primary">

                    <div class="panel-body">
                        <div class="col-lg-12">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Evento : </label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <h3>
                                    <?php echo $event[0]->name; ?>
                                </h3>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Fecha de Inicio : </label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <?php echo $event[0]->date_from; ?>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Fecha de Finalización :</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <?php echo $event[0]->date_until; ?>
                            </div>
                        </div>

                        <!--                        <div class="col-lg-12">
                                                    <div class="col-lg-3">
                                                        <button class="btn btn-success">Descargar Memorias</button>
                                                    </div>
                                                    <div class="col-lg-3">
                        
                                                        <a href='../event/generateCertificate?event_id=<?php echo $event[0]->event_id ?>&client_id=<?php echo $this->session->userdata('client_id') ?>' target='_blank'><button class="btn btn-info">Descargar Certificado</button></a>
                                                    </div>
                                                </div>-->

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b>Memorias</b></h3>
                        <br><br>
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <?php foreach ($memories as $memorie) { ?>
                                    <div class="panel-heading">
                                        <!--<a href="<?php echo base_url() . "uploads/events/memories/DEFINICION_DE_ACTORES.docx" ?>" target="_blank">-->
                                        <a href="<?php echo base_url() . "uploads/events/memories/" . $memorie->url_memories ?>" target="_blank">
                                            <b>
                                                <?php echo $memorie->topic ?>
                                                -
                                                <?php echo $memorie->provider_name . " " . $memorie->provider_lastname; ?>
                                            </b>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>  
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b>Certificados</b></h3>
                        <br><br>
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href='../event/generateCertificate?event_id=<?php echo $event[0]->event_id ?>&client_id=<?php echo $this->session->userdata('client_id') ?>' target='_blank'><b>Descargar Certificado</b></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>




