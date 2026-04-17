<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    // Criptografa a senha antes de salvar
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$pass')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: login.php");
    }
}
?>

<head>
    <meta charset="UTF-8">
    <title>Digital Bookstore</title>
    <style>
        /* COLE O CÓDIGO AQUI DENTRO */
        :root {
            --primary: #2563eb;
            --dark: #1e293b;
            --light: #f8fafc;
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }
        /* ... restante do código que te enviei ... */
    </style>
</head>