<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3>Confirmación de Cliente</h3>

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
                </div>

                <?php
                if (isset($event_client_payment)) {
                    if ($event_client_payment[0]->isPaid != 1) {
                        ?>
                        <div class="col-lg-12">
                            <div class="alert alert-danger">
                                <strong>¡Atención! El cliente aún no registra pago</strong>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <div class="row">
                    <div class="form-horizontal form-label-left" novalidate>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label"><?php echo $client[0]->name . " " . $client[0]->lastname; ?></label>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de Documento
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label"><?php echo $client[0]->document_type; ?></label>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Número de Documento
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label"><?php echo $client[0]->document_number; ?></label>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">País de Origen
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label"><?php echo $client[0]->country_citizenship; ?></label>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ciudad de Origen
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label"><?php echo $client[0]->city_citizenship; ?></label>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono de Contacto
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label"><?php echo $client[0]->phone_number; ?></label>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Celular de Contacto
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label"><?php echo $client[0]->cellphone_number; ?></label>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Correo Electrónico
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label"><?php echo $client[0]->email; ?></label>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Dirección de Contacto
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label"><?php echo $client[0]->address; ?></label>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Empresa
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label"><?php echo $client[0]->company; ?></label>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Cargo
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label"><?php echo $client[0]->position; ?></label>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de Persona
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label"><?php echo $client[0]->person_type; ?></label>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de Cliente
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label"><?php echo $client[0]->client_type; ?></label>
                            </div>
                        </div>


                        <?php
                        if (isset($event_client_payment)) {
                            echo form_open_multipart('event/update_ConfirmationClient', array('id' => 'editConfirmationForm'));
                            echo '<input type = "hidden" name = "event_client_payment_id" value = "' . $event_client_payment[0]->event_client_payment_id . '">';
                        } else {
                            echo form_open_multipart('event/store_ConfirmationClient', array('id' => 'newConfirmationForm'));
                        }
                        ?> 
                        <input type="hidden" name="event_client_id" value="<?php echo $event_client_id; ?>">
                        <input type="hidden" name="event_id" value="<?php echo $event[0]->event_id; ?>">
                        <input type="hidden" name="client_id" value="<?php echo $client[0]->client_id; ?>">
                        <input type="hidden" id="event_type" name="event_type" value="<?php echo $event[0]->event_type_id; ?>">

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 " for="payment_type">¿Quién Paga?<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select onchange="setupInfoPayment(this.id)" class="form-control col-md-7 col-xs-12 required-confirmation-client" id="payment_type" required name="payment_type">
                                    <option value="">Selecciona...</option>
                                    <?php
                                    foreach ($payment_types as $payment_type) {
                                        if (isset($event_client_payment)) {
                                            if ($event_client_payment[0]->payment_type_id == $payment_type->payment_type_id) {
                                                echo "<option selected value='$payment_type->payment_type_id'>" . $payment_type->name . "</option>";
                                            } else {
                                                echo "<option value='$payment_type->payment_type_id'>" . $payment_type->name . "</option>";
                                            }
                                        } else {
                                            echo "<option value='$payment_type->payment_type_id'>" . $payment_type->name . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 " for="payment_method">Método de Pago<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12 required-confirmation-client" id="payment_method" required name="payment_method">
                                    <option value="">Selecciona...</option>
                                    <?php
                                    foreach ($payment_methods as $payment_method) {
                                        $show_option = true;
                                        if ($event[0]->state_id == 6) {
                                            if ($this->session->userdata('profile_id') != 8) {
                                                if ($payment_method->payment_method_id == 1 OR $payment_method->payment_method_id == 2 OR $payment_method->payment_method_id == 3 OR $payment_method->payment_method_id == 4) {
                                                    $show_option = false;
                                                }
                                            }
                                        }

                                        if ($show_option) {
                                            if (isset($event_client_payment)) {
                                                if ($event_client_payment[0]->payment_method_id == $payment_method->payment_method_id) {
                                                    echo "<option selected value='$payment_method->payment_method_id'>" . $payment_method->name . "</option>";
                                                } else {
                                                    echo "<option value='$payment_method->payment_method_id'>" . $payment_method->name . "</option>";
                                                }
                                            } else {
                                                echo "<option value='$payment_method->payment_method_id'>" . $payment_method->name . "</option>";
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                                <?php
                                if ($event[0]->state_id == 6) {
                                    if ($this->session->userdata('profile_id') != 8) {
                                        ?>
                                        <div style="display: block !important;" class="error-message">*Pagos en Efectivo, Cheque, Tarjeta Crédito o Débito deben ser remitidos a tesorería</div>
                                        <?php
                                    }
                                }
                                ?>

                            </div>
                        </div>

                        <?php
                        $show_arl = "none";
                        $required_arl = "";
                        $show_nit_company = "none";
                        $required_nit_company = "";
                        if (isset($event_client_payment)) {
                            switch ($event_client_payment[0]->payment_type_id) {
                                case '1':
                                    $show_arl = "block";
                                    $required_arl = "required-confirmation-client";
                                    break;
                                case '4':
                                    $show_nit_company = "block";
                                    $required_nit_company = "required-confirmation-client";
                                    break;
                            }
                        }
                        ?>

                        <div class="item form-group item-nit-company item-payment" style="display:<?php echo $show_nit_company; ?>">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="isCompanyPaying_nit_company">Nit de Empresa que Paga <span class="required">*</span> <br> (Sin dígito de verificación)
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type='text' class="form-control integer col-md-7 col-xs-12 set-input-payment <?php echo $required_nit_company; ?>" id="isCompanyPaying_nit_company" required value="<?php echo (isset($event_client_payment)) ? $event_client_payment[0]->isCompanyPaying_nit_company : set_value('isCompanyPaying_nit_company') ?>" name="isCompanyPaying_nit_company"  />
                            </div>
                        </div>

                        <div class="item form-group item-arl item-payment" style="display:<?php echo $show_arl; ?>">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="isArlPaying_arl_id">ARL que realiza el pago <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12 set-input-payment <?php echo $required_arl; ?>" id="isArlPaying_arl_id" required name="isArlPaying_arl_id" id="isArlPaying_arl_id">
                                    <option value="">Selecciona...</option>
                                    <?php
                                    foreach ($arls as $arl) {
                                        if (isset($event_client_payment)) {
                                            if ($event_client_payment[0]->isArlPaying_arl_id == $arl->arl_id) {
                                                echo "<option selected value='$arl->arl_id'>" . $arl->name . "</option>";
                                            } else {
                                                echo "<option value='$arl->arl_id'>" . $arl->name . "</option>";
                                            }
                                        } else {
                                            echo "<option value='$arl->arl_id'>" . $arl->name . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Valor a Cancelar <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class='input-group'  >
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-usd"></span>
                                    </span>
                                    <input type='text' id="price" required value="<?php echo (isset($event_client_payment)) ? $event_client_payment[0]->price : set_value('price') ?>" name="price" class="form-control integer col-md-7 col-xs-12 required-confirmation-client" />
                                </div>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pagado <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?php
                                if (isset($event_client_payment)) {
                                    if ($event_client_payment[0]->isPaid == 1) {
                                        ?>
                                        <label class="radio-inline"><input  type="radio" name="isPaid" value="1" checked>Si</label>
                                        <label class="radio-inline"><input  type="radio" name="isPaid" value="0" >No</label>
                                    <?php } else {
                                        ?>
                                        <label class="radio-inline"><input  type="radio" name="isPaid" value="1">Si</label>
                                        <label class="radio-inline"><input  type="radio" name="isPaid" value="0" checked>No</label>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <label class = "radio-inline"><input type = "radio" name = "isPaid" value = "1">Si</label>
                                    <label class = "radio-inline"><input type = "radio" name = "isPaid" value = "0" checked>No</label>
                                <?php }
                                ?>
                            </div>
                        </div>

                        <?php
                        if (isset($event_client_payment)) {
                            if ($event_client_payment[0]->isPaid == 1) {
                                ?>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Fecha de Pago
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input disabled class="form-control integer col-md-7 col-xs-12" type="text" value="<?php echo $event_client_payment[0]->paid_date ?>">
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <input type="hidden" value="<?php echo (isset($event_client_payment)) ? $event_client_payment[0]->paid_date : date('Y-m-d') ?>" name="paid_date" id="paid_date">

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="invoice_code">Codigo de Factura <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="hidden" value="<?php echo $invoice_code ?>" name="invoice_code" id="invoice_code">
                                <img src="<?php echo $invoice_qr; ?>" alt="" class="img-responsive" height="200" width="200">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="comment">Observaciones 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea rows="5" id="comment" value="" name="comment" class="form-control col-md-7 col-xs-12"><?php echo (isset($event_client_payment)) ? $event_client_payment[0]->comment : set_value('comment') ?></textarea>
                            </div>
                        </div>


                        <?php if ($event[0]->event_type_id == 2) {//Macroevento   ?>
                            <div class="ln_solid"></div>

                            <div class="item form-group">
                                <div class="col-md-1 col-sm-1 col-xs-12">
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label><b>Selecciona los cursos a los que el cliente asistirá.</b></label>
                                </div>
                            </div>

                            <div class = "form-group">
                                <div class="col-md-1 col-sm-1 col-xs-12">
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label><b>Temática</b></label>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <label class="control-label">Fecha</label> 
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <label class="control-label">Hora</label> 
                                </div>
                            </div>
                            <?php foreach ($event_topics as $event_topic) { ?>

                                <div class = "form-group">
                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?php
                                        $checked = "";
                                        foreach ($event_client_topics as $event_topic_client) {
                                            if ($event_topic_client->event_topic_id == $event_topic->event_topic_id) {
                                                $checked = "checked";
                                            }
                                        }
                                        ?>
                                        <input <?php echo $checked; ?> class="chk-event-topic-client" type="checkbox" name="event_client_topics[]" value="<?php echo $event_topic->event_topic_id ?>" /> <label class="control-label"><?php echo $event_topic->topic; ?></label> 
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                        <label class="control-label"><?php echo translateMonth(date("F", strtotime($event_topic->date_hour))) . " " . date('d Y', strtotime($event_topic->date_hour)); ?></label> 
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                        <label class="control-label"><?php echo date('H:i A', strtotime($event_topic->date_hour)); ?></label> 
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>

                        <div class = "form-group">
                            <div class = "col-md-6 col-md-offset-3">
                                <?php if (!isset($event_client_payment)) {
                                    ?>
                                    <button type="button" onclick="store_ConfirmationClient()" class="btn btn-primary">
                                        Guardar
                                    </button>
                                <?php } else { ?>
                                    <button type="button" onclick="update_ConfirmationClient()" class="btn btn-primary">
                                        Actualizar
                                    </button>
                                <?php }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>