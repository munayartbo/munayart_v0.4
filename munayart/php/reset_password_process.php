<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST["token"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    if ($new_password === $confirm_password) {
        // Verificar si el token es válido
        $stmt = $conn->prepare("SELECT * FROM Usuario WHERE reset_token = ? AND reset_expiration > NOW()");
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);

            // Cerrar el primer statement antes de usar otro
            $stmt->close();

            // Actualizar la contraseña
            $stmt = $conn->prepare("UPDATE Usuario SET Pass = ?, reset_token = NULL, reset_expiration = NULL WHERE reset_token = ?");
            if ($stmt === false) {
                die("Error en la preparación de la consulta de actualización: " . $conn->error);
            }
            $stmt->bind_param("ss", $new_password_hash, $token);
            $stmt->execute();

            echo "<script>
                    alert('Tu contraseña ha sido restablecida exitosamente');
                    window.location.href = '../views/index.php';
                    </script>";
                exit();
        } else {
            echo "<script>alert('El enlace de restablecimiento es inválido o ha expirado');</script>";
        }
    } else {
        echo "<script>alert('Las contraseñas no coinciden');</script>";
    }

    // Cerrar el statement y la conexión
    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();
}
?>
