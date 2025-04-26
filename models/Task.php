<?php
// models/TaskModel.php

function getTasksByUserId($pdo, $userId) {
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ? ORDER BY start_time DESC");
    $stmt->execute([$userId]);
    return $stmt->fetchAll();
}

function getAllTasks($pdo) {
    $stmt = $pdo->query("SELECT t.*, CONCAT(u.first_name, ' ', u.last_name) AS user_name FROM tasks t JOIN users u ON t.user_id = u.id ORDER BY t.created_at DESC");
    return $stmt->fetchAll();
}

function getTaskById($pdo, $id, $userId) {
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $userId]);
    return $stmt->fetch();
}
