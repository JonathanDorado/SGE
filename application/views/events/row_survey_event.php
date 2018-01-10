<tr id="survey-row-<?php echo $row; ?>" class="survey-row">
    <td>
        <input id="event_survey_<?php echo $row; ?>" type="hidden" class="form-control" name="event_survey[]" value="">
        <input id="question_<?php echo $row; ?>" type="text" class="form-control required-survey" name="question[]" value="<?php echo (isset($topic)) ? $topic[0]->name : set_value('name'); ?>" required>
    </td>
    <td class="text-center">
        <a href='#' onclick="removeRowSurveyEvent('survey-row-<?php echo $row; ?>')" class='btn btn-danger '><i  class='fa fa-trash-o'></i></a>
    </td>
</tr>

<script>
    function removeRowSurveyEvent(id) {
        $("#" + id).remove();
    }
</script>