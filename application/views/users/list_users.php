
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Lista de Usuarios </h2>
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
                        <?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert alert-success">
                                <?php
                                echo $this->session->flashdata('success');
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <table id="table-users" class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Apellido</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Perfil</th>
                            <th class="text-center">Activo</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($users as $user) {
                            echo "<tr >" .
                            "<td class='text-center'>" . $user->name . "</td>" .
                            "<td class='text-center'>" . $user->lastname . "</td>" .
                            "<td class='text-center'>" . $user->email . "</td>" .
                            "<td class='text-center'>" . $user->profile_name . "</td>" .
                            "<td class='text-center'>" . ($user->active == 1 ? 'Si' : 'No') . "</td>";
                            echo "<td style='text-align: center'>";
                            $permissions_view_detail = array(VIEW_DETAIL_USER);
                            if (array_intersect($permissions_view_detail, $this->session->userdata('permissions'))) {
                                echo "<a href='#' onclick='show_User(" . $user->user_id . ")' class='btn btn-success btn-xs'><i  class='fa fa-search'></i> Ver </a>";
                            }
                            $permissions_edit = array(EDIT_USERS);
                            if (array_intersect($permissions_edit, $this->session->userdata('permissions'))) {
                                echo "<a href='#' onclick='edit_User(" . $user->user_id . ")' class='btn btn-info btn-xs'><i  class='fa fa-pencil'></i> Editar </a>";
                            }
                            $permissions_reset_password = array(RESET_PASSWORD_USER);
                            if (array_intersect($permissions_reset_password, $this->session->userdata('permissions'))) {
                                echo "<a href='#' onclick='reset_password_User(" . $user->user_id . ",\"" . $user->name . "\",\"" . $user->lastname . "\")' class='btn btn-primary btn-xs'><i  class='fa fa-lock'></i> Resetear </a>";
                            }
                            $permissions_enable = array(ENABLE_USER);
                            if (array_intersect($permissions_enable, $this->session->userdata('permissions'))) {
                                if ($user->active == 1) {
                                    echo "<a href='#' onclick='change_state_User(" . $user->user_id . ",0,\"" . $user->name . "\",\"" . $user->lastname . "\")' class='btn btn-danger btn-xs'><i  class='fa fa-trash-o'></i> Inactivar </a></td>";
                                } else {
                                    echo "<a href='#' onclick='change_state_User(" . $user->user_id . ",1,\"" . $user->name . "\",\"" . $user->lastname . "\")' class='btn btn-warning btn-xs'><i  class='fa fa-check'></i> Activar </a></td>";
                                }
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


