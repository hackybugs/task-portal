<?php

if ($page === 'admin_dashboard') {
    require 'views/admin/dashboard.php';
}

if ($page === 'create_user') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $first_name = $_POST['first_name'];
        $last_name  = $_POST['last_name'];
        $email      = $_POST['email'];
        $phone      = $_POST['phone'];
        $use_md5    = isset($_POST['use_md5']) ? true : false;

        $password = $_POST['password'] ?? '';
        if (isset($_POST['auto_generate'])) {
            $password = generateRandomPassword();
        }

        $hashedPassword = hashPassword($password, $use_md5);

        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, phone, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$first_name, $last_name, $email, $phone, $hashedPassword]);

        $_SESSION['success'] = "User created successfully.";
        redirect('?page=user_list');
    }

    require 'views/admin/create_user.php';
}

if ($page === 'user_list') {
    $stmt = $pdo->query("SELECT * FROM users ORDER BY id DESC");
    $users = $stmt->fetchAll();

    require 'views/admin/user_list.php';
}
if ($page === 'task_list') {
    $stmt = $pdo->query("SELECT t.*, u.first_name, u.last_name FROM tasks t JOIN users u ON u.id = t.user_id ORDER BY t.start_time DESC");
    $tasks = $stmt->fetchAll();

    require 'views/admin/task_list.php';
}
if ($page === 'report') {
    if (isset($_GET['action']) && $_GET['action'] === 'download') {
        // Generate and download CSV
        $stmt = $pdo->query("SELECT users.first_name, users.last_name, tasks.start_time, tasks.stop_time, tasks.notes, tasks.description
                             FROM tasks 
                             INNER JOIN users ON tasks.user_id = users.id
                             ORDER BY tasks.start_time DESC");
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="task_report.csv"');

        $output = fopen('php://output', 'w');

        // Add CSV Header
        fputcsv($output, ['First Name', 'Last Name', 'Start Time', 'Stop Time', 'Notes', 'Description']);

        // Add Data Rows
        foreach ($tasks as $task) {
            fputcsv($output, [
                $task['first_name'],
                $task['last_name'],
                $task['start_time'],
                $task['stop_time'],
                $task['notes'],
                $task['description'],
            ]);
        }
        fclose($output);
        exit;
    }

    // Normal page (if user just visits ?page=report)
    require 'views/admin/report.php';
}


