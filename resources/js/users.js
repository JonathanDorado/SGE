$(document).ready(function () {

    $('#table-users').dataTable({
        order: [[1, "desc"]],
        columnDefs: [
            {orderable: false, targets: 5}
        ]
    });
});

function show_User(user_id) {
    $.redirect('users/show', {user_id: user_id});
}

//////////////New User//////////////////////////////////////////////////////////
function store_NewUser() {
    if (!$.required('required-user')) {
        return false;
    }
    $("#newUserForm").submit();
}
////////////////////////////////////////////////////////////////////////////////

//////////////Edit User/////////////////////////////////////////////////////////
function update_User() {
    if (!$.required('required-user')) {
        return false;
    }
    $("#editUserForm").submit();
}

function edit_User(user_id) {
    $.redirect('users/edit', {user_id: user_id});
}

function reset_password_User(user_id, Name, Lastname) {

    new PNotify({
        title: 'Reseteo de Contraseña',
        text: '¿Estás seguro de resetear la contraseña del usuario ' + Name + ' ' + Lastname + '?',
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
                        $.post("users/reset_password_User", {user_id: user_id}, function (response) {
                            console.log(data);
                            var data = JSON.parse(response);

                            new PNotify({
                                title: 'Reseteo de Contraseña',
                                text: data.msg,
                                type: 'success',
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

function change_state_User(user_id, State, Name, Lastname) {

    if (State == 1) {
        title = "Activación de Usuario";
        message = "¿Estás seguro de activar el usuario " + Name + " " + Lastname + "?";
    } else {
        title = "Inactivación de Usuario";
        message = "¿Estás seguro de inactivar el usuario " + Name + " " + Lastname + "?";
    }

    new PNotify({
        title: title,
        text: message,
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
                        $.post("users/change_state_User", {user_id: user_id, state: State}, function (response) {
                            console.log(data);
                            var data = JSON.parse(response);

                            new PNotify({
                                title: title,
                                text: data.msg,
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                        });
                        $.redirect('users');
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
