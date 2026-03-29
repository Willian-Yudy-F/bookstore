<?php 
include 'db.php'; 
include 'navbar.php'; 
?>

<div style="font-family: Arial; padding: 20px;">
    <h1>Featured Books</h1> 

    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        <?php
        // Seleciona 4 livros aleatórios
        $result = mysqli_query($conn, "SELECT * FROM books ORDER BY RAND() LIMIT 4");

        while($row = mysqli_fetch_assoc($result)) {
            echo "<div style='border: 1px solid #ddd; padding: 15px; width: 200px; text-align: center;'>";
            echo "<img src='images/".$row['image']."' style='width: 100%; height: 250px; object-fit: cover; margin-bottom: 10px;'>";
            echo "<h3>".$row['title']."</h3>";
            
            // Botão em Inglês
            echo "<a href='book.php?id=".$row['id']."' style='background: #007bff; color: white; padding: 5px 10px; text-decoration: none;'>View Details</a>";
            
            echo "</div>";
        }
        ?>
    </div>
</div>
