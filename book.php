<?php 
include 'db.php'; 
include 'navbar.php'; 

$id = $_GET['id'];
$sql = "SELECT * FROM books WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id); // "i" = integer
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$book = mysqli_fetch_assoc($result);
?>
<div style="font-family: Arial; padding: 20px;">
    <p><a href="index.php">Home</a> > Detalhes > <?php echo $book['title']; ?></p>
    <div style="display: flex; gap: 30px;">
        <img src="images/<?php echo $book['image']; ?>" style="width: 300px; border: 1px solid #eee;">
        <div>
            <h1><?php echo $book['title']; ?></h1>
            <h3>Autor: <?php echo $book['author']; ?></h3>
            <p><strong>Descrição:</strong> <?php echo $book['description']; ?></p>
            <p style="color: #666; font-size: 0.9em;">ID do Produto: #<?php echo $book['id']; ?> (Metadata)</p>
        </div>
    </div>
</div>
