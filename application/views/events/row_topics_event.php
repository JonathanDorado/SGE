<tr id="assign-topics-row-<?php echo $row; ?>" class="assign-topics-row">
    <td>
        <select class="form-control required-assign-topics" onchange="chargeInstructorsByTopic(this.id, <?php echo $row; ?>)" id="topic-<?php echo $row; ?>" name="topic[]">
            <option value="">Selecciona...</option>
            <?php
            foreach ($topics as $topic) {
                echo "<option thematic_area_type='$topic->thematic_area_type_id' value='$topic->topic_id'>" . $topic->name . "</option>";
            }
            ?>
        </select>
    </td>
    <td>
        <select class="form-control required-assign-topics" id="instructor-<?php echo $row; ?>" name="instructor[]">
            <option value="">Selecciona...</option>
        </select>
    </td>
    <td>
        <fieldset>
            <div class="control-group">
                <div class="controls">
                    <div class="input-prepend input-group">
                        <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                        <input readonly="" type="text" name="date_hour[]" class="form-control required-assign-topics datetimepicker" value="<?php echo date("Y/m/d H:i"); ?>" id="date-hour-<?php echo $row; ?>" />

                    </div>
                </div>
            </div>
        </fieldset>
    </td>
    <td>
        <input type="file" class="form-control required-assign-topics" id="memories-<?php echo $row; ?>" onchange="memoriesValidator(this.id, 'error-memories-ext-<?php echo $row; ?>')" name="memories[]">
        <div class="error-message error-memories-ext-<?php echo $row; ?>">*Verifica la extensión del archivo</div>
    </td>
    <td></td>
    <td class="text-center">
        <a href='#' onclick="removeRowAssignTopicsEvent('assign-topics-row-<?php echo $row; ?>')" class='btn btn-danger dropdown-toggle btn-sm'><i  class='fa fa-trash-o'></i></a>
    </td>
</tr>

<script>
    $(function () {
        $('.integer').validCampoFranz('0123456789');
        
        $('.datetimepicker').datetimepicker({
        format: 'YYYY/MM/DD hh:mm A',
        ignoreReadonly: true
    });
    });
    
    

    function removeRowAssignTopicsEvent(id) {
        $("#" + id).remove();
    }
</script>