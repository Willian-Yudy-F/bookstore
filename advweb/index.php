<?php 
include 'db.php'; 
include 'navbar.php'; 

// Validar o ID recebido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM books WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $book = mysqli_fetch_assoc($result);
}

if (!$book) {
    echo "<div style='padding:20px;'><h2>Book not found!</h2><a href='index.php'>Go back</a></div>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $book['title']; ?></title>
    <style>
        .container { font-family: Arial, sans-serif; padding: 20px; max-width: 900px; margin: auto; }
        .breadcrumb { margin-bottom: 20px; font-size: 0.9em; color: #666; }
        .book-flex { display: flex; gap: 40px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .book-img img { width: 300px; border-radius: 5px; }
        .metadata { background: #f8f9fa; padding: 15px; border-left: 5px solid #007bff; margin-top: 20px; }
    </style>
</head>
<body>

<div class="container">
    <div class="breadcrumb">
        <a href="index.php" style="color:#007bff; text-decoration:none;">Home</a> > Details > <?php echo $book['title']; ?>
    </div>

    <div class="book-flex">
        <div class="book-img">
            <?php 
            $imagePath = "images/" . $book['image'];
            if (!empty($book['image']) && file_exists($imagePath)) {
                $displayImage = $imagePath;
            } else {
                $displayImage = "https://via.placeholder.com/300x450?text=Cover+Unavailable";
            }
            ?>
            <img src="<?php echo $displayImage; ?>" alt="Cover">
        </div>

        <div class="book-info">
            <h1><?php echo $book['title']; ?></h1>
            <h3>Author: <?php echo $book['author']; ?></h3>
            <p><strong>Description:</strong></p>
            <p><?php echo $book['description']; ?></p>

            <div class="metadata">
                <p><strong>System Metadata:</strong></p>
                <ul>
                    <li>Database ID: #<?php echo $book['id']; ?></li>
                    <li>Reference: BOOK_DATA_<?php echo $book['id']; ?></li>
                </ul>
            </div>
            <br>
            <a href="index.php" style="text-decoration:none; color:#007bff;">← Back to list</a>
        </div>
    </div>
</div>

</body>
</html>
