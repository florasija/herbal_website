<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    $servername = "127.0.0.1";
    $username = "root";
    $password = '';
    $dbname = "herbal_website";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (mysqli_connect_errno()) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Get user input from the form
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Sanitize the input
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to fetch user data from the appropriate table
    $query = "SELECT * FROM doctors, users WHERE doctors.email='$email' AND doctors.role='$role' OR users.email='$email' AND users.role='$role' LIMIT 1";
    $result = mysqli_query($conn, $query);

    // Check if the user exists and the password is correct
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables or tokens for authentication
            $_SESSION['user_id'] = $user['doctor_id'];
            $_SESSION['role'] = $user['role'];

            // Redirect to the appropriate page based on the user's role
            if ($role === 'user') {
                header("Location: user_dashboard.php");
                exit();
            } else if ($role === 'admin') {
                header("Location: admin_dashboard.php");
                exit();
            }
        }
    }

    // Invalid email or password
    $_SESSION['login_error'] = "Invalid email or password";
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php
    if (isset($_SESSION['login_error'])) {
        echo "<p style='color: red;'>" . $_SESSION['login_error'] . "</p>";
        unset($_SESSION['login_error']);
    }
    ?>
    