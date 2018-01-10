<div class="pen-title">
    <img src="<?php echo base_url() ?>resources/img/logo_sge5.png"/>
</div>

<div class="module form-module">

    <div class="toggle"><i class="fa fa-times fa-arrow-left"></i>
    </div>

    <div class="form">
        <h2>Cambia tu contraseña</h2>
        <div class="notice-message">*La contraseña debe tener mínimo 8 caracteres</div>
        <input type="hidden" name="user_id" id="user_id" required value="<?php echo $user_id; ?>"/>
        <input type="password" name="password" id="password" required  placeholder="Nueva Contraseña"/>
        <div class="error-message error-password">*Debes ingresar una contraseña</div>
        <div class="error-message error-password-lenght">*La longitud debe ser mínimo 8 caracteres</div>
        <input type="password" name="confirm_password" id="confirm_password" required  placeholder="Confirma Contraseña"/>
        <div class="error-message error-confirm-password">*Debes ingresar de nuevo la contraseña</div>
        <div class="error-message error-confirm-password-match">*Las contraseñas no coinciden</div>
        <button onclick="changePassword()">Cambiar Contraseña</button>
    </div>
</div>

<div class="pen-title">
    <img style="max-width: 7%;"  src="<?php echo base_url() ?>resources/img/ccs.png"/>
</div>