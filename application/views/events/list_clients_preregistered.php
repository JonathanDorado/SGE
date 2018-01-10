
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
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
                <table id="table-clients-confirmation" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Identificación</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Apellido</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Empresa</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($clients as $client) {
                            switch ($client->state_client) {
                                case 3:
//                                    if ($this->session->userdata('user_id') != $client->user_id_register) {
//                                        $disabled = 'disabled';
//                                        $tooltip = 'El cliente esta siendo gestionado por otro usuario';
//                                    } else {
                                        $disabled = '';
                                        $tooltip = 'Pendiente Confirmación de Pago';
//                                    }
                                    $color_background = "orange";
                                    $color_text = "#FFFFFF";
                                    break;
                                case 5:
                                    $disabled = '';
                                    $tooltip = 'Pago Confirmado';
                                    $color_background = "#008000";
                                    $color_text = "#FFFFFF";
                                    break;
                                case 7:
                                    $disabled = '';
                                    $tooltip = 'Pago Confirmado';
                                    $color_background = "#008000";
                                    $color_text = "#FFFFFF";
                                    break;
                                default:
                                    $color_background = "#CB4335";
                                    $color_text = "#FFFFFF";
                                    $disabled = '';
                                    $tooltip = 'Pendiente de Confirmación';
                            }

                            $checked = ($client->preregister == 0) ? '' : 'checked';
                            echo "<tr style='background:$color_background; color:$color_text;'>" .
                            "<td class='text-center'>" . $client->document_number . "</td>" .
                            "<td class='text-center'>" . $client->name . "</td>" .
                            "<td class='text-center'>" . $client->lastname . "</td>" .
                            "<td class='text-center'>" . $client->email . "</td>" .
                            "<td class='text-center'>" . $client->company . "</td>" .
                            "<td class='text-center'>" . $client->position . "</td>";

                            if ($disabled == '') {
                                ?>
                            <td>
                                <div class="btn-group">
                                    <a href='#' onclick='create_ConfirmClient(<?php echo $client->event_client_id . ", " . $event[0]->event_id . ", " . $client->client_id; ?>)' class='btn btn-primary dropdown-toggle btn-xs'><i  class='fa fa-pencil-square-o'></i> Confirmar </a>
                                </div>
                            </td>       
                            <?php
                        } else {
                            echo "<td></td>";
                        }
                        if ($tooltip != '') {
                            echo "<td class='text-center'><span class='fa fa-info-circle' data-toggle='tooltip' data-placement='left' title='$tooltip'></span></td>";
                        } else {
                            echo "<td></td>";
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