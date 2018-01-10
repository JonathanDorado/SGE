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
                    echo "<h2>Información de Proveedor</h2>";
                } else {
                    if (isset($provider)) {
                        echo "<h2>Edición de Proveedor</h2>";
                    } else {
                        echo "<h2>Nuevo Proveedor</h2>";
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
                    if (isset($provider)) {
                        echo form_open_multipart('providers/update', array('id' => 'editProviderForm'));
                        echo "<input type='hidden' value='" . $provider[0]->provider_id . "' name='provider_id'>";
                    } else {
                        echo form_open_multipart('providers/store', array('id' => 'newProviderForm'));
                    }
                    ?>

                    <div class="form-horizontal form-label-left" novalidate>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="provider_type">Tipo de Proveedor <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select <?php echo $disabled; ?> class="form-control col-md-7 col-xs-12 required-provider" id="provider_type" name="provider_type">
                                    <option value="">Selecciona...</option>
                                    <?php
                                    foreach ($provider_types as $provider_type) {
                                        if (isset($provider)) {
                                            if ($provider[0]->provider_type_id == $provider_type->provider_type_id) {
                                                echo "<option selected value='$provider_type->provider_type_id'>" . $provider_type->name . "</option>";
                                            } else {
                                                echo "<option value='$provider_type->provider_type_id'>" . $provider_type->name . "</option>";
                                            }
                                        } else {
                                            if (set_value('provider_type') == $provider_type->provider_type_id) {
                                                echo "<option selected value='$provider_type->provider_type_id'>" . $provider_type->name . "</option>";
                                            } else {
                                                echo "<option value='$provider_type->provider_type_id'>" . $provider_type->name . "</option>";
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
                                <input <?php echo $disabled; ?> id="name" type="text" class="form-control col-md-7 col-xs-12 required-provider" name="name" value="<?php echo (isset($provider)) ? $provider[0]->name : set_value('name'); ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lastname">Apellidos <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input <?php echo $disabled; ?> id="lastname" type="text" class="form-control col-md-7 col-xs-12 required-provider" name="lastname" value="<?php echo (isset($provider)) ? $provider[0]->lastname : set_value('lastname'); ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="document_type">Tipo de Documento Identidad <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select <?php echo $disabled; ?> class="form-control col-md-7 col-xs-12 required-provider" id="document_type" name="document_type">
                                    <option value="">Selecciona...</option>
                                    <?php
                                    foreach ($document_types as $document_type) {
                                        if (isset($provider)) {
                                            if ($provider[0]->document_type_id == $document_type->document_type_id) {
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
                                <input <?php echo $disabled; ?> id="document_number" type="text" class="form-control col-md-7 col-xs-12 required-provider integer" name="document_number" value="<?php echo (isset($provider)) ? $provider[0]->document_number : set_value('document_number'); ?>">
                                <input id="document_number_old" type="hidden" name="document_number_old" value="<?php echo (isset($provider)) ? $provider[0]->document_number : ""; ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_birthday">Fecha de Nacimiento <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class='input-group date'  >
                                    <input <?php echo $disabled; ?> readonly type='text' name="date_birthday" value="<?php echo (isset($provider)) ? $provider[0]->date_birthday : date("Y-m-d"); ?>" id="date_birthday" class="form-control datepicker col-md-7 col-xs-12 required-provider" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_start_ccs">Fecha de Ingreso CCS <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class='input-group date'  >
                                    <input <?php echo $disabled; ?> readonly type='text' name="date_start_ccs" value="<?php echo (isset($provider)) ? $provider[0]->date_start_ccs : date("Y-m-d"); ?>" id="date_start_ccs" class="form-control datepicker col-md-7 col-xs-12 required-provider" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="area">Área Responsable <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select <?php echo $disabled; ?> class="form-control col-md-7 col-xs-12 required-provider" id="area" name="area">
                                    <option value="">Selecciona...</option>
                                    <?php
                                    foreach ($areas as $area) {
                                        if (isset($provider)) {
                                            if ($provider[0]->area_id == $area->area_id) {
                                                echo "<option selected value='$area->area_id'>" . $area->name . "</option>";
                                            } else {
                                                echo "<option value='$area->area_id'>" . $area->name . "</option>";
                                            }
                                        } else {
                                            if (set_value('area') == $area->area_id) {
                                                echo "<option selected value='$area->area_id'>" . $area->name . "</option>";
                                            } else {
                                                echo "<option value='$area->area_id'>" . $area->name . "</option>";
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="thematic_area_type">Área Temática <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select <?php echo $disabled; ?> class="form-control col-md-7 col-xs-12 required-provider" id="thematic_area_type" name="thematic_area_type">
                                    <option value="">Selecciona...</option>
                                    <?php
                                    foreach ($thematic_area_types as $thematic_area_type) {
                                        if (isset($provider)) {
                                            if ($provider[0]->thematic_area_type_id == $thematic_area_type->thematic_area_type_id) {
                                                echo "<option selected value='$thematic_area_type->thematic_area_type_id'>" . $thematic_area_type->name . "</option>";
                                            } else {
                                                echo "<option value='$thematic_area_type->thematic_area_type_id'>" . $thematic_area_type->name . "</option>";
                                            }
                                        } else {
                                            if (set_value('thematic_area_type') == $thematic_area_type->thematic_area_type_id) {
                                                echo "<option selected value='$thematic_area_type->thematic_area_type_id'>" . $thematic_area_type->name . "</option>";
                                            } else {
                                                echo "<option value='$thematic_area_type->thematic_area_type_id'>" . $thematic_area_type->name . "</option>";
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="consultant_clasification">Clasificación Consultor <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select <?php echo $disabled; ?> class="form-control col-md-7 col-xs-12 required-provider" id="consultant_clasification" name="consultant_clasification">
                                    <option value="">Selecciona...</option>
                                    <?php
                                    foreach ($consultant_clasifications as $consultant_clasification) {
                                        if (isset($provider)) {
                                            if ($provider[0]->consultant_clasification_id == $consultant_clasification->consultant_clasification_id) {
                                                echo "<option selected value='$consultant_clasification->consultant_clasification_id'>" . $consultant_clasification->name . "</option>";
                                            } else {
                                                echo "<option value='$consultant_clasification->consultant_clasification_id'>" . $consultant_clasification->name . "</option>";
                                            }
                                        } else {
                                            if (set_value('consultant_clasification') == $consultant_clasification->consultant_clasification_id) {
                                                echo "<option selected value='$consultant_clasification->consultant_clasification_id'>" . $consultant_clasification->name . "</option>";
                                            } else {
                                                echo "<option value='$consultant_clasification->consultant_clasification_id'>" . $consultant_clasification->name . "</option>";
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url_img_profile">Foto Perfil </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <?php if (isset($provider)) { ?>
                                    <input name="url_img_profile_old" type="hidden" value="<?php echo $provider[0]->url_img_profile ?>" />
                                <?php } ?>
                                <input <?php echo $disabled; ?> id="url_img_profile" type="file" class="form-control" name="url_img_profile" onchange="imgProfileValidator(this.id, 1024, 200, 720, 200, 'error-img-ext', 'error-img-size')"/>
                                <div class="error-message error-img-ext">*Verifica la extensión del archivo</div>
                                <div class="error-message error-img-size">*Verifica el tamaño de la imagen</div>   
                            </div>
                            <?php
                            if (isset($provider)) {
                                if ($provider[0]->url_img_profile != "") {
                                    ?>
                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                        <a href="<?php echo base_url() . "uploads/providers/profile/" . $provider[0]->url_img_profile ?>" data-lightbox="example-1" class='btn btn-default example-image-link'>
                                            <i class='fa fa-eye'></i> 
                                        </a>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="notice-message">*Formato PNG, JPG o JPEG</div>
                                <div class="notice-message">*Tamaño Mín 200*300 - Máx 400*600</div>
                            </div>
                        </div>

                        <?php if ($disabled == "") { ?>
                            <div class = "form-group">
                                <div class = "col-md-6 col-md-offset-3">
                                    <?php if (!isset($provider)) {
                                        ?>
                                        <button type="button" onclick="store_NewProvider()" class="btn btn-primary">
                                            Guardar
                                        </button>
                                    <?php } else { ?>
                                        <button type="button" onclick="update_Provider()" class="btn btn-primary">
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