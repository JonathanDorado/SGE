<div class="pen-title">
    <img src="<?php echo base_url() ?>resources/img/logo_sge5.png"/>
</div>

<?php // echo form_open('login'); ?>
<!-- Form Module-->
<div class="module form-module">

    <div class="toggle"><i class="fa fa-times fa-pencil"></i>
        <div class="tooltip">Cambiar</div>
    </div>

    <div class="form">
        <h2>Acceder como usuario CCS</h2>
        <div style="display:none;" id="alert-ccs" class="alert alert-danger">
            <h5>Lo sentimos. Los datos que ingresaste no son correctos!</h5>
        </div>
        <input type="hidden" name="login_type" value="1"/>
        <input type="email" name="email" id="email" required  placeholder="Correo Electrónico"/>
        <div class="error-message error-email">*Ingresa un correo electrónico válido</div>
        <input type="password" name="password" id="password" required placeholder="Contraseña"/>
        <div class="error-message error-password">*Ingresa una contraseña</div>
        <button type="submit" onclick="validate(1)">Ingresar</button>
        <div class="forget-password">
            <a href="password" target="_blank">Recuperar mi contraseña</a>
        </div>
    </div>

    <div class="form">
        <h2>Acceder como Cliente CCS</h2>
        <div style="display:none;" id="alert-client" class="alert alert-danger">
            <h5>Lo sentimos. El número de identificación que ingresaste no se encuentra registrado!</h5>
        </div>
        <input type="hidden" name="login_type" value="2"/>
        <input type="text" name="document_number" id="document_number" required  placeholder="Número de Identificación"/>
        <div class="error-message error-document">*Ingresa un documento válido</div>
        <button onclick="validate(2)">Ingresar</button>
    </div>
</div>

<div class="pen-title">
    <img style="max-width: 7%;"  src="<?php echo base_url() ?>resources/img/ccs.png"/>
</div>