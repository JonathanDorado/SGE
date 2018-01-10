<div class="pen-title">
    <img src="<?php echo base_url() ?>resources/img/logo_sge5.png"/>
</div>

<?php // echo form_open('login'); ?>
<!-- Form Module-->
<div class="module form-module">

    <div class="toggle"><i class="fa fa-times fa-arrow-left"></i>
    </div>

    <div class="form">
        <h2>Ingresa tu correo electrónico</h2>
        <div style="display:none;" id="alert-reset-password" class="alert alert-danger">
            <h5>Lo sentimos. El correo electrónico que ingresaste no se encuentra registrado!</h5>
        </div>
        <input type="email" name="email" id="email" required  placeholder="Correo Electrónico"/>
        <div class="error-message error-email">*Ingresa un correo electrónico válido</div>
        <button onclick="resetPassword()">Restaurar Contraseña</button>
    </div>
</div>

<div class="pen-title">
    <img style="max-width: 7%;"  src="<?php echo base_url() ?>resources/img/ccs.png"/>
</div>