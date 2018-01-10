$(document).ready(function () {

    $('#table-providers').DataTable({
        order: [[1, "desc"]],
        columnDefs: [
            {orderable: false, targets: 5}
        ]
    });
});

function show_Provider(provider_id) {
    $.redirect('providers/show', {provider_id: provider_id});
}

//////////////New Provider//////////////////////////////////////////////////////////
function store_NewProvider() {
    if (!$.required('required-provider')) {
        return false;
    } else {
        if ($('.error-file').length > 0) {
            new PNotify({
                title: 'Error en Formulario',
                text: 'Hay campos con error!',
                type: 'error',
                styling: 'bootstrap3'
            });
            return false;
        }
    }
    $("#newProviderForm").submit();
}
////////////////////////////////////////////////////////////////////////////////

//////////////Edit Provider/////////////////////////////////////////////////////////
function update_Provider() {
    if (!$.required('required-provider')) {
        return false;
    }
    $("#editProviderForm").submit();
}

function edit_Provider(provider_id) {
    $.redirect('providers/edit', {provider_id: provider_id});
}

function imgProfileValidator(id, max_width, min_width, max_height, min_height, div_ext, div_size) {
    var allowed_extensions = ['png', 'jpg', 'jpeg'];
    $("." + div_ext).hide();
    $("." + div_size).hide();
    if ($("#" + id).val() == "") {
        $("#" + id).removeClass('input-error');
    } else {
        if (!fileExtentionValidator(id, allowed_extensions)) {
            $("#" + id).addClass('input-error');
            $("." + div_ext).show();
        } else {
            $("#" + id).removeClass('input-error');
            imageSizeValidator(id, max_width, min_width, max_height, min_height, div_ext, div_size);
        }
    }

}
