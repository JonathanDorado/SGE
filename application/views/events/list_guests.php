<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="row">

                    <?php echo form_open_multipart('event/store_Guests',array('id' => 'masiveGuestForm')); ?>

                    <div class="form-horizontal form-label-left" novalidate>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file">Archivo a Importar <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="event_id" type="hidden" name="event_id" value="<?php echo $event[0]->event_id; ?>" required>
                                <input id="guests_file" type="file" onchange="uploadFileValidator(this.id, 'error-upload-guest-ext', 'required-masive-guest-file')" class="form-control col-md-7 col-xs-12 required-masive-guest" name="guests_file" value="" required>
                                <div class="error-message error-upload-guest-ext">*Verifica la extensión del archivo</div>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Importante </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label><b>** Máximo se permite importar 500 emails en un solo archivo.</b></label>
                            </div>
                        </div>

                        <div class = "form-group">
                            <div class = "col-md-6 col-md-offset-3">
                                <a href="<?php echo base_url() . "uploads/examples/Plantilla_inscripcion_invitados.xlsx" ?>" target = "_blank" class='btn btn-success'>
                                    <i class='fa fa-download'></i> 
                                    Descargar Plantilla 
                                </a>
                                <button onclick="store_MasiveGuests()" type="button" class="btn btn-primary">
                                    Procesar
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
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
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
                <table id="table-clients-invited" class="table table-stripe">
                    <thead>
                        <tr>
                            <th class="text-center">Correo Electrónico</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($guests as $guest) {
                            echo "<tr>" .
                            "<td class='text-center'>" . $guest->email . "</td>" .
                            "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


