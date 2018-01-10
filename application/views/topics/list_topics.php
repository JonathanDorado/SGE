
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Lista de Temáticas </h2>
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
                <table id="table-topics" class="table table-stripe">
                    <thead>
                        <tr>
                            <th class="text-center">Tématica</th>
                            <th class="text-center">Área</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($topics as $topic) {
                            echo "<tr >" .
                            "<td class='text-center'>" . $topic->name . "</td>" .
                            "<td class='text-center'>" . $topic->thematic_area_type . "</td>";
                            echo "<td style='text-align: center'>";
                            $permissions_view_detail = array(VIEW_DETAIL_TOPIC);
                            if (array_intersect($permissions_view_detail, $this->session->userdata('permissions'))) {
                                echo "<a href='#' onclick='show_Topic(" . $topic->topic_id . ")' class='btn btn-success btn-xs'><i  class='fa fa-search'></i> Ver </a>";
                            }
                            $permissions_edit = array(EDIT_TOPIC);
                            if (array_intersect($permissions_edit, $this->session->userdata('permissions'))) {
                                echo "<a href='#' onclick='edit_Topic(" . $topic->topic_id . ")' class='btn btn-info btn-xs'><i  class='fa fa-pencil'></i> Editar </a></td>";
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