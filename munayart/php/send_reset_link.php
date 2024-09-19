<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Verificar si el correo existe en la base de datos
    $stmt = $conn->prepare("SELECT * FROM Usuario WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $token = bin2hex(random_bytes(50));  // Generar un token único

        // Guardar el token en la base de datos
        $stmt = $conn->prepare("UPDATE Usuario SET reset_token = ?, reset_expiration = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE Email = ?");
        $stmt->bind_param("ss", $token, $email);
        $stmt->execute();

        // Enviar el correo de restablecimiento de contraseña
        $resetLink = "http://localhost/munayart/views/reset_password.php?token=" . $token;
        $subject = "Restablecer Contraseña";
        $message = "Haz clic en el siguiente enlace para restablecer tu contraseña:<br> <a href='" . $resetLink . "'>Restablecer Contraseña</a>";
        $headers = "From: munayart.bo@gmail.com\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";

        if (mail($email, $subject, $message, $headers)) {
            echo "<script>alert('Correo enviado correctamente');</script>";
        } else {
            echo "<script>alert('Error al enviar el correo');</script>";
        }
    } else {
        echo "<script>alert('No se encontró una cuenta con ese correo');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
