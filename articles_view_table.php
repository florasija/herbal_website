<?php
// Establish a database connection
$servername = "127.0.0.1";
$username = "root";
$password = '';
$dbname = "herbal_website";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Query the database to retrieve articles
$query = "SELECT articles.*, categories.category_name FROM articles
          INNER JOIN categories ON articles.category_id = categories.category_id";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error retrieving articles: " . mysqli_error($conn));
}

// Display the articles in a table
?>

<!DOCTYPE html>
<html>
<head>
    <title>Articles content</title>
    <!-- Add any necessary CSS styles -->
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Articles content</h1>

    <table>
        <tr>
            <th>Title</th>
            <th>content</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['content']; ?></td>
            </tr>
        <?php } ?>

    </table>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
