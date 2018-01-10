
function resetPassword() {
    $(".error-message").hide();
    $("#alert-reset-password").hide();

    var validation_failed = false;
    if ($("#email").val() === "" || !isValidEmailAddress($("#email").val())) {
        $(".error-email").fadeIn("slow");
        validation_failed = true;
    }

    if (validation_failed) {
        return false;
    }

    var email = $("#email").val();
    $.post("password/resetPassword", {
        email: email},
            function (response) {
                var data = JSON.parse(response);
                if (data.result == '0') {
                    $("#alert-reset-password").fadeIn("slow");
                } else {
                    new PNotify({
                        title: 'Restauración de Contraseña',
                        text: '<br>Restauración Exitosa!<br>\n\
                                Inicia sesión de nuevo con la contraseña enviada a tu correo electrónico.',
                        addclass: 'stack-modal alert-success',
                        stack: {'dir1': 'down', 'dir2': 'right', 'modal': true},
                        type: 'success',
                        styling: 'fontawesome',
                        confirm: {
                            confirm: true,
                            buttons: [{
                                    text: 'Aceptar',
                                    click: function (notice) {
//                                        notice.remove();
                                        $.redirect('login');
                                    }
                                }, null]
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
            });
}

function changePassword() {
    $(".error-message").hide();

    var validation_failed = false;
    if ($("#password").val() === "") {
        $(".error-password").fadeIn("slow");
        validation_failed = true;
    } else {
        if ($("#password").val().length < 8) {
            $(".error-password-lenght").fadeIn("slow");
            validation_failed = true;
        }
    }

    if ($("#confirm_password").val() === "") {
        $(".error-confirm-password").fadeIn("slow");
        validation_failed = true;
    } else {
        if ($("#password").val() != $("#confirm_password").val()) {
            $(".error-confirm-password-match").fadeIn("slow");
            validation_failed = true;
        }
    }

    if (validation_failed) {
        return false;
    }

    var user_id = $("#user_id").val();
    var password = $("#password").val();
    $.post("update", {
        user_id: user_id,
        password: password},
            function (response) {
                var data = JSON.parse(response);
                if (data.result == '0') {
                    $("#alert-reset-password").fadeIn("slow");
                } else {
                    new PNotify({
                        title: 'Cambio de Contraseña',
                        text: '<br>La contraseña se cambio exitosamente!',
                        addclass: 'stack-modal alert-success',
                        stack: {'dir1': 'down', 'dir2': 'right', 'modal': true},
                        type: 'success',
                        styling: 'fontawesome',
                        confirm: {
                            confirm: true,
                            buttons: [{
                                    text: 'Aceptar',
                                    click: function (notice) {
                                        $.redirect('../login');
                                    }
                                }, null]
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
            });
}

function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
}




