<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="row">

                    <?php echo form_open_multipart('event/store_MasivePreRegister', array('id' => 'masivePreregisterForm')); ?>
                    <input type="hidden" name="event_id" value="<?php echo $event[0]->event_id; ?>">

                    <div class="form-horizontal form-label-left" novalidate>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file">Archivo a Importar <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="masive_preregister_file" onchange="uploadFileValidator(this.id, 'error-upload-preregister-ext', 'required-masive-preregister-file')" type="file" class="form-control col-md-7 col-xs-12 required-masive-preregister" name="masive_preregister_file" value="" required>
                                <div class="error-message error-upload-preregister-ext">*Verifica la extensión del archivo</div>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Importante </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label><b>**  Tenga en cuenta que solo los usuarios con identificación registrada serán asociados al evento, en caso de no existir deben ser creados por el módulo de clientes.</b></label>
                            </div>
                        </div>

                        <div class = "form-group">
                            <div class = "col-md-6 col-md-offset-3">
                                <a href="<?php echo base_url() . "uploads/examples/Plantilla_preregistro_masivo.xlsx"; ?>" target = "_blank" class='btn btn-success'>
                                    <i class='fa fa-download'></i> 
                                    Descargar Plantilla 
                                </a>
                                 <button onclick="store_MasivePreregister()" type="button" class="btn btn-primary">
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
                <table id="table-clients-preregister" class="table table-stripe">
                    <thead>
                        <tr>
                            <th class="text-center">Identificación</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Apellido</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Empresa</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center">Pre-registrar</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($clients as $client) {
                            $checked = ($client->preregister == 0) ? '' : 'checked';

                            switch ($client->state_client) {
                                case 2:
                                    if ($this->session->userdata('user_id') != $client->created_by_user_id) {
                                        $disabled = 'disabled';
                                        $tooltip = 'El cliente esta siendo gestionado por otro usuario';
                                    } else {
                                        $disabled = '';
                                        $tooltip = '';
                                    }

                                    break;
                                case 3:
                                    $disabled = 'disabled';
                                    $tooltip = 'El usuario ya fue confirmado';
                                    break;

                                case 5:
                                    $disabled = 'disabled';
                                    $tooltip = 'El usuario se encuentra como asistente de evento';
                                    break;
                                default:
                                    $disabled = '';
                                    $tooltip = '';
                            }
                            echo "<tr >" .
                            "<td class='text-center'>" . $client->document_number . "</td>" .
                            "<td class='text-center'>" . $client->name . "</td>" .
                            "<td class='text-center'>" . $client->lastname . "</td>" .
                            "<td class='text-center'>" . $client->email . "</td>" .
                            "<td class='text-center'>" . $client->company . "</td>" .
                            "<td class='text-center' >" . $client->position . "</td>" .
                            "<td class='text-center'><input " . $disabled . " type='checkbox' id='client_" . $client->client_id . "' onchange='addClientToEvent(" . $event[0]->event_id . "," . $client->client_id . ")' $checked value=''></td>";
                            if ($tooltip != '') {
                                echo "<td class='text-center'><span class='fa fa-info-circle' data-toggle='tooltip' data-placement='left' title='$tooltip'></span></td>";
                            } else {
                                echo "<td></td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>