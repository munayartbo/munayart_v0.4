<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

        * {
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        body {
            background: linear-gradient(to right, #e2e2e2, #467599);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 400px;
            background: linear-gradient(to right, #1D3354, #d64045);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #fff;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            text-align: left;
            color: #ddd;
        }

        .password-container {
            position: relative;
            margin-bottom: 15px;
        }

        input[type="password"],
        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            margin-bottom: 10px;
            border: none;
            border-radius: 4px;
            background-color: #eee;
            width: calc(100% - 10px); 
            box-sizing: border-box;
            color: #141212;
        }

        button[type="button"] {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            cursor: pointer;
            color: #141212;
            font-size: 18px;
        }

        button[type="submit"] {
            background-color: #467599;
            padding: 12px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #d64045;
        }

        button:active {
            transform: scale(0.98);
        }

        .note {
            font-size: 14px;
            text-align: center;
            margin-top: 10px;
            color: #ddd;
        }

        .feedback {
            color: #ffcccc;
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 10px;
            text-align: left;
        }

        button[type="button"] i {
            color: #2222;
        }


    </style>
</head>
<body>
    <div class="container">
        <h1>Restablecer Contraseña</h1>
        <form id="reset-form" action="../php/reset_password_process.php" method="POST">
            <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">

            <div class="password-container">
                <label for="new_password">Nueva Contraseña</label>
                <input type="password" id="new_password" name="new_password" placeholder="Nueva Contraseña" required>
                <button type="button" id="toggle-password">
                    <i class="fa-regular fa-eye" id="password-icon"></i>
                </button>
                <div id="password-feedback" class="feedback"></div>
            </div>

            <div class="password-container">
                <label for="confirm_password">Confirmar Contraseña</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmar Contraseña" required>
                <button type="button" id="toggle-confirm-password">
                    <i class="fa-regular fa-eye" id="confirm-password-icon"></i>
                </button>
                <div id="confirm-password-feedback" class="feedback"></div>
            </div>

            <button type="submit">Restablecer Contraseña</button>
        </form>
        <div class="note">
            <p>Asegúrate de que ambas contraseñas coincidan.</p>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const passwordIcon = document.getElementById(iconId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }

        document.getElementById('toggle-password').addEventListener('click', () => {
            togglePasswordVisibility('new_password', 'password-icon');
        });

        document.getElementById('toggle-confirm-password').addEventListener('click', () => {
            togglePasswordVisibility('confirm_password', 'confirm-password-icon');
        });

        // Validación en tiempo real de la contraseña
        document.getElementById('new_password').addEventListener('blur', function() {
            const password = this.value;
            const feedback = document.getElementById('password-feedback');
            const passwordPattern = /^(?=.[A-Z])(?=.\d)(?=.[.-_+!@#$%^&])[A-Za-z\d.-_+!@#$%^&*]{8,}$/;

            if (!passwordPattern.test(password)) {
                feedback.textContent = 'La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.';
            } else {
                feedback.textContent = '';
            }
        });

        // Validación en tiempo real de la confirmación de la contraseña
        document.getElementById('confirm_password').addEventListener('blur', function() {
            const password = document.getElementById('new_password').value;
            const confirmPassword = this.value;
            const feedback = document.getElementById('confirm-password-feedback');

            if (password !== confirmPassword) {
                feedback.textContent = 'Las contraseñas no coinciden.';
            } else {
                feedback.textContent = '';
            }
        });

        // Validación en el envío del formulario
        document.getElementById('reset-form').addEventListener('submit', function(e) {
            const password = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Las contraseñas no coinciden. Por favor, verifícalas.');
            }
        });
    </script>
</body>
</html>