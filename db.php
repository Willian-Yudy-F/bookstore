<?php
// Database settings come from the environment. Never commit real credentials.
$host = getenv('DB_HOST') ?: '127.0.0.1';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: '';
$dbname = getenv('DB_NAME') ?: 'advanced_web';

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    error_log('Database connection failed: ' . mysqli_connect_error());
    http_response_code(503);
    exit('The bookstore is temporarily unavailable. Please try again later.');
}

mysqli_set_charset($conn, 'utf8mb4');
?>
