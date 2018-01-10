<div class="row">
    <div class="col-md-12 text-center">
        <h3>
            Hola <?php echo $client[0]->name; ?>!
        </h3>
    </div>

    <div class="col-md-12 text-center">
        <h4>Deseas asistir al evento</h4><br>
    </div>

    <div class="col-md-12 text-center">
        <h2><?php echo $event[0]->name; ?></h2><br>
    </div>

    <div class="col-md-12 text-center">
        <button class="btn btn-primary" onclick="replyToInvitation('1',<?php echo $event[0]->event_id; ?>,<?php echo $client[0]->client_id; ?>)">
            Sí, Asistire
        </button>
        <button class="btn btn-primary" onclick="replyToInvitation('0',<?php echo $event[0]->event_id; ?>,<?php echo $client[0]->client_id; ?>)">
            No Asistire
        </button>
    </div>

</div>