<?php
// Log out and return to the home page
session_start();
session_destroy();
header("Location: index.php");
exit();
?>
