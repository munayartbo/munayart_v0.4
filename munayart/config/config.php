<?php
// Conexión a la base de datos MySQL en localhost:3306
$servername = "localhost";
$username = "root"; // O el nombre de usuario de MySQL
$password = ""; // Tu contraseña de MySQL
$dbname = "munayart"; // Nombre de la base de datos

$conn = new mysqli($servername, $username, $password, $dbname, 3306);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
