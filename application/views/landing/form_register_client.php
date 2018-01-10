
<div class="row">
    <div class="col-md-12 text-center">
        Registrate en nuestra plataforma para inscribirte al evento<br><br>
    </div>

    <input id="event_id" type="hidden" name="event_id" value="<?php echo $event[0]->event_id; ?>"s>
    <div class="col-lg-12">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Nombres</label>
                <input id="name" type="text" class="form-control required-client-landing" name="name" value="<?php echo (isset($client)) ? $client[0]->name : set_value('name'); ?>" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Apellidos</label>
                <input id="lastname" type="text" class="form-control required-client-landing" name="lastname" value="<?php echo (isset($client)) ? $client[0]->lastname : set_value('lastname'); ?>" required>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Tipo de Documento Identidad</label>
                <select class="form-control required-client-landing" id="document_type" name="document_type" required>
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
        <div class="col-lg-6">
            <div class="form-group">
                <label>Número de Documento Identidad</label>
                <input id="document_number" type="text" class="form-control required-client-landing" name="document_number" value="<?php echo (isset($client)) ? $client[0]->document_number : set_value('document_number'); ?>" required>
            </div>
        </div>
    </div>

    <div class="col-lg-12">

        <div class="col-lg-6">
            <div class="form-group">
                <label>Teléfono Contacto</label>
                <input id="phone_number" type="text" class="form-control required-client-landing" name="phone_number" value="<?php echo (isset($client)) ? $client[0]->phone_number : set_value('phone_number'); ?>" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Celular Contacto</label>
                <input id="cellphone_number" type="text" class="form-control required-client-landing" name="cellphone_number" value="<?php echo (isset($client)) ? $client[0]->cellphone_number : set_value('cellphone_number'); ?>" required>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Dirección Contacto</label>
                <input id="address" type="text" class="form-control required-client-landing" name="address" value="<?php echo (isset($client)) ? $client[0]->address : set_value('address'); ?>" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Correo Electrónico</label>
                <input id="email" type="email" class="form-control required-client-landing" name="email" value="<?php echo (isset($client)) ? $client[0]->email : set_value('email'); ?>" required>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Empresa</label>
                <input id="company" type="text" class="form-control required-client-landing" name="company" value="<?php echo (isset($client)) ? $client[0]->company : set_value('company'); ?>" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Cargo</label>
                <input id="position" type="text" class="form-control required-client-landing" name="position" value="<?php echo (isset($client)) ? $client[0]->position : set_value('position'); ?>" required>
            </div>
        </div>
    </div>

    <div id="msg-error" class="col-lg-12 text-center" style="color: red;">
    </div>
    
    <div class="col-lg-12 text-center">
        <br><br><button type="submit" id="submit" onclick="store_ClientLanding()" class="btn btn-primary">
            Registrarme
        </button>
    </div>
</div>
<?php
echo form_close();
?>
                    

