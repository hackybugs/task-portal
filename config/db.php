<?php
$host = '127.0.0.1';       // or 'localhost'
$db   = 'task_portal';     // use your database name
$user = 'root';            // same as MySQL Workbench login
$pass = 'password';                // same as MySQL Workbench login
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
dd($dsn);
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
