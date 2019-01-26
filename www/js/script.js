$(document).ready(function() {
    $('#tasks-table').DataTable({
        searching: false,
        processing: true,
        serverSide: true,
        ajax: "/ajax/tasks/",
        columns: [
            { "data": "id" },
            { "data": "email" },
            { "data": "name" },
            { "data": "status" },
            { "data": "task" }
        ],
        lengthChange: false,
        pageLength: 3
    });
} );