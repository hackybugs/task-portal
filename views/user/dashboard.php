<h2>User Dashboard</h2>
<a href="?page=create_task">Create New Task</a>
<table border="1" cellpadding="5">
    <tr>
        <th>Start Time</th>
        <th>Stop Time</th>
        <th>Notes</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?= $task['start_time'] ?></td>
            <td><?= $task['stop_time'] ?></td>
            <td><?= $task['notes'] ?></td>
            <td><?= $task['description'] ?></td>
            <td><a href="?page=edit_task&id=<?= $task['id'] ?>">Edit</a></td>
        </tr>
    <?php endforeach; ?>
</table>