<?php
include 'db_connection.php'; // Asegúrate de tener la conexión a la base de datos

// Obtén el nombre de usuario enviado por AJAX
if (isset($_GET['username'])) {
    $username = $conn->real_escape_string($_GET['username']);
    
    $sql = "SELECT * FROM Usuario WHERE User = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo 'taken'; // El nombre de usuario ya está en uso
    } else {
        echo 'available'; // El nombre de usuario está disponible
    }

    $conn->close();
}
?>
