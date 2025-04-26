<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task List</title>
</head>
<body>
    <h2>All Submitted Tasks</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>User</th>
            <th>Start Time</th>
            <th>Stop Time</th>
            <th>Notes</th>
            <th>Description</th>
        </tr>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= $task['first_name'] . ' ' . $task['last_name'] ?></td>
                <td><?= $task['start_time'] ?></td>
                <td><?= $task['stop_time'] ?></td>
                <td><?= $task['notes'] ?></td>
                <td><?= $task['description'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
