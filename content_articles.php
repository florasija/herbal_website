<?php
require 'function.php';
// Query the database to retrieve articles
$articles = query("SELECT articles.*, doctors.author_id FROM articles
          INNER JOIN doctors ON articles.doctor_id = categories.doctor_id");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Halaman Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
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
    <h1>Articles</h1>
    <a href="add_article_ai.php">Tambah Article</a>
    <a href="create_user_account.php">Create User Account</a>
    <a href="create_doctor_account.php">Create Doctor Account</a>
    <table>
        <tr>
            <th>title</th>
            <th>content</th>
            <th>Author</th>
        </tr>
        <tr>
            <td class="action-links">
                <a href="function2.php">ubah</a>
                <a href="function2.php">hapus</a>
            </td>
            <td><?= $row["title"]; ?></td>
            <td><?= $row["content"]; ?></td>
            <td><?= $row["category_name"]; ?></td>
            <td><?= $row["created_date"]; ?></td>
        </tr>
    </table>
</body>
</html>
