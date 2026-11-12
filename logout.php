<?php
// Closes the session and redirects to the home page
session_start();
require_once 'security.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}
require_valid_csrf();
session_destroy();
header("Location: index.php");
exit();
?>
