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

    const tableAdmin = $('#tasks-table-admin').DataTable({
        searching: false,
        processing: true,
        serverSide: true,
        ajax: "/ajax/tasks/",
        columns: [
            { "data": "id" },
            { "data": "email" },
            { "data": "name" },
            { "data": "status" },
            { "data": "task" },
            { "data" : null}
        ],
        columnDefs: [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button type=\"button\" class=\"btn btn-info\">Edit</button>"
        } ],
        lengthChange: false,
        pageLength: 3
    });

    $('#tasks-table-admin tbody').on( 'click', '.btn-info', function () {
        let data = tableAdmin.row( $(this).parents('tr') ).data();
        $.ajax({
            url: '/admin/task/?id=' + data.id,
            success: (data) => {
                $('#updateTaskModal').modal('show');
                $('#taskId').attr("value", data.task.id);
                $('#task').text(data.task.task);
                if (data.task.status == 'done') {
                    $('#statusCheck').attr('checked', true);
                } else {
                    $('#statusCheck').attr('checked', false);
                }
            }
        })
    } );


    $('#update-task-form').submit((e) => {
        $.ajax({
            type: "post",
            url: '/admin/update',
            data: $('#update-task-form').serialize(),
            success: (data) => {
                $('#update-task-form')[0].reset();
                $('#updateTaskModal').modal('hide');
                tableAdmin.ajax.reload();
            }
        });

        e.preventDefault();
    });

} );