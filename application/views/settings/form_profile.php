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
                <h2>Perfil<small><?php echo $profile[0]->name; ?></small>
                </h2>

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

                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <?php
                        $i = 0;
                        $active_tab = "active";

                        foreach ($modules as $module) {
                            if ($i != 0) {
                                $active_tab = "";
                            }
                            echo '<li role="presentation" class="' . $active_tab . '"><a href="#tab-' . $module->alias . '"  id="' . $module->alias . '-tab" role="tab" data-toggle="tab" aria-expanded="true">' . $module->name . '</a></li>';
                            $i++;
                        }
                        ?>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <?php
                        $j = 0;
                        $active_content_tab = "in active";
                        foreach ($modules as $module) {
                            if ($j != 0) {
                                $active_content_tab = "";
                            }
                            ?>
                            <div role="tabpanel" class="tab-pane <?php echo $active_content_tab; ?>" id="tab-<?php echo $module->alias; ?>" aria-labelledby="<?php echo $module->alias; ?>-tab">
                                <table style="width:40% !important; margin:auto;" class="table">
                                    <thead><tr>
                                            <th></th>
                                            <th class="text-center">Permisos por Módulo</th>
                                        </tr>
                                    </thead>

                                    <?php
                                    $array_permissions = array();
                                    foreach ($profile_permissions as $profile_permission) {
                                        array_push($array_permissions, $profile_permission->permission_id);
                                    }

                                    foreach ($permissions as $permission) {
                                        $checked = "";
                                        if (in_array($permission->permission_id, $array_permissions)) {
                                            $checked = "checked";
                                        }

                                        if ($permission->module_id == $module->module_id) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><input <?php echo $checked; ?> id="permission-<?php echo $permission->permission_id; ?>" onchange="update_ProfilePermission(this.id,<?php echo $profile[0]->profile_id; ?>,<?php echo $permission->permission_id; ?>)" type="checkbox" value=""></td>
                                                <td><?php echo $permission->name; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    echo '</table>';
                                    echo '</div>';
                                    $j++;
                                }
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>