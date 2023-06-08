<?php
session_start();

// Check if the user is already authenticated
if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    // Redirect to the appropriate dashboard based on the user's role
    if ($_SESSION['role'] === 'user') {
        header("Location: user_dashboard.php");
    } else if ($_SESSION['role'] === 'admin') {
        header("Location: admin_dashboard.php");
    }
    exit();
}

// Database connection
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "herbal_website";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Get user input from the form
$email = $_POST['email'];
$password = $_POST['password'];
$loginAs = $_POST['login_as'];

// Sanitize the input
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);

// Determine the table based on the selected login option
$table = ($loginAs === 'user') ? 'users' : 'doctors';

// Query to fetch user data from the appropriate table
global $role;
$query = "SELECT * FROM doctors,users WHERE email='$email' AND role='$role' LIMIT 1";
$result = mysqli_query($conn, $query);

// Check if the user exists and the password is correct
if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    if (password_verify($password, $user['password'])) {
        // Password is correct, set session variables or tokens for authentication
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role'];

        // Redirect to the appropriate page based on the user's role
        if ($loginAs === 'user') {
            header("Location: user_dashboard.php");
        } else {
            header("Location: admin_dashboard.php");
        }
        exit();
    }
}

// Invalid email or password
$_SESSION['login_error'] = "Invalid email or password";
header("Location: login.php");
exit();

?>