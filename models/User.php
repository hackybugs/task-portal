<?php
// models/UserModel.php

function getUserByEmail($pdo, $email) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch();
}

function getUserById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function updateLastLogin($pdo, $id) {
    $stmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
    $stmt->execute([$id]);
}

function updatePassword($pdo, $id, $hashedPassword) {
    $stmt = $pdo->prepare("UPDATE users SET password = ?, last_password_change = NOW(), is_first_login = 0 WHERE id = ?");
    $stmt->execute([$hashedPassword, $id]);
}
