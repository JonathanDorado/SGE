// Toggle Function
$('.toggle').click(function () {
    // Switches the Icon
    $(this).children('i').toggleClass('fa-pencil');
    // Switches the forms  
    $('.form').animate({
        height: "toggle",
        'padding-top': 'toggle',
        'padding-bottom': 'toggle',
        opacity: "toggle"
    }, "slow");
});

function validate(login_type) {
    $(".error-message").hide();
    $("#alert-ccs").hide();
    $("#alert-client").hide();

    if (login_type === 1) {

        var validation_failed = false;
        if ($("#email").val() === "" || !isValidEmailAddress($("#email").val())) {
            $(".error-email").fadeIn("slow");
            validation_failed = true;
        }

        if ($("#password").val() === "") {
            $(".error-password").fadeIn("slow");
            validation_failed = true;
        }

        if (validation_failed) {
            return false;
        }

        var email = $("#email").val();
        var password = $("#password").val();
        $.post("login/validate", {
            login_type: login_type,
            email: email,
            password: password},
                function (response) {
                    var data = JSON.parse(response);
                    switch (data.result) {
                        case 0:
                            $("#alert-ccs").fadeIn("slow");
                            break;
                        case 1:
                            $.redirect('home');
//                            $.redirect('event/checkStateEventsByDate');
                            break;
                        case 3:
                            $.redirect('password/edit', {user_id: data.user_id});
                            break;
                    }
                });
    } else {

        if ($("#document_number").val() === "") {
            $(".error-document").fadeIn("slow");
            return false;
        }

        var document_number = $("#document_number").val();
        $.post("login/validate", {
            login_type: login_type,
            document_number: document_number},
                function (response) {
                    var data = JSON.parse(response);
                    switch (data.result) {
                        case 0:
                            $("#alert-client").fadeIn("slow");
                            break;
                        case 1:
                            $.redirect('mycourses');
                            break;
                    }
                });
    }
}

//////////////Close sesion///////////////////////////////////////////////////
function closeSession() {
    $.redirect('login/closeSession');
}

function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
}




