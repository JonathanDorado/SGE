$(document).ready(function () {

    $('#table-clients').DataTable({
        order: [[1, "asc"]],
        columnDefs: [
            {orderable: false, targets: 5}
        ]
    });
});

function show_Client(client_id) {
    $.redirect('clients/show', {client_id: client_id});
}

function store_NewClient() {
    if (!$.required('required-client')) {
        return false;
    }
    $("#newClientForm").submit();
}

function store_MasiveClient() {
    if (!$.required('required-masive-client')) {
        return false;
    } else {
        if ($('.required-masive-client-file').length > 0) {

            new PNotify({
                title: 'Error en Formulario',
                text: 'Hay campos con error!',
                type: 'error',
                styling: 'bootstrap3'
            });
            return false;
        }
    }
    $("#masiveClientsForm").submit();
}

//////////////Form Edit Client//////////////////////////////////////////////////
function update_Client() {
    if (!$.required('required-client')) {
        return false;
    }
    $("#editClientForm").submit();
}


function edit_Client(client_id) {
    $.redirect('clients/edit', {client_id: client_id});
}


function chargeCitiesByCountry(id) {
    var country_code = $("#" + id + " option:selected").val();
//    var thematic_area_type_id = $("#" + id + " option:selected").attr('thematic_area_type');
    if (country_code !== "") {
        $.post("getCitiesByCountry", {country_code: country_code}, function (response, state) {
            var data = JSON.parse(response);
            $("#city_citizenship").empty();
            $("#city_citizenship").append("<option value=''>Selecciona...</option>");
            for (i = 0; i < data.length; i++) {
                $("#city_citizenship").append("<option value='" + data[i].city_id + "'>" + data[i].name + "</option>");
            }
        });
    } else {
        $("#city_citizenship").empty();
        $("#city_citizenship").append("<option value=''>Selecciona...</option>");
    }
}

function uploadClientsValidator(id, div_ext) {
    var allowed_extensions = ['xlsx', 'xls'];
    $("." + div_ext).hide();
    if ($("#" + id).val() == "") {
        $("#" + id).removeClass('input-error');
        $("#" + id).removeClass('required-masive-client-file');
    } else {
        if (!fileExtentionValidator(id, allowed_extensions)) {
            $("#" + id).addClass('input-error');
            $("#" + id).addClass('required-masive-client-file');
            $("." + div_ext).show();
        } else {
            $("#" + id).removeClass('input-error');
            $("#" + id).removeClass('required-masive-client-file');
        }
    }
}

