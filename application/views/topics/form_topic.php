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
                    echo "<h2>Información de Temática</h2>";
                } else {
                    if (isset($user)) {
                        echo "<h2>Edición de Temática</h2>";
                    } else {
                        echo "<h2>Nueva Temática</h2>";
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
                    if (isset($topic)) {
                        echo form_open('topics/update', array('id' => 'editTopicForm'));
                        echo "<input type='hidden' value='" . $topic[0]->topic_id . "' name='topic_id'>";
                    } else {
                        echo form_open('topics/store', array('id' => 'newTopicForm'));
                    }
                    ?>

                    <div class="form-horizontal form-label-left" novalidate>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre Temática <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input <?php echo $disabled; ?> id="name" type="text" class="form-control col-md-7 col-xs-12 required-topic" name="name" value="<?php echo (isset($topic)) ? $topic[0]->name : set_value('name'); ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="thematic_area_type">Área Temática <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select <?php echo $disabled; ?> class="form-control col-md-7 col-xs-12 required-topic" id="thematic_area_type" name="thematic_area_type">
                                    <option value="">Selecciona...</option>
                                    <?php
                                    foreach ($thematic_area_types as $thematic_area_type) {
                                        if (isset($topic)) {
                                            if ($topic[0]->thematic_area_type_id == $thematic_area_type->thematic_area_type_id) {
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

                        <?php if ($disabled == "") { ?>
                            <div class = "form-group">
                                <div class = "col-md-6 col-md-offset-3">
                                    <?php if (!isset($topic)) {
                                        ?>
                                        <button type="button" onclick="store_NewTopic()" class="btn btn-primary">
                                            Guardar
                                        </button>
                                    <?php } else { ?>
                                        <button type="button" onclick="update_Topic()" class="btn btn-primary">
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