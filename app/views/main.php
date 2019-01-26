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

    <table id="tasks-table" class="stripe" style="width:100%">
        <thead>
        <tr>
            <th>#</th>
            <th>Email</th>
            <th>Name</th>
            <th>Status</th>
            <th>Task</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tasks as $key => $task):?>
            <tr>
                <td><?php echo $task['id']?></td>
                <td><?php echo $task['email']?></td>
                <td><?php echo $task['name']?></td>
                <td><?php echo $task['status']?></td>
                <td><?php echo $task['task']?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/datatables.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>