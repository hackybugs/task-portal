<?php

if ($page === 'user_dashboard') {
    var_dump($_SESSION['user_id']);die();
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ? ORDER BY start_time DESC");
    $stmt->execute([$_SESSION['user_id']]);
    $tasks = $stmt->fetchAll();

    require 'views/user/dashboard.php';
}

if ($page === 'create_task') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $stmt = $pdo->prepare("INSERT INTO tasks (user_id, start_time, stop_time, notes, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $_SESSION['user_id'],
            $_POST['start_time'],
            $_POST['stop_time'],
            $_POST['notes'],
            $_POST['description']
        ]);
        $_SESSION['success'] = "Task added successfully.";
        redirect('?page=user_dashboard');
    }
    require 'views/user/create_task.php';
}

if ($page === 'edit_task') {
    $task_id = $_GET['id'] ?? null;
    if (!$task_id) redirect('?page=user_dashboard');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $stmt = $pdo->prepare("UPDATE tasks SET start_time = ?, stop_time = ?, notes = ?, description = ? WHERE id = ? AND user_id = ?");
        $stmt->execute([
            $_POST['start_time'],
            $_POST['stop_time'],
            $_POST['notes'],
            $_POST['description'],
            $task_id,
            $_SESSION['user_id']
        ]);
        $_SESSION['success'] = "Task updated successfully.";
        redirect('?page=user_dashboard');
    }

    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ?");
    $stmt->execute([$task_id, $_SESSION['user_id']]);
    $task = $stmt->fetch();

    if (!$task) redirect('?page=user_dashboard');
    require 'views/user/edit_task.php';
}

if ($page === 'change_password') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];

        if ($newPassword !== $confirmPassword) {
            $error = "Passwords do not match.";
        } else {
            $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET password = ?, last_password_change = NOW(), is_first_login = 0 WHERE id = ?");
            $stmt->execute([$hashed, $_SESSION['user_id']]);
            $_SESSION['success'] = "Password changed successfully.";
            redirect('?page=user_dashboard');
        }
    }
    require 'views/user/change_password.php';
}
