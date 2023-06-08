<?php
// Database connection details
$servername = "127.0.0.1";
$username = "root";
$password = '';
$dbname = "herbal_website";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the form data
$title = $_POST["title"];
$content = $_POST["content"];
$category_id = $_POST["category_id"];
$author_id = $_POST["author_Id"];

// Prepare the SQL statement
$sql = "INSERT INTO articles (title, content, category_id, author_id) 
        VALUES ('$title', '$content', '$category_id', '$author_id')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "user account created successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
