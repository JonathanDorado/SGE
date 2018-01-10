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
                    echo "<h2>Información de Usuario</h2>";
                } else {
                    if (isset($user)) {
                        echo "<h2>Edición de Usuario</h2>";
                    } else {
                        echo "<h2>Nuevo Usuario</h2>";
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
                    if (isset($user)) {
                        echo form_open('users/update', array('id' => 'editUserForm'));
                        echo "<input type='hidden' value='" . $user[0]->user_id . "' name='user_id'>";
                    } else {
                        echo form_open('users/store', array('id' => 'newUserForm'));
                    }
                    ?>
                    <div class="form-horizontal form-label-left" novalidate>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombres <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input <?php echo $disabled; ?> id="name" value="<?php echo (isset($user)) ? $user[0]->name : set_value('name'); ?>" class="form-control col-md-7 col-xs-12 required-user" name="name" type="text">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lastname">Apellidos <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input <?php echo $disabled; ?> id="lastname" type="text" class="form-control col-md-7 col-xs-12 required-user" name="lastname" value="<?php echo (isset($user)) ? $user[0]->lastname : set_value('lastname'); ?>">                                            
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Correo Electrónico <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input <?php echo $disabled; ?> id="email" type="email" class="form-control col-md-7 col-xs-12 required-user" name="email" value="<?php echo (isset($user)) ? $user[0]->email : set_value('email'); ?>">
                                <input id="email_old" type="hidden" name="email_old" value="<?php echo (isset($user)) ? $user[0]->email : "" ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="profile">Perfil <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select <?php echo $disabled; ?> class="form-control col-md-7 col-xs-12 required-user" id="profile" name="profile">
                                    <option value="">Selecciona...</option>
                                    <?php
                                    foreach ($profiles as $profile) {
                                        if (isset($user)) {
                                            if ($user[0]->profile_id == $profile->profile_id) {
                                                echo "<option selected value='$profile->profile_id'>" . $profile->name . "</option>";
                                            } else {
                                                echo "<option value='$profile->profile_id'>" . $profile->name . "</option>";
                                            }
                                        } else {

                                            if (set_value('profile') == $profile->profile_id) {
                                                echo "<option selected value='$profile->profile_id'>" . $profile->name . "</option>";
                                            } else {
                                                echo "<option value='$profile->profile_id'>" . $profile->name . "</option>";
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <?php if ($disabled == "") { ?>
                            <div class = "form-group">
                                <div class = "col-md-6 col-md-offset-3">
                                    <?php if (!isset($user)) {
                                        ?>
                                        <button type="button" onclick="store_NewUser()" class="btn btn-primary">
                                            Guardar
                                        </button>
                                    <?php } else { ?>
                                        <button type="button" onclick="update_User()" class="btn btn-primary">
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