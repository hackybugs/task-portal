<?php

function redirect($url) {
    header("Location: $url");
    exit;
}

function isPasswordExpired($lastChange) {
    if (!$lastChange) return true;
    $days = (strtotime('now') - strtotime($lastChange)) / (60 * 60 * 24);
    return $days > 30;
}

function generateRandomPassword($length = 10) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

function hashPassword($password, $useMd5 = false) {
    return $useMd5 ? md5($password) : password_hash($password, PASSWORD_DEFAULT);
}

function verifyPassword($inputPassword, $storedHash) {
    if (strlen($storedHash) == 32) {
        return md5($inputPassword) === $storedHash;
    }
    return password_verify($inputPassword, $storedHash);
}
