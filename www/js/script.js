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
            "defaultContent": "<button type=\"button\" class=\"btn btn-info\">Edit</button>&nbsp;&nbsp;<button type=\"button\" class=\"btn btn-danger\">Delete</button>"
        } ],
        lengthChange: false,
        pageLength: 3
    });

    $('#tasks-table-admin tbody').on( 'click', '.btn-info', function () {
        let data = tableAdmin.row( $(this).parents('tr') ).data();
        alert("EDIT:" + data.id);
    } );

    $('#tasks-table-admin tbody').on( 'click', '.btn-danger', function () {
        let data = tableAdmin.row( $(this).parents('tr') ).data();
        alert("DELETE:" + data.id);
    } );
} );