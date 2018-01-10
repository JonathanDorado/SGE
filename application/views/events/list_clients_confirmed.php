

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
                <table id="table-clients-assistance" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Identificación</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Apellido</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Empresa</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center">Escarapela</th>
                            <th class="text-center">Asistencia</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($clients as $client) {
                            $checked = ($client->state_id == 5) ? 'checked' : '';
                            $hide = ($client->state_id == 5) ? '' : 'hide';

                            echo "<tr>" .
                            "<td class='text-center'>" . $client->document_number . "</td>" .
                            "<td class='text-center'>" . $client->name . "</td>" .
                            "<td class='text-center'>" . $client->lastname . "</td>" .
                            "<td class='text-center'>" . $client->email . "</td>" .
                            "<td class='text-center'>" . $client->company . "</td>" .
                            "<td class='text-center'>" . $client->position . "</td>";
                            echo "<td class='text-center'><div class='btn-group'><a href='#' class='btn btn-primary dropdown-toggle btn-xs' onclick='updateAssistanceClientEvent(\"event_client_id_$client->event_client_id\"," . $client->event_client_id . "," . $event[0]->event_id . "," . $client->client_id . ",1)'><i  class='fa fa-print'></i> Imprimir </a></div></td>";
                            echo "<td class='text-center'><input class='$hide' id='event_client_id_$client->event_client_id' type='checkbox' onchange='updateAssistanceClientEvent(this.id," . $client->event_client_id . "," . $event[0]->event_id . "," . $client->client_id . ")' $checked value=''></td>";
                            if ($checked == '') {
                                $display = 'none';
                            } else {
                                $display = 'block';
                            }
                            echo "<td></td>";
                            "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>