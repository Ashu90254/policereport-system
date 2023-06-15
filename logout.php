<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION["name"])) {
    // User is logged in, perform logout

    // Clear all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect the user to the login page or any other desired page
    header("Location: index");
    exit();
}