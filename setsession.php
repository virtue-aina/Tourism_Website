
<?php
// Start the session
session_start();

// Set the session save path
ini_set("session.save_path", "./home/unn_22016723/sessionData");

// Check if the session is active
if (session_status() !== PHP_SESSION_ACTIVE) {
    // If the session is not active, redirect to the login page
    header('location:./index.php'); 
}


?>