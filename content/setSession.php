<?php
// Create a sessions directory if it doesn't exist
$sessionDir = __DIR__ . '/sessions';
if (!file_exists($sessionDir)) {
    mkdir($sessionDir, 0777, true);
}

// Set the session save path
ini_set("session.save_path", $sessionDir);

// Start the session
session_start();

// Only redirect if we're not already on the index page
$currentPage = basename($_SERVER['PHP_SELF']);
if (session_status() !== PHP_SESSION_ACTIVE && $currentPage !== 'index.php') {
    header('location:./index.php');
    exit();
}


?>