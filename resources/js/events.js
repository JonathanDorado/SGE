$(document).ready(function () {

//formatForms();

    var step_selected = $("#step_selected").val();
    $('#form_event_wizard').smartWizard({
        selected: parseInt(step_selected),
        enableAllSteps: true,
        labelNext: 'Siguiente', // label for Next button
        labelPrevious: 'Anterior', // label for Previous button
        labelFinish: 'Listar Eventos', // label for Finish button  
        onFinish: returnToEventList
    });
    $('.buttonNext').addClass('btn btn-success');
    $('.buttonPrevious').addClass('btn btn-primary');
    $('.buttonFinish').addClass('btn btn-info');
    $('#table-events').DataTable({
        order: [[0, "desc"]],
        columnDefs: [
            {orderable: false, targets: 6}
        ]
    });
});
function formatForms() {

    $('#form_show_event_wizard').smartWizard({
        labelNext: 'Siguiente', // label for Next button
        labelPrevious: 'Anterior', // label for Previous button
        labelFinish: 'Regresar', // label for Finish button  
        enableFinishButton: 'true',
        onFinish: returnToEventList
    });
    $('#form_new_event_wizard').smartWizard({
        labelNext: 'Siguiente', // label for Next button
        labelPrevious: 'Anterior', // label for Previous button
        labelFinish: 'Crear', // label for Finish button      
        onLeaveStep: leaveAStepCallback,
    });
    $('#form_edit_event_wizard').smartWizard({
        labelNext: 'Siguiente', // label for Next button
        labelPrevious: 'Anterior', // label for Previous button
        labelFinish: 'Editar', // label for Finish button      
        onLeaveStep: leaveAStepCallbackEdit,
        onFinish: update_Event
    });
    $('.buttonNext').addClass('btn btn-success');
    $('.buttonPrevious').addClass('btn btn-primary');
}

function leaveAStepCallback(obj, context) {
    return validateSteps(context.fromStep); // return false to stay on step and true to continue navigation 
}

function leaveAStepCallbackEdit(obj, context) {
    return validateStepsEdit(context.fromStep); // return false to stay on step and true to continue navigation 
}

// Your Step validation logic
function validateSteps(stepnumber) {
//    
    if (stepnumber == 3) {
        if (!$.required('required-file-event')) {
            return false;
        } else {
            var validate_extensions = true;
            if ($('.error-file').length > 0) {
                validate_extensions = false;
                new PNotify({
                    title: 'Error en Formulario',
                    text: 'Hay campos con error!',
                    type: 'error',
                    styling: 'bootstrap3'
                });
            }

            if (!validate_extensions) {
                return false;
            } else {
                return true;
            }
        }
    } else {
        $(".error-message").hide();
        if (!$.required('required-step-' + stepnumber)) {
            return false;
        } else {
            return true;
        }
    }
}

function validateStepsEdit(stepnumber) {
//    
    if (stepnumber == 3) {
        var validate_extensions = true;
        if ($('.error-file').length > 0 || $('.input-error').length > 0) {
            validate_extensions = false;
            new PNotify({
                title: 'Error en Formulario',
                text: 'Hay campos con error!',
                type: 'error',
                styling: 'bootstrap3'
            });
        }

        if (!validate_extensions) {
            return false;
        } else {
            return true;
        }

    } else {
        $(".error-message").hide();
        if (!$.required('required-step-' + stepnumber)) {
            return false;
        } else {
            return true;
        }
    }
}

function show_Event(event_id) {
    $.redirect('event/show', {event_id: event_id});
}

function destroyModal() {
    $('.modal').modal('hide');
}


function destroyPopover() {
    $('.popover').remove();
}
/////////////////////Events Functions////////////////////////////////////////////////
function returnToEventList() {
    $.redirect('/sge/event');
}


function setLandingPageFile(isRequired) {
    if (isRequired == 1) {
        var action = $("#event_resource_action").val();
        if (action == 1) {
            $("#url_logo_landing").removeAttr('disabled');
            $("#url_logo_landing").addClass('required-resource-event');
            $("#landing_description").removeAttr('disabled');
            $("#landing_description").addClass('required-resource-event');
//            $("#landing_description").addClass('input-error');
//            $(".text-landing").show();

        } else {

            if ($("#url_logo_landing_old").val() != "" && $("#url_logo_landing_old").val() != undefined) {
                $("#url_logo_landing").removeAttr('disabled');
//                $("#url_logo_landing").addClass('required-file-event');
                $("#landing_description").removeAttr('disabled');
                $("#landing_description").addClass('required-resource-event-edit');
                $(".text-landing").show();
            } else {
                $("#url_logo_landing").removeAttr('disabled');
                $("#url_logo_landing").addClass('required-resource-event-edit');
                $("#landing_description").removeAttr('disabled');
                $("#landing_description").addClass('required-resource-event-edit');
//            $("#landing_description").addClass('input-error');
                $(".text-landing").show();
            }


        }

    } else {
        $("#url_logo_landing").attr('disabled', 'true');
        $("#url_logo_landing").removeClass('required-resource-event');
        $("#url_logo_landing").removeClass('required-resource-event-edit');
        $("#url_logo_landing").removeClass('input-error');
        $("#landing_description").attr('disabled', 'true');
        $("#landing_description").removeClass('required-resource-event');
        $("#landing_description").removeClass('required-resource-event-edit');
        $("#landing_description").removeClass('input-error');
        $("#landing_description").val('');
        $(".text-landing").hide();
    }
}

function setScore(isRequired) {
    if (isRequired == 1) {
//        $("#score_assistance").removeAttr('disabled');
        $("#score_assistance").val('');
//        $("#score_attention").removeAttr('disabled');
        $("#score_attention").val('');
    } else {
//        $("#score_assistance").attr('disabled', 'true');
        $("#score_assistance").val('0');
//        $("#score_attention").attr('disabled', 'true');
        $("#score_attention").val('0');
    }
}
////////////////////////////////////////////////////////////////////////////////

/////////////////Event//////////////////////////////////////////////////////////
function store_Event() {
    if (!$.required('required-step-1')) {
        return false;
    }

    $("#EventForm").submit();
}

function store_EventResources(type) {
    if (type == 1) {
        if (!$.required('required-resource-event')) {
            return false;
        } else
        {
            if ($('.error-file').length > 0 || $('.input-error').length > 0) {
                new PNotify({
                    title: 'Error en Formulario',
                    text: 'Hay campos con error!',
                    type: 'error',
                    styling: 'bootstrap3'
                });
                return false;
            }
        }
    } else {
        if (!$.required('required-resource-event-edit')) {
            return false;
        } else {
            if ($('.error-file').length > 0 || $('.input-error').length > 0) {
                new PNotify({
                    title: 'Error en Formulario',
                    text: 'Hay campos con error!',
                    type: 'error',
                    styling: 'bootstrap3'
                });
                return false;
            }
        }
    }

    $("#EventResourcesForm").submit();
}

function store_EventScores() {
    if (!$.required('required-step-3')) {
        return false;
    }

    $("#EventScoreForm").submit();
}

function store_EventProjections() {
    if (!$.required('required-step-4')) {
        return false;
    }

    $("#EventProjectionForm").submit();
}

function addNewLocationEvent() {
    var rows = $(".location-row").length;
    console.log(rows);
    $.get("addRowLocationEvent", {row: rows}, function (data) {
        $("#table-locations-events tbody").append(data);
    });
}

function edit_Event(event_id) {
    $.redirect('event/edit', {event_id: event_id});
}

function update_Event() {
    if (!$.required('required-event')) {
        return false;
    }

    $("#editEventForm").submit();
}

function removeEditRowLocationEvent(id, event_location_id) {
    new PNotify({
        title: 'Sede de Evento',
        text: '¿Estás seguro de eliminar la sede del evento? <br><br>Los usuarios que se confirmaron a esta sede no podrán descargar sus certificados.',
        addclass: 'stack-modal',
        stack: {'dir1': 'down', 'dir2': 'right', 'modal': true},
        type: 'info',
        styling: 'bootstrap3',
        confirm: {
            confirm: true,
            buttons: [{
                    text: 'Si',
                    click: function (notice) {
                        notice.remove();
                        $.post("deleteLocationEvent", {event_location_id: event_location_id}, function (response) {
                            $("#" + id).remove();
                            var data = JSON.parse(response);
                            var type = '';
                            if (data.response === '0') {
                                type = 'error';
                            } else {
                                type = 'success';
                            }

                            new PNotify({
                                title: 'Sede de Evento',
                                text: data.msg,
                                type: type,
                                styling: 'bootstrap3'
                            });
                        });
                    }
                }, {
                    text: 'No',
                    click: function (notice) {
                        notice.remove();
                    }
                }]
        },
        buttons: {
            closer: false,
            sticker: false
        },
        history: {
            history: false
        }
    });
}
////////////////////////////////////////////////////////////////////////////////

//////////////Assign Training///////////////////////////////////////////////////
function create_AssignTopics(event_id) {
    $.redirect('event/create_AssignationTopics', {event_id: event_id});
}

function store_AssignTopics() {
    if (!$.required('required-assign-topics')) {
        return false;
    } else {
        if ($('.required-memories-file').length > 0) {

            new PNotify({
                title: 'Error en Formulario',
                text: 'Hay campos con error!',
                type: 'error',
                styling: 'bootstrap3'
            });
            return false;
        }
    }
    $("#assignTopicsEventForm").submit();
}

function addNewAssignTopicEvent() {
    var rows = $(".assign-topics-row").length;
    $.get("addRowAssignTopicsEvent", {row: rows}, function (data) {
        $("#table-assign-topics-events tbody").append(data);
    });
}

function chargeInstructorsByTopic(id, position) {
    var thematic_area_type_id = $("#" + id + " option:selected").attr('thematic_area_type');
    if (thematic_area_type_id !== "") {
        $.post("getInstructorsByTopic", {thematic_area_type_id: thematic_area_type_id}, function (response, state) {
            var data = JSON.parse(response);
            $("#instructor-" + position).empty();
            $("#instructor-" + position).append("<option value=''>Selecciona...</option>");
            for (i = 0; i < data.length; i++) {
                $("#instructor-" + position).append("<option value='" + data[i].provider_id + "'>" + data[i].name + "</option>");
            }
        });
    } else {
        $("#instructor-" + position).empty();
        $("#instructor-" + position).append("<option value=''>Selecciona...</option>");
    }
}

function removeEditRowTopicEvent(id, event_topic_id) {

    new PNotify({
        title: 'Asignación de Temáticas',
        text: '¿Estás seguro de eliminar la temática? <br><br>Se eliminarán las memorias y el acceso a la descarga por parte de los clientes finales.',
        addclass: 'stack-modal',
        stack: {'dir1': 'down', 'dir2': 'right', 'modal': true},
        type: 'info',
        styling: 'bootstrap3',
        hide: false,
        closer: false,
        confirm: {
            confirm: true,
            buttons: [{
                    text: 'Si',
                    click: function (notice) {
                        notice.remove();
                        $.post("deleteTopicEvent", {event_topic_id: event_topic_id}, function (response) {
                            $("#" + id).remove();
                            console.log(data);
                            var data = JSON.parse(response);
                            var type = '';
                            if (data.response === '0') {
                                type = 'error';
                            } else {
                                type = 'success';
                            }

                            new PNotify({
                                title: 'Asignación de Temáticas',
                                text: data.msg,
                                type: type,
                                styling: 'bootstrap3'
                            });
                        });
                    }
                }, {
                    text: 'No',
                    click: function (notice) {
                        notice.remove();
                    }
                }]
        },
        buttons: {
            closer: false,
            sticker: false
        },
        history: {
            history: false
        }
    });
}
////////////////////////////////////////////////////////////////////////////////

//////////////Assign Training///////////////////////////////////////////////////
function create_AssignSurvey(event_id) {
    $.redirect('event/create_AssignationSurvey', {event_id: event_id});
}

function addNewAssignSurveyEvent() {
    var rows = $(".survey-row").length;
    $.get("addRowAssignSurveyEvent", {row: rows}, function (data) {
        $("#table-survey-events tbody").append(data);
    });
}

function chargeOptionsByAnswer(id, position) {
    var answer_type_id = $("#" + id + " option:selected").val();
    if (answer_type_id !== "") {
        $.post("getOptionsByAnswer", {answer_type_id: answer_type_id}, function (response, state) {
            console.log(response);
            var data = JSON.parse(response);
            console.log(data);
            $("#answer_option_" + position).empty();
            $("#answer_option_" + position).append("<option value=''>Selecciona...</option>");
            for (i = 0; i < data.length; i++) {
                $("#answer_option_" + position).append("<option value='" + data[i].answer_group_id + "'>" + data[i].name + "</option>");
            }
        });
    } else {
        $("#answer_option_" + position).empty();
        $("#answer_option_" + position).append("<option value=''>Selecciona...</option>");
    }
}

function store_AssignSurvey() {
    if ($(".survey-row").length < 1) {
        $.notify({
            message: "No hay preguntas para almacenar!"
        }, {
            type: 'danger'
        });
        return false;
    }


    if (!$.required('required-survey')) {
        return false;
    }
    $("#assignSurveyEventForm").submit();
}

////////////////////////////////////////////////////////////////////////////////

function removeEditRowSurveyEvent(id, event_survey_id) {

    new PNotify({
        title: 'Asignación de Encuesta',
        text: '¿Estás seguro de eliminar la pregunta? <br><br>Se eliminarán las respuestas existentes de usuarios que ya hayan realizado la encuesta.',
        addclass: 'stack-modal',
        stack: {'dir1': 'down', 'dir2': 'right', 'modal': true},
        type: 'info',
        styling: 'bootstrap3',
        hide: false,
        closer: false,
        confirm: {
            confirm: true,
            buttons: [{
                    text: 'Si',
                    click: function (notice) {
                        notice.remove();
                        $.post("deleteSurveyQuestion", {event_survey_id: event_survey_id}, function (response) {
                            $("#" + id).remove();
                            var data = JSON.parse(response);
                            var type = '';
                            if (data.response === '0') {
                                type = 'error';
                            } else {
                                type = 'success';
                            }

                            new PNotify({
                                title: 'Asignación de Encuesta',
                                text: data.msg,
                                type: type,
                                styling: 'bootstrap3'
                            });
                        });
                    }
                }, {
                    text: 'No',
                    click: function (notice) {
                        notice.remove();
                    }
                }]
        },
        buttons: {
            closer: false,
            sticker: false
        },
        history: {
            history: false
        }
    });
}
////////////////////////////////////////////////////////////////////////////////


//////////////////Guest registration////////////////////////////////////////////
function manage_Clients(event_id) {
    $.redirect('event/manage_event', {event_id: event_id});
}

function list_Guests(event_id) {
    $.post("list_Guests", {
        event_id: event_id
    },
            function (data) {
                $('#result_list_guests').html(data);
                $('#table-clients-invited').DataTable({
                    "paging": false
                });
            });
}

function store_MasiveGuests() {
    if (!$.required('required-masive-guest')) {
        return false;
    } else {
        if ($('.required-masive-guest-file').length > 0) {

            new PNotify({
                title: 'Error en Formulario',
                text: 'Hay campos con error!',
                type: 'error',
                styling: 'bootstrap3'
            });
            return false;
        }
    }
    $("#masiveGuestForm").submit();
}
////////////////////////////////////////////////////////////////////////////////

//////////////////Preregister Clients///////////////////////////////////////////
function list_Clients(event_id) {
    $.post("list_Clients", {
        event_id: event_id
    }, function (data) {
        $('#result_list_preregister').html(data);
    }).done(function () {
        $('#table-clients-preregister').DataTable({
//                    "paging": false
        });
    });
}

function addClientToEvent(event_id, client_id) {

    if ($('#client_' + client_id).is(":checked")) {
        message = "¿Estás seguro de pre-registar el cliente al evento?";
    } else {
        message = "¿Estás seguro de eliminar al usuario del pre-registro de evento?";
    }

    new PNotify({
        title: 'Pre-registro de Cliente',
        text: message,
        addclass: 'stack-modal',
        stack: {'dir1': 'down', 'dir2': 'right', 'modal': true},
        type: 'info',
        styling: 'bootstrap3',
        hide: false,
        closer: false,
        confirm: {
            confirm: true,
            buttons: [{
                    text: 'Si',
                    click: function (notice) {
                        notice.remove();
                        $.post("addClientToEvent", {event_id: event_id, client_id: client_id}, function (response) {
                            console.log(data);
                            var data = JSON.parse(response);
                            var type = '';
                            if (data.response === '0') {
                                type = 'error';
                            } else {
                                type = 'success';
                            }

                            new PNotify({
                                title: 'Pre-registro a Evento',
                                text: data.msg,
                                type: type,
                                styling: 'bootstrap3'
                            });
                        });
                    }
                }, {
                    text: 'No',
                    click: function (notice) {
                        notice.remove();
                        if ($('#client_' + client_id).is(":checked")) {
                            $('#client_' + client_id).prop('checked', false);
                        } else {
                            $('#client_' + client_id).prop('checked', true);
                        }
                    }
                }]
        },
        buttons: {
            closer: false,
            sticker: false
        },
        history: {
            history: false
        }
    });
}
////////////////////////////////////////////////////////////////////////////////

//////////////////Confirmation Clients///////////////////////////////////////////
function list_PreregisteredClients(event_id) {
    $.post("list_PreregisteredClients", {
        event_id: event_id
    }, function (data) {
        $('#result_list_confirmation').html(data);
    }).done(function () {
        $('#table-clients-confirmation').DataTable({
//                    "paging": false
        });
    });
}

function store_MasivePreregister() {
    if (!$.required('required-masive-preregister')) {
        return false;
    } else {
        if ($('.required-masive-preregister-file').length > 0) {

            new PNotify({
                title: 'Error en Formulario',
                text: 'Hay campos con error!',
                type: 'error',
                styling: 'bootstrap3'
            });
            return false;
        }
    }
    $("#masivePreregisterForm").submit();
}

function create_ConfirmClient(event_client_id, event_id, client_id) {
    $.redirect('create_ConfirmClient', {event_client_id: event_client_id, event_id: event_id, client_id: client_id});
}

function store_ConfirmationClient() {
    if (!$.required('required-confirmation-client')) {
        return false;
    }

    if ($("#event_type").val() == "2") {
        if (!validateClientTopicChecked()) {
            new PNotify({
                title: 'Asistencia a Cursos',
                text: "Debe seleccionar por lo menos un curso al que el usuario asistirá al evento!",
                type: "error",
                styling: 'bootstrap3'
            });
            return false;
        }
    }

    $("#newConfirmationForm").submit();
}

function update_ConfirmationClient() {
    if (!$.required('required-confirmation-client')) {
        return false;
    }

    if ($("#event_type").val() == "2") {
        if (!validateClientTopicChecked()) {
            new PNotify({
                title: 'Asistencia a Cursos',
                text: "Debe seleccionar por lo menos un curso al que el usuario asistirá al evento!",
                type: "error",
                styling: 'bootstrap3'
            });
            return false;
        }
    }

    $("#editConfirmationForm").submit();
}

function validateClientTopicChecked() {
    var anyBoxesChecked = false;
    $('.chk-event-topic-client').each(function () {
        if ($(this).is(':checked')) {
            anyBoxesChecked = true;
        }
    });
    return anyBoxesChecked;
}

function setupInfoPayment(id) {
    $(".item-payment").hide();
    $(".set-input-payment").removeClass('required-confirmation-client');
    $("#isArlPaying_arl_id").val(1);
    $("#isCompanyPaying_nit_company").val("0");
    var payment_type = $("#" + id + " option:selected").val();
    switch (payment_type) {
        case '1':
            $(".item-arl").show();
            $("#isArlPaying_arl_id").addClass('required-confirmation-client');
            $("#isArlPaying_arl_id").val('');
            break;
        case '4':
            $(".item-nit-company").show();
            $("#isCompanyPaying_nit_company").addClass('required-confirmation-client');
            $("#isCompanyPaying_nit_company").val(" ");
            break;
        default:
            $(".item-payment").hide();
            $(".set-input-payment").removeClass('required-confirmation-client');
            break;
    }
}
////////////////////////////////////////////////////////////////////////////////

//////////////////Assistance Clients///////////////////////////////////////////
function list_ConfirmedClients(event_id) {
    $.post("list_ConfirmedClients", {
        event_id: event_id
    }, function (data) {
        $('#result_list_assistance').html(data);
    }).done(function () {
        $('#table-clients-assistance').DataTable({
//                    "paging": false
        });
    });
}

function updateAssistanceClientEvent(id, event_client_id, event_id, client_id, type) {

    if (type == 1) {

        state_id = 5;
        $.post("updateAssistanceClientEvent", {event_client_id: event_client_id, state_id: state_id}, function (response) {
            console.log(data);
            var data = JSON.parse(response);
//                if (popup) {
//                    $(".print_escarapela").show();
            url = "generateEscarapela?event_id=" + event_id + "&client_id=" + client_id;
            var win = window.open(url, '_blank');
            if (win) {
                win.focus();
            } else {
                new PNotify({
                    title: 'Ventana Emergente',
                    text: 'Permite las ventanas emergentes en la página para visualizar e imprimir la escarapela del cliente',
                    type: 'warning',
                    styling: 'bootstrap3'
                });
            }
//                } else {
//                    $(".print_escarapela").hide();
//                }
//            }
            new PNotify({
                title: 'Asistencia a Evento',
                text: data.msg,
                type: 'success',
                styling: 'bootstrap3'
            });
            $('#' + id).removeClass('hide');
            $('#' + id).prop('checked', true);
            $('#' + id).show();
        });
    } else {

        state_id = 7;
        message = "¿Estás seguro de eliminar la asistencia del usuario al curso?";
        new PNotify({
            title: 'Asistencia de Cliente',
            text: message,
            addclass: 'stack-modal',
            stack: {'dir1': 'down', 'dir2': 'right', 'modal': true},
            type: 'info',
            styling: 'bootstrap3',
            hide: false,
            closer: false,
            confirm: {
                confirm: true,
                buttons: [{
                        text: 'Si',
                        click: function (notice) {
                            notice.remove();
                            $.post("updateAssistanceClientEvent", {event_client_id: event_client_id, state_id: state_id}, function (response) {
                                console.log(data);
                                var data = JSON.parse(response);

                                new PNotify({
                                    title: 'Asistencia a Evento',
                                    text: data.msg,
                                    type: 'alert',
                                    styling: 'bootstrap3'
                                });
                                $('#' + id).hide();
                            });
                        }
                    }, {
                        text: 'No',
                        click: function (notice) {
                            notice.remove();
                            if ($('#' + id).is(":checked")) {
                                $('#' + id).prop('checked', false);
                            } else {
                                $('#' + id).prop('checked', true);
                            }
                        }
                    }]
            },
            buttons: {
                closer: false,
                sticker: false
            },
            history: {
                history: false
            }
        });

    }
}
///////////////////////////////////////////////////////////////////////////////

/////////////////////////////////List Score/////////////////////////////////////
function list_Score(event_id) {
    $.redirect('event/list_Score', {event_id: event_id});
}
////////////////////////////////////////////////////////////////////////////////

function imageValidator(id, max_width, min_width, max_height, min_height, div_ext, div_size) {
    var allowed_extensions = ['png', 'jpg', 'jpeg'];
    $("." + div_ext).hide();
    $("." + div_size).hide();
    if (!fileExtentionValidator(id, allowed_extensions)) {
        $("#" + id).addClass('input-error');
        $("." + div_ext).show();
    } else {
        $("#" + id).removeClass('input-error');
        imageSizeValidator(id, max_width, min_width, max_height, min_height, div_ext, div_size);
    }
}

function memoriesValidator(id, div_ext) {
    var allowed_extensions = ['rar', 'zip'];
    $("." + div_ext).hide();
    if ($("#" + id).val() == "") {
        $("#" + id).removeClass('input-error');
        $("#" + id).removeClass('required-memories-file');
    } else {
        if (!fileExtentionValidator(id, allowed_extensions)) {
            $("#" + id).addClass('input-error');
            $("#" + id).addClass('required-memories-file');
            $("." + div_ext).show();
        } else {
            $("#" + id).removeClass('input-error');
            $("#" + id).removeClass('required-memories-file');
            //imageSizeValidator(id, max_width, min_width, max_height, min_height, div_ext, div_size);
        }
    }
}

function uploadValidator(id, div_ext) {
    var allowed_extensions = ['xlsx', 'xls'];
    $("." + div_ext).hide();
    if ($("#" + id).val() == "") {
        $("#" + id).removeClass('input-error');
        $("#" + id).removeClass('required-upload-file');
    } else {
        if (!fileExtentionValidator(id, allowed_extensions)) {
            $("#" + id).addClass('input-error');
            $("#" + id).addClass('required-memories-file');
            $("." + div_ext).show();
        } else {
            $("#" + id).removeClass('input-error');
            $("#" + id).removeClass('required-memories-file');
            //imageSizeValidator(id, max_width, min_width, max_height, min_height, div_ext, div_size);
        }
    }
}


function uploadFileValidator(id, div_ext, class_error) {
    var allowed_extensions = ['xlsx', 'xls'];
    $("." + div_ext).hide();
    if ($("#" + id).val() == "") {
        $("#" + id).removeClass('input-error');
        $("#" + id).removeClass(class_error);
    } else {
        if (!fileExtentionValidator(id, allowed_extensions)) {
            $("#" + id).addClass('input-error');
            $("#" + id).addClass(class_error);
            $("." + div_ext).show();
        } else {
            $("#" + id).removeClass('input-error');
            $("#" + id).removeClass(class_error);
        }
    }
}


