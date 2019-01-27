<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/datatables.min.css"/>

    <title>Simple Tasks!</title>
</head>
<body>
<div class="container">
    <h1>Simple tasks!</h1>
    <div class="row justify-content-end">
        <div class="col-sm-2">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#createTaskModal">Create Task</button>
        </div>
    </div>
    <table id="tasks-table-admin" class="stripe" style="width:100%">
        <thead>
        <tr>
            <th>#</th>
            <th>Email</th>
            <th>Name</th>
            <th>Status</th>
            <th>Task</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="updateTaskModal" tabindex="-1" role="dialog" aria-labelledby="createTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTaskModalLabel">Create New Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="create-task-form">
                <input type="hidden" name="id" id="taskId" value="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="task">Task</label>
                        <textarea class="form-control" id="task" name="task" rows="3" required></textarea>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="statusCheck">
                        <label class="form-check-label" for="statusCheck">Done</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/datatables.min.js"></script>
<script type="text/javascript" src="/js/script.js"></script>
</body>
</html>