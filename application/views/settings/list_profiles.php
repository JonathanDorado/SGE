
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Lista de Perfiles </h2>
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
                <table id="table-profiles" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Perfil</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($profiles as $profile) {
                            echo "<tr >" .
                            "<td class='text-center'>" . $profile->name . "</td>";
                            echo "<td style='text-align: center'>";
                            $permissions_edit_permissions = array(EDIT_PERMISSIONS_PROFILE);
                            if (array_intersect($permissions_edit_permissions, $this->session->userdata('permissions'))) {
                                echo "<a href='#' onclick='show_Profile(" . $profile->profile_id . ")' class='btn btn-success btn-xs'><i  class='fa fa-pencil'></i> Editar Permisos </a>";
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