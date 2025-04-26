<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        $error = "Email and Password are required!";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && verifyPassword($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = ($user['email'] === 'admin@admin.com') ? 'admin' : 'user';

            // Update last_login
            $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?")->execute([$user['id']]);

            // Redirect based on role
            if ($_SESSION['role'] === 'admin') {
                redirect('?page=admin_dashboard');
            } else {
                // Check password expiry
                if ($user['is_first_login'] || isPasswordExpired($user['last_password_change'])) {
                    redirect('?page=change_password');
                }
                redirect('?page=user_dashboard');
            }
        } else {
            $error = "Invalid credentials!";
        }
    }
}

require 'views/auth/login.php';
