(function ($) {
    $.required = function (required) {
        var r = true;
        var msg = '';
        $("." + required).removeClass('input-error');
        $.each($("." + required), function () {
            if ($.trim($(this).val()) == '') {
                $(this).addClass('input-error');
                msg += $('label[for=' + $(this).attr('id') + ']').html() + "\n";
            }
        });
        if ($('.input-error').length > 0) {
            r = false;
            new PNotify({
                title: 'Error en Formulario',
                text: 'Hay campos incompletos!',
                type: 'error',
                styling: 'bootstrap3'
            });
        }
        return r;
    };
})(jQuery);

function mensajeError(title, msg) {
    var caja = $('<div id="mensaje_error" title="' + title + '"><b>' + msg + '</b></center></div>');
    caja.dialog({modal: true, width: 'auto',
        buttons: {
            Aceptar: function () {
                $(this).dialog("close");
                $('#mensaje_error').remove();
            }
        }
    });
}


(function (a) {
    a.fn.validCampoFranz = function (b) {
        a(this).keypress(function (a) {
            var c = a.which,
                    d = a.keyCode,
                    e = String.fromCharCode(c).toLowerCase(),
                    f = b;
            (-1 != f.indexOf(e) || 9 == d || 37 != c && 37 == d || 39 == d && 39 != c || 8 == d || 46 == d && 46 != c) && 161 != c || a.preventDefault()
        });
    }
})(jQuery);


(function ($) {
    $.toggleDisabled = function (state, toggleDisabled) {
        //alert('entro');
        var i = 1;
        $.each($("." + toggleDisabled), function () {

            $(this).prop('disabled', state);
            //alert(i);
            i++;
        });
        //alert(i);
    };
})(jQuery);