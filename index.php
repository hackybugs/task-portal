<?php
// index.php - Main Router

session_start();

require_once 'config/db.php';
require_once 'helpers/functions.php';

// Password update check middleware for users
if (isset($_SESSION['role']) && $_SESSION['role'] === 'user' && !in_array($_GET['page'] ?? '', ['change_password', 'logout'])) {
    $stmt = $pdo->prepare("SELECT last_password_change, is_first_login FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    $lastChange = strtotime($user['last_password_change']);
    $daysSinceChange = (time() - $lastChange) / (60 * 60 * 24);

    if ($user['is_first_login'] || $daysSinceChange > 30) {
        header('Location: ?page=change_password');
        exit;
    }
}

$page = $_GET['page'] ?? 'login';
switch ($page) {
    case 'login':
        require 'controllers/AuthController.php';
        break;
    case 'logout':
        require 'logout.php';
        break;
    case 'admin_dashboard':
    case 'create_user':
    case 'user_list':
    case 'task_list':
    case 'report':
        require 'middlewares/auth.php';
        require 'controllers/AdminController.php';
        break;
    case 'user_dashboard':
    case 'create_task':
    case 'edit_task':
    case 'change_password':
        require 'middlewares/auth.php';
        require 'controllers/UserController.php';
        break;
    default:
        echo "Page not found";
        break;
}
// Finally, load layout
require 'views/partials/layout.php';
