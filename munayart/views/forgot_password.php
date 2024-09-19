<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <!--<link rel="stylesheet" href="../css/styles.css">-->
    <style>
        *{
            color: #ffff;
        }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #e2e2e2, #467599);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 400px;
            background: linear-gradient(to right, #1D3354, #d64045);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h1 {
            text-align: center;
            margin-bottom: 10px; 
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px; 
        }

        input[type="email"] {
            padding: 10px;
            font-size: 16px;
            margin-bottom: 10px; 
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background-color: #467599;
            padding: 12px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #d64045;
        }

        .note {
            font-size: 14px;
            text-align: center;
            margin-top: 10px; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Recuperar Contraseña</h1>
        <form action="../php/send_reset_link.php" method="POST">
            <label for="email">Introduce tu correo electrónico</label>
            <input type="email" name="email" id="email" placeholder="Correo Electrónico" required>
            <button type="submit">Enviar enlace de restablecimiento</button>
        </form>
        <div class="note">
            <p>Te enviaremos un enlace para restablecer tu contraseña.</p>
        </div>
    </div>
</body>
</html>