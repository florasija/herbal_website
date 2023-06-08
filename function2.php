<?php
$conn = mysqli_connect("localhost", "root", "", "herbal_website");
$sql = "SELECT * FROM articles";

function tambah($data)
{
    global $conn;
    $title = htmlspecialchars($data["title"]);
    $content = htmlspecialchars($data["content"]);
    $author_id = htmlspecialchars($data["author_id"]);
    $created_date = htmlspecialchars($data["created_date"]);
    $category_id = htmlspecialchars($data["category_id"]);



    $query = "INSERT INTO articles (title, content, author_id, created_date, category_id) VALUES ('$title','$content','$content','$author_id','$created_date','$category_id')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM articles WHERE article_id = $id");
    return mysqli_affected_rows($conn);
}

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function ubah($data)
{
    global $conn;

    $title = htmlspecialchars($data["title"]);
    $content = htmlspecialchars($data["content"]);
    $author_id = htmlspecialchars($data["author_id"]);
    $created_date = htmlspecialchars($data["created_date"]);
    $category_id = htmlspecialchars($data["category_id"]);

    if (isset($data["article_id"])) {
        $article_id = htmlspecialchars($data["article_id"]);
    } else {
        // lakukan sesuatu jika kunci "ID_kegiatan" tidak ditemukan
        return 0;
    }

    $query = "UPDATE kegiatan SET
                title = '$title',
                content = '$content',
                author_id = '$author_id',
                created_date = '$created_date',
                category_id = '$category_id',
                WHERE article_id = $article_id
                ";

    $result = mysqli_query($conn, $query);

    if ($result) {
        return mysqli_affected_rows($conn);
    } else {
        return 0;
    }
}

function cari($keyword)
{
    global $conn;
    $query = "SELECT * FROM articles WHERE title LIKE '%$keyword%' OR content LIKE '%$keyword%'";

    return mysqli_query($conn, $query);

    // $result = mysqli_query($conn, $query);
    // $rows = [];
    // while ($row = mysqli_fetch_assoc($result)) {
    //     $rows[] = $row;
    // }
    // return $rows;
}

function register($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $email = htmlspecialchars($data["email"]);
    $result = mysqli_query($conn, "SELECT username FROM akun WHERE users = '$username'");


    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO akun VALUES('', '$username', '$password', '$email')");
    return mysqli_affected_rows($conn);
}
