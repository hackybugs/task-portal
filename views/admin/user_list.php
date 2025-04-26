<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User List</title>
</head>
<body>
    <h2>All Users</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id']; ?></td>
                <td><?= $user['first_name'] . ' ' . $user['last_name']; ?></td>
                <td><?= $user['email']; ?></td>
                <td><?= $user['phone']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
