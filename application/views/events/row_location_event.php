<tr id="location-row-<?php echo $row; ?>" class="location-row">
    <td class="text-center">
        <select class="form-control required-step-2" id="city_<?php echo $row; ?>" name="city[]">
            <option value="">Selecciona...</option>
            <?php
            foreach ($cities as $city) {
                echo "<option value='$city->city_id'>" . $city->name . "</option>";
            }
            ?>
        </select>
    </td>
    <td class="text-center">
        <input class="form-control required-step-2" id="place_<?php echo $row; ?>" name="place[]">
    </td>
    <td class="text-center">
        <fieldset>
            <div class="control-group">
                <div class="controls">
                    <div class="input-prepend input-group">
                        <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                        <input readonly type="text" id="date_location_<?php echo $row; ?>" name="date_location[]" class="form-control required-step-2 datepicker-range" value="<?php echo date('Y/m/d'); ?> - <?php echo date('Y/m/d'); ?>" />
                    </div>
                </div>
            </div>
        </fieldset>
    </td>
    <td class="text-center">
        <input class="form-control required-step-2 integer" maxlength="3" id="total_hours_<?php echo $row; ?>" name="total_hours[]">
    </td>
    <td class="text-center">
        <a href='#' onclick="removeRowLocationEvent('location-row-<?php echo $row; ?>')" class='btn btn-danger btn-xs'><i  class='fa fa-trash-o'></i></a>
    </td>
</tr>

<script>
    $(function () {
        $('.datepicker-range').daterangepicker({
            locale: {
                format: 'YYYY/MM/DD'
            },
            minDate: new Date()
        }, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });

//        $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});

        $('.integer').validCampoFranz('0123456789');
        $('.float').validCampoFranz('0123456789.');
    });

    function removeRowLocationEvent(id) {
        $("#" + id).remove();
    }
</script>