<?php
session_start();

// Check if the user is logged in and has the role of user
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    // Redirect to the login page or any other appropriate page
    header("Location: login.php");
    exit();
}

// Display the user dashboard content
echo "Welcome, User!";
// Add your user dashboard content here
?>
