$(document).ready(() => {
    const table = $('#tasks-table').DataTable({
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

    $('#create-task-form').submit((e) => {
        $.ajax({
            type: "post",
            url: 'ajax/create',
            data: $('#create-task-form').serialize(),
            success: (data) => {
                $('#create-task-form')[0].reset();
                $('#createTaskModal').modal('hide');
                table.ajax.reload();
            }
        });

        e.preventDefault();
    });
} );