<nav class="main-nav">
    <div class="logo">Booktopia Clone</div>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="sitemap.php">Sitemap</a></li>
        <?php if(isset($_SESSION['user'])): ?>
            <li><a href="favorites.php">My Favorites</a></li>
            <li><a href="account.php">Welcome, <?php echo $_SESSION['username']; ?></a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Sign In</a></li>
            <li><a href="register.php">Register</a></li>
        <?php endif; ?>
    </ul>
</nav>