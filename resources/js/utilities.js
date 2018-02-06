$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();

    $(".alert-success").fadeTo(8000, 500).slideUp(1000, function () {
        //$("#success-alert").slideUp(500);
    });
    
      $(".date_mask").mask("9999-99-99");
   

    $('.datepicker').daterangepicker({
        locale: {
            format: 'YYYY/MM/DD'
        },
        singleDatePicker: true,
        singleClasses: "picker_1"
    }, function (start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
    });

    $('.datepicker-range').daterangepicker({
        locale: {
            format: 'YYYY/MM/DD'
        },
        minDate: new Date()
    }, function (start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
    });

    $('.datetimepicker').datetimepicker({
        format: 'YYYY/MM/DD hh:mm A',
        ignoreReadonly: true
    });

    $('.integer').validCampoFranz('0123456789');
    $('.float').validCampoFranz('0123456789.');
});

function confirmDialog(title, message, action) {

    $.confirm({
        title: title,
        content: message,
        buttons: {
            confirm: function () {
                $.alert('Confirmed!');
            },
            cancel: function () {
                $.alert('Canceled!');
            },
            somethingElse: {
                text: 'Something else',
                btnClass: 'btn-blue',
                keys: ['enter', 'shift'],
                action: function () {
                    $.alert('Something else?');
                }
            }
        }
    });

}



function imageSizeValidator(id, max_width, min_width, max_height, min_height, div_ext, div_size) {

    var ImageValidate = document.getElementById(id);
    //Validate image dimensions
    var reader = new FileReader();
    reader.readAsDataURL(ImageValidate.files[0]);
    reader.onload = function (e) {
        var image = new Image();
        image.src = e.target.result;
        image.onload = function () {
            var height = this.height;
            var width = this.width;
//            console.log("Img " + id + " Height " + height + " Widht " + width);
//            console.log("Limits Max Height " + max_height + " Max Widht " + max_width + " Min Height " + min_height + " Min Width " + min_width);
            if ((width < min_width || width > max_width) || (height < min_height || height > max_height)) {
                $("#" + id).addClass('error-file');
                $("." + div_size).show();
            } else {
                $("#" + id).removeClass('error-file');
            }
        };
    }
}

function fileExtentionValidator(id, allowed_extensions) {
    var ext = $("#" + id).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, allowed_extensions) == -1) {
        return false;
    } else {
        return true;
    }
}