

function send_Register() {
    if (!$.required('required-register')) {
        return false;
    }

    $.post("landing/store_Register", {
        event_id: $("#event_id").val(),
        name: $("#name").val(),
        lastname: $("#lastname").val(),
        phone_number: $("#phone_number").val(),
        email: $("#email").val()
    }, function (response) {
        console.log(response);
        var data = JSON.parse(response);
        if (data.response === '0') {
            $("#msg-error").html("");
            $("#msg-error").html(data.msg);
        } else {
            $("#content").html("");
            $("#content").html(data.msg);
            $(".response-register").show(2000);
            $(".form-register").hide(2000);
        }
    });
}

function validateInscription() {
    $("#msg-email").html("");
    var email = $("#email").val();
    var event_id = $("#event_id").val();
    if (email == "") {
        $("#msg-email").html("<span style='color: #dd4b39;'>Ingresa un email válido!</span><br><br>");
    } else {
        $.post("landing/validateInvitation", {event_id: event_id, email: email}, function (data) {
            $("#content").html("");
            $("#content").html(data);
            $('#wrapper').removeAttr('id').addClass('container-2');
//            alert(data);
        });
    }
}

function store_ClientLanding() {
    if (!$.required('required-client-landing')) {
        return false;
    }

    $.post("landing/store_Client", {
        event_id: $("#event_id").val(),
        name: $("#name").val(),
        lastname: $("#lastname").val(),
        document_type: $("#document_type").val(),
        document_number: $("#document_number").val(),
        phone_number: $("#phone_number").val(),
        cellphone_number: $("#cellphone_number").val(),
        address: $("#address").val(),
        email: $("#email").val(),
        company: $("#company").val(),
        position: $("#position").val()
    }, function (response) {
        console.log(response);
        var data = JSON.parse(response);
        if (data.response === '0') {
            $("#msg-error").html("");
            $("#msg-error").html(data.msg);
        } else {
            $("#content").html("");
            $("#content").html(data.msg);
        }
    });
}

function replyToInvitation(response, event_id, client_id) {

    $.post("landing/store_replyToInvitation", {
        reply_to_invitation: response,
        event_id: event_id,
        client_id: client_id
    }, function (response) {
        console.log(response);
        var data = JSON.parse(response);
        if (data.response === '0') {
            $("#msg-error").html("");
            $("#msg-error").html(data.msg);
        } else {
            $("#content").html("");
            $("#content").html(data.msg);
        }
    });
}
