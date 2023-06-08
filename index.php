<?php
require 'function.php';
// Query the database to retrieve articles
$articles = query("SELECT articles.*, categories.category_name FROM articles
          INNER JOIN categories ON articles.category_id = categories.category_id");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Halaman Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        a {
            text-decoration: none;
            margin-right: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-links {
            white-space: nowrap;
        }

        .action-links a {
            margin-right: 5px;
        }
    </style>
</head>


<body>
    <h1>hygieia</h1>
    <a href="add_article_ai.php">Tambah Article</a>
    <a href="create_user_account.php">Create User Account</a>
    <a href="create_doctor_account.php">Create Doctor Account</a>
    <table>
        <tr>
            <th>No.</th>
            <th>Action</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Date Published</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($articles as $row): ?>
        <tr>
            <td><?= $i; ?></td>
            <td class="action-links">
                <a href="function.php">ubah</a>
                <a href="function.php">hapus</a>
            </td>
            <td><?= $row["title"]; ?></td>
            <td><?= $row["author_id"]; ?></td>
            <td><?= $row["category_name"]; ?></td>
            <td><?= $row["created_date"]; ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>
</html>