
<section class="content-header">
    <h1>
        Registro
        <small>Notas</small>
    </h1>
    <!--    <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>-->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="box box-primary">
                    <div class="panel-body">
                        <div class="row">
                            <div class="box-header with-border">
                                <h3 class="box-title">Evento <b><?php echo $event[0]->name; ?></b></h3>
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

                            <?php echo form_open_multipart('event/store_Guests'); ?>
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <br><label>Archivo a Importar</label>
                                        <input type="hidden" class="form-control" name="event_id" value="<?php echo $event[0]->event_id; ?>" required>
                                        <input id="score_file" type="file" class="form-control" name="guests_file" value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <a href="<?php echo base_url() . "uploads/examples/Plantilla_registro_notas.xlsx"; ?>" target = "_blank">
                                        <span class = "fa fa-download"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label><b>** Solo se registraran las notas de los usuarios inscritos en la plataforma.</b></label>
                            </div>

                            <div class="col-lg-12">
                                <div class="col-lg-6 text-right">
                                    <button type="submit" id="submit" class="btn btn-primary">
                                        Procesar
                                    </button>
                                </div>
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
                    <div class="panel-body">
                        <div class="row">

                            <div class="box-header with-border">
                                <h3 class="box-title"><b>Lista de Notas</b></h3>
                            </div>

                            <div class="col-lg-12">
                                <div class="table-responsive"> 
                                    <table id="table-clients-invited" class="table table-stripe">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Nombres</th>
                                                <th class="text-center">Apellidos</th>
                                                <th class="text-center">Nota</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
//                                            foreach ($guests as $guest) {
//                                                echo "<tr>" .
//                                                "<td class='text-center'>" . $guest->email . "</td>" .
//                                                "</tr>";
//                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>




