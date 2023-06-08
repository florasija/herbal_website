<!DOCTYPE html>
<html>
<head>
    <title>Create new article</title>
</head>
<body>
    <h1>Create new article</h1>
    <form method="POST" action="add_article_ai.php">
        <label for="title">titlte:</label>
        <input type="text" name="title" id="title" required><br><br>
        <label for="content">content:</label>
        <input type="text" name="content" id="content" required><br><br>
        <label for="author_id">author_id:</label>
        <input type="author_id" name="auhor_id" id="author_id" required><br><br>

        <label for="category_id">category id:</label>
        <input type="category_id" name="category_id" id="category_id" required><br><br>
        <input type="submit" value="Create new article">
    
    </form>
</body>
</html>
