$(document).ready(function () {

    $('#table-topics').DataTable({
        order: [[0, "asc"]],
        columnDefs: [
            {orderable: false, targets: 2}
        ]
    });
});

function show_Topic(topic_id) {
    $.redirect('topics/show', {topic_id: topic_id});
}

//////////////New Topic//////////////////////////////////////////////////////////
function store_NewTopic() {
    if (!$.required('required-topic')) {
        return false;
    }
    $("#newTopicForm").submit();
}
////////////////////////////////////////////////////////////////////////////////

//////////////Form Edit Topic///////////////////////////////////////////////////
function update_Topic() {
    if (!$.required('required-topic')) {
        return false;
    }
    $("#editTopicForm").submit();
}

function edit_Topic(topic_id) {
    $.redirect('topics/edit', {topic_id: topic_id});
}
