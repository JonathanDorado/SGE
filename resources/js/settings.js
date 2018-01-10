$(document).ready(function () {

    $('#table-profiles').dataTable({
        order: [[0, "asc"]],
        columnDefs: [
            {orderable: false, targets: 1}
        ]
    });
});

function show_Profile(profile_id) {
    $.redirect('show_Profile', {profile_id: profile_id});
}

function update_ProfilePermission(id, profile_id, permission_id) {
    var type;
    if ($('#' + id).is(":checked")) {
        type = 1;
    } else {
        type = 0;
    }

    $.post("update_ProfilePermission", {type: type, profile_id: profile_id, permission_id: permission_id}, function (response) {
        console.log(data);
        var data = JSON.parse(response);

        new PNotify({
            title: 'Asignación de Permisos',
            text: data.msg,
            type: 'success',
            styling: 'bootstrap3'
        });

    });

}