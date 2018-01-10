<?php
if (isset($only_read)) {//If it is only read
    $disabled = "disabled";
} else {
    $disabled = "";
}
?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <?php
                if (isset($only_read)) {
                    echo "<h2>Información de Cliente</h2>";
                } else {
                    if (isset($user)) {
                        echo "<h2>Edición de Cliente</h2>";
                    } else {
                        echo "<h2>Nuevo Cliente</h2>";
                    }
                }
                ?>

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
                    <?php
                    if (isset($client)) {
                        echo form_open('clients/update', array('id' => 'editClientForm'));
                        echo "<input type='hidden' value='" . $client[0]->client_id . "' name='client_id'>";
                    } else {
                        echo form_open('clients/store', array('id' => 'newClientForm'));
                    }
                    ?>

                    <div class="form-horizontal form-label-left" novalidate>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="person_type">Tipo de Persona <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select <?php echo $disabled; ?> class="form-control col-md-7 col-xs-12 required-client" id="person_type" name="person_type">
                                    <option value="">Selecciona...</option>
                                    <?php
                                    foreach ($person_types as $person_type) {
                                        if (isset($client)) {
                                            if ($client[0]->person_type_id == $person_type->person_type_id) {
                                                echo "<option selected value='$person_type->person_type_id'>" . $person_type->name . "</option>";
                                            } else {
                                                echo "<option value='$person_type->person_type_id'>" . $person_type->name . "</option>";
                                            }
                                        } else {
                                            if (set_value('person_type') == $person_type->person_type_id) {
                                                echo "<option selected value='$person_type->person_type_id'>" . $person_type->name . "</option>";
                                            } else {
                                                echo "<option value='$person_type->person_type_id'>" . $person_type->name . "</option>";
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="client_type">Tipo de Cliente <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select <?php echo $disabled; ?> class="form-control col-md-7 col-xs-12 required-client" id="client_type" name="client_type">
                                    <option value="">Selecciona...</option>
                                    <?php
                                    foreach ($client_types as $client_type) {
                                        if (isset($client)) {
                                            if ($client[0]->client_type_id == $client_type->client_type_id) {
                                                echo "<option selected value='$client_type->client_type_id'>" . $client_type->name . "</option>";
                                            } else {
                                                echo "<option value='$client_type->client_type_id'>" . $client_type->name . "</option>";
                                            }
                                        } else {
                                            if (set_value('client_type') == $client_type->client_type_id) {
                                                echo "<option selected value='$client_type->client_type_id'>" . $client_type->name . "</option>";
                                            } else {
                                                echo "<option value='$client_type->client_type_id'>" . $client_type->name . "</option>";
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombres <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input <?php echo $disabled; ?> id="name" value="<?php echo (isset($client)) ? $client[0]->name : set_value('name'); ?>" class="form-control col-md-7 col-xs-12 required-client" name="name" type="text">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lastname">Apellidos <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input <?php echo $disabled; ?> id="lastname" type="text" class="form-control col-md-7 col-xs-12 required-client" name="lastname" value="<?php echo (isset($client)) ? $client[0]->lastname : set_value('lastname'); ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="document_type">Tipo de Documento Identidad <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select <?php echo $disabled; ?> class="form-control col-md-7 col-xs-12 required-client" id="document_type" name="document_type">
                                    <option value="">Selecciona...</option>
                                    <?php
                                    foreach ($document_types as $document_type) {
                                        if (isset($client)) {
                                            if ($client[0]->document_type_id == $document_type->document_type_id) {
                                                echo "<option selected value='$document_type->document_type_id'>" . $document_type->name . "</option>";
                                            } else {
                                                echo "<option value='$document_type->document_type_id'>" . $document_type->name . "</option>";
                                            }
                                        } else {
                                            if (set_value('document_type') == $document_type->document_type_id) {
                                                echo "<option selected value='$document_type->document_type_id'>" . $document_type->name . "</option>";
                                            } else {
                                                echo "<option value='$document_type->document_type_id'>" . $document_type->name . "</option>";
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="document_number">Número de Identificación <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input <?php echo $disabled; ?> id="document_number" type="text" class="form-control col-md-7 col-xs-12 required-client integer" name="document_number" value="<?php echo (isset($client)) ? $client[0]->document_number : set_value('document_number'); ?>">
                                <input id="document_number_old" type="hidden" name="document_number_old" value="<?php echo (isset($client)) ? $client[0]->document_number : ""; ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country_citizenship">País de Origen (Nacionalidad) <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select <?php echo $disabled; ?> class="form-control col-md-7 col-xs-12 required-client" onchange="chargeCitiesByCountry(this.id)" id="country_citizenship" name="country_citizenship">
                                    <option value="">Selecciona...</option>
                                    <?php
                                    foreach ($countries as $country) {
                                        if (isset($client)) {
                                            if ($client[0]->country_code == $country->country_code) {
                                                echo "<option selected value='$country->country_code'>" . $country->name . "</option>";
                                            } else {
                                                echo "<option value='$country->country_code'>" . $country->name . "</option>";
                                            }
                                        } else {
                                            if (set_value('country_citizenship') == $country->country_code) {
                                                echo "<option selected value='$country->country_code'>" . $country->name . "</option>";
                                            } else {
                                                echo "<option value='$country->country_code'>" . $country->name . "</option>";
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city_citizenship">Ciudad de Origen <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select <?php echo $disabled; ?> class="form-control col-md-7 col-xs-12 required-client" id="city_citizenship" name="city_citizenship">
                                    <option value="">Selecciona...</option>
                                    <?php
                                    if (isset($client)) {
                                        foreach ($cities as $city) {
                                            if ($client[0]->city_id_citizenship == $city->city_id) {
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

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Correo Electrónico <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input <?php echo $disabled; ?> id="email" type="email" class="form-control col-md-7 col-xs-12 required-client" name="email" value="<?php echo (isset($client)) ? $client[0]->email : set_value('email'); ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone_number">Teléfono Contacto <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input <?php echo $disabled; ?> id="phone_number" type="text" class="form-control col-md-7 col-xs-12 required-client" name="phone_number" value="<?php echo (isset($client)) ? $client[0]->phone_number : set_value('phone_number'); ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cellphone_number">Celular Contacto <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input <?php echo $disabled; ?> id="cellphone_number" type="text" class="form-control col-md-7 col-xs-12 required-client" name="cellphone_number" value="<?php echo (isset($client)) ? $client[0]->cellphone_number : set_value('cellphone_number'); ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Dirección Contacto <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input <?php echo $disabled; ?> id="address" type="text" class="form-control col-md-7 col-xs-12 required-client" name="address" value="<?php echo (isset($client)) ? $client[0]->address : set_value('address'); ?>">
                                <!--                                <div class="notice-message">**Dirección de la Empresa</div>
                                                                <div class="notice-message">**Dirección de la Casa</div>-->
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-4">
                                <div style="display:none" class="notice-message address-home address">*Dirección Residencia</div>
                                <div style="display:none" class="notice-message address-work address">*Dirección Empresa</div>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company">Empresa <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input <?php echo $disabled; ?> id="company" type="text" class="form-control col-md-7 col-xs-12 required-client" name="company" value="<?php echo (isset($client)) ? $client[0]->company : set_value('company'); ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="position">Cargo <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input <?php echo $disabled; ?> id="position" type="text" class="form-control col-md-7 col-xs-12 required-client" name="position" value="<?php echo (isset($client)) ? $client[0]->position : set_value('position'); ?>">
                            </div>
                        </div>

                        <?php if ($disabled == "") { ?>
                            <div class = "form-group">
                                <div class = "col-md-6 col-md-offset-3">
                                    <?php if (!isset($client)) {
                                        ?>
                                        <button type="button" onclick="store_NewClient()" class="btn btn-primary">
                                            Guardar
                                        </button>
                                    <?php } else { ?>
                                        <button type="button" onclick="update_Client()" class="btn btn-primary">
                                            Actualizar
                                        </button>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php
                    echo form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
if (!isset($client)) {
    ?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Creación Masiva de Clientes</h2>

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

                        <?php echo form_open_multipart('clients/store_Masive',array('id' => 'masiveClientsForm')); ?>

                        <div class="form-horizontal form-label-left" novalidate>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file">Archivo a Importar <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="masive_clients_file" type="file" onchange="uploadClientsValidator(this.id, 'error-upload-client-ext')" class="form-control col-md-7 col-xs-12 required-masive-client" name="masive_clients_file" required>
                                    <div class="error-message error-upload-client-ext">*Verifica la extensión del archivo</div>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Importante </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label><b>** Tenga en cuenta que si el usuario ya se encuentra registrado, su información será actualizada con los datos registrados en el archivo adjunto</b></label>
                                </div>
                            </div>

                            <div class = "form-group">
                                <div class = "col-md-6 col-md-offset-3">
                                    <a href="<?php echo base_url() . "uploads/examples/Plantilla_clientes_masivo.xlsx"; ?>" target = "_blank" class='btn btn-success'>
                                        <i class='fa fa-download'></i> 
                                        Descargar Plantilla 
                                    </a>
                                    <button onclick="store_MasiveClient()" type="button" class="btn btn-primary">
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
<?php } ?>


