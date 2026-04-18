<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h2>Teste PHP</h2>";

include 'db.php';

if ($conn) {
    echo "<p style='color:green'>✅ Banco de dados conectado!</p>";
} else {
    echo "<p style='color:red'>❌ Erro de conexão: " . mysqli_connect_error() . "</p>";
}

echo "<p>PHP versão: " . phpversion() . "</p>";

$result = mysqli_query($conn, "SHOW TABLES");
echo "<p>Tabelas no banco:</p><ul>";
while ($row = mysqli_fetch_array($result)) {
    echo "<li>" . $row[0] . "</li>";
}
echo "</ul>";
?>
