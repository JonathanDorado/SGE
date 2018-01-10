$(document).ready(function () {

});

//////////////Show course detail///////////////////////////////////////////////////
function show_CourseDetail(event_id, event_client_id) {
    $.redirect('mycourses/show_CourseDetail', {event_id: event_id, event_client_id: event_client_id});
}
