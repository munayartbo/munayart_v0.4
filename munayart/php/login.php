<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar los datos enviados por el formulario
    $user = $_POST["user"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    //Cptcha
    $captcha = $_POST["g-recaptcha-response"];
    $secretkey= "6Lflbz8qAAAAAA3aBKYA69jVHBkwmv6Cetg2FnKA";
    $respuesta= file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha");

    $atributos= json_decode($respuesta, true);
    
    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT * FROM Usuario WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();  

    if ($result->num_rows > 0) {
        // Obtener los datos del usuario
        $row = $result->fetch_assoc();
        
        // Verificar la contraseña ingresada con la almacenada (encriptada)
        if(!$atributos["success"]){
            echo "<script>alert('Captcha No Valido');</script>";
        }else{
            if (password_verify($password, $row['Pass'])) {
                // Inicio de sesión exitoso
    
                // Iniciar sesión (por ejemplo, usando sesiones)
                session_start();
                $_SESSION['user_id'] = $row['CodUsuario'];  // Almacena el ID del usuario en la sesión
                $_SESSION['user_name'] = $row['Nombre'];    // Almacena el nombre en la sesión
    
                // Redirigir a una página de inicio o dashboard
                header("Location: ../views/productos.php");
                exit();
    
            } else {
                // Contraseña incorrecta
                echo "<script>
                    alert('Contraseña incorrecta');
                    window.location.href = '../views/index.php';
                    </script>";
                exit();
            }
        }
        
    } else {
        // Usuario no encontrado
        echo "<script>alert('Usuario no encontrado');</script>";
    }

    // Cerrar la conexión a la base de datos
    $stmt->close();
    $conn->close();
}
?>
