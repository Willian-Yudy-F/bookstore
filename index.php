<?php 
// Inicia a sessão - Necessário para mostrar "Welcome, User" (Feedback da prof!)
if (session_status() === PHP_SESSION_NONE) { session_start(); }

include 'db.php'; 
include 'navbar.php'; 

// 1. Lógica de Filtro e Busca - Atende ao requisito de "Search & Category filtering"
$genre = isset($_GET['genre']) ? mysqli_real_escape_string($conn, $_GET['genre']) : '';
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

$sql = "SELECT * FROM books WHERE 1=1";
if ($genre) { $sql .= " AND genre = '$genre'"; }
if ($search) { $sql .= " AND title LIKE '%$search%'"; }

// O brief exige ordem aleatória na Home
$sql .= " ORDER BY RAND() LIMIT 4"; 
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booktopia Style | Digital Bookstore</title>
    <style>
        /* VARIÁVEIS DE CORES - Deixa o site com cara de sistema profissional */
        :root {
            --primary: #2563eb;    /* Azul Booktopia */
            --accent: #e41e26;     /* Vermelho para preços/destaques */
            --dark: #1e293b;
            --light: #f8fafc;
            --border: #e2e8f0;
        }

        body { font-family: 'Segoe UI', Roboto, sans-serif; background-color: var(--light); margin: 0; color: var(--dark); }

        /* HEADER & SEARCH - Melhora a UI básica criticada pela prof */
        .hero { background: white; padding: 40px 20px; text-align: center; border-bottom: 1px solid var(--border); }
        .search-container input { padding: 12px; width: 350px; border: 1px solid var(--border); border-radius: 4px; }
        .search-container button { padding: 12px 25px; background: var(--primary); color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }

        /* LAYOUT PRINCIPAL (SIDEBAR + CONTENT) - Igual ao Booktopia */
        .main-layout { display: flex; max-width: 1200px; margin: 30px auto; gap: 30px; padding: 0 20px; }
        
        /* SIDEBAR - Atende ao requisito de Category Filtering */
        .sidebar { width: 250px; background: white; padding: 20px; border-radius: 8px; height: fit-content; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .sidebar h3 { font-size: 1.1rem; border-bottom: 2px solid var(--primary); padding-bottom: 10px; margin-top: 0; }
        .sidebar ul { list-style: none; padding: 0; }
        .sidebar li { margin: 12px 0; }
        .sidebar a { text-decoration: none; color: #444; font-size: 0.95rem; transition: 0.3s; }
        .sidebar a:hover { color: var(--primary); padding-left: 5px; }

        /* GRADE DE LIVROS */
        .content { flex: 1; }
        .book-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 25px; }
        
        /* CARTÃO DO LIVRO - Estilo Profissional */
        .book-card { background: white; border: 1px solid var(--border); padding: 15px; border-radius: 4px; transition: 0.3s; position: relative; }
        .book-card:hover { box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); transform: translateY(-3px); }
        .book-card img { width: 100%; height: 280px; object-fit: contain; margin-bottom: 15px; }
        .book-card h3 { font-size: 1rem; margin: 10px 0; height: 2.5em; overflow: hidden; color: var(--dark); }
        .book-card p { color: #64748b; font-size: 0.85rem; margin: 5px 0; }
        
        .genre-tag { font-size: 0.75rem; background: #eff6ff; color: var(--primary); padding: 2px 8px; border-radius: 10px; font-weight: bold; }
        .btn { background: var(--primary); color: white; padding: 10px; text-decoration: none; border-radius: 4px; display: block; text-align: center; margin-top: 15px; font-weight: bold; font-size: 0.9rem; }
        .btn:hover { background: #1d4ed8; }
    </style>
</head>
<body>

    <header class="hero">
        <h1>Digital Bookstore</h1>
        <p>Inspired by Booktopia - Quality Books for Everyone</p>
        
        <div class="search-container">
            <form action="index.php" method="GET">
                <input type="text" name="search" placeholder="Search by title, author..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit">Search</button>
            </form>
        </div>
    </header>

    <div class="main-layout">
        <aside class="sidebar">
            <h3>Categories</h3>
            <ul>
                <li><a href="index.php">All Books</a></li>
                <li><a href="index.php?genre=Fiction">Fiction</a></li>
                <li><a href="index.php?genre=Non-Fiction">Non-Fiction</a></li>
                <li><a href="index.php?genre=Romance">Romance</a></li>
                <li><a href="index.php?genre=Thriller">Thriller</a></li>
                <li><a href="index.php?genre=Finance">Finance</a></li>
            </ul>
        </aside>

        <main class="content">
            <h2 style="margin-top:0;">
                <?php echo $genre ? "Category: " . htmlspecialchars($genre) : "Featured Products"; ?>
            </h2>

            <div class="book-grid">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while($book = mysqli_fetch_assoc($result)) {
                        $imagePath = "images/" . $book['image'];
                        $displayImage = (!empty($book['image']) && file_exists($imagePath)) ? $imagePath : "https://via.placeholder.com/200x300?text=No+Cover";
                        
                        echo "<div class='book-card'>";
                        echo "<img src='$displayImage' alt='Book Cover'>";
                        if(isset($book['genre'])) {
                            echo "<span class='genre-tag'>" . htmlspecialchars($book['genre']) . "</span>";
                        }
                        echo "<h3>" . htmlspecialchars($book['title']) . "</h3>";
                        echo "<p>By: " . htmlspecialchars($book['author']) . "</p>";
                        echo "<a href='book.php?id=" . $book['id'] . "' class='btn'>View Details</a>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='container'><p>No books found matching your criteria.</p><a href='index.php'>Back to Home</a></div>";
                }
                ?>
            </div>
        </main>
    </div>

</body>
</html>