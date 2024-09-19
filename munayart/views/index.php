<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Inicio Munayart</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        .password-container {
            position: relative;
            width: 100%;
        }
        .password-container input {
            width: calc(100% - 40px); /* Ajusta el espacio para el botón */
        }
        .password-container button {
            position: absolute;
            color: black;
            right: 0;
            top: -2px;
            width: 40px;
            height: 69.5%;
            background: #eee;
            border: none;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>

    <div class="container" id="container">
        <!-- Formulario de Registro -->
        <div class="form-container sign-up">
            <form id="register-form" action="../php/register.php" method="POST">
                <h1>Crear Cuenta</h1>
                <div class="input-group">
                    <input type="text" name="nombre" placeholder="Nombre" required>
                    <input type="text" name="apellido" placeholder="Apellido" required>
                </div>
                <input type="date" name="fechaNac" id="fechaNac" placeholder="Fecha de Nacimiento" required>
                <div id="fechaNac-feedback" style="color: red;"></div>
                <input type="tel" name="celular" id="celular" placeholder="Número de Celular" required>
                <div id="celular-feedback" style="color: red;"></div> <!-- Mensaje de validación del número de celular -->
                
                <input type="text" name="user" id="user" placeholder="Usuario" required>
                <div id="username-feedback" style="color: red;"></div> <!-- Mensaje de validación del nombre de usuario -->
                
                <input type="email" name="email" id="email" placeholder="Correo Electrónico" required>
                <div id="email-feedback" style="color: red;"></div> <!-- Mensaje de validación del correo electrónico -->
                
                <!-- Contraseña con botón de visibilidad -->
                <div class="password-container">
                    <input type="password" name="password" id="register-password" placeholder="Contraseña" required>
                    <button type="button" id="toggle-password">
                        <i class="fa-regular fa-eye" id="password-icon"></i>
                    </button>
                </div>
                <div id="password-feedback" style="color: red;"></div> <!-- Mensaje de validación de la contraseña -->
                
                <div class="password-container">
                    <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirmar Contraseña" required>
                    <button type="button" id="toggle-confirm-password">
                        <i class="fa-regular fa-eye" id="confirm-password-icon"></i>
                    </button>
                </div>
                <div id="confirm-password-feedback" style="color: red;"></div> <!-- Mensaje de validación de la confirmación de la contraseña -->
                
                <label for="rol">Rol:</label>
                <select name="rol" required>
                    <option value="cliente">Cliente</option>
                    <option value="artesano">Artesano</option>
                    <option value="delivery">Delivery</option>
                </select><br>
                <button type="submit">Registrarse</button>
            </form>
        </div>

        <!-- Formulario de Inicio de Sesión -->
        <div class="form-container sign-in">
            <form action="../php/login.php" method="POST">
                <h1>Iniciar Sesión</h1>
                <input type="text" name="user" placeholder="Usuario" required>
                <input type="email" name="email" placeholder="Correo Electrónico" required>
                
                <!-- Contraseña con botón de visibilidad -->
                <div class="password-container">
                    <input type="password" name="password" id="login-password" placeholder="Contraseña" required>
                    <button type="button" id="toggle-login-password">
                        <i class="fa-regular fa-eye" id="login-password-icon"></i>
                    </button>
                </div>
                
                <label for="rol">Rol:</label>
                <select name="rol" required>
                    <option value="cliente">Cliente</option>
                    <option value="artesano">Artesano</option>
                    <option value="delivery">Delivery</option>
                </select><br>
                <div class="g-recaptcha" data-sitekey="6Lflbz8qAAAAAGSLYjCqAx0pDCjwgR4J-aWRkb5z"></div>
                <a href="../views/forgot_password.php">¿Olvidaste tu contraseña?</a>
                <button type="submit">Iniciar Sesión</button>
            </form>
        </div>

        <!-- Contenedor de Toggle -->
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>¡Bienvenido de nuevo a MUNAYART!</h1>
                    <p>Ingresa tus datos personales para acceder a todas las funciones del sitio</p>
                    <button class="hidden" id="login">Iniciar Sesión</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>¡Hola!</h1>
                    <p>Regístrate con tus datos personales para acceder a todas las funciones del sitio</p>
                    <button class="hidden" id="register">Registrarse</button>
                </div>
            </div>
        </div>

    </div>

    <script src="script.js"></script>
    <script>
        // Función para alternar visibilidad de contraseña
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
            togglePasswordVisibility('register-password', 'password-icon');
        });

        document.getElementById('toggle-confirm-password').addEventListener('click', () => {
            togglePasswordVisibility('confirm-password', 'confirm-password-icon');
        });

        document.getElementById('toggle-login-password').addEventListener('click', () => {
            togglePasswordVisibility('login-password', 'login-password-icon');
        });

        // Validación en tiempo real del nombre de usuario
        document.getElementById('user').addEventListener('blur', function() {
            const username = this.value;
            const feedback = document.getElementById('username-feedback');

            if (username.length > 0) {
                fetch(`../php/check_username.php?username=${username}`)
                    .then(response => response.text())
                    .then(data => {
                        if (data === 'taken') {
                            feedback.textContent = 'El nombre de usuario ya está en uso.';
                        } else {
                            feedback.textContent = 'Nombre de usuario disponible.';
                            feedback.style.color = 'green';
                        }
                    });
            } else {
                feedback.textContent = '';
            }
        });

        // Validación en tiempo real del correo electrónico
        document.getElementById('email').addEventListener('blur', function() {
            const email = this.value;
            const feedback = document.getElementById('email-feedback');

            // Puedes añadir una validación básica aquí, o realizar una validación de formato más avanzada
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                feedback.textContent = 'Por favor, ingresa un correo electrónico válido.';
            } else {
                feedback.textContent = '';
            }
        });

        // Validación en tiempo real del número de celular
        document.getElementById('celular').addEventListener('blur', function() {
            const celular = this.value;
            const feedback = document.getElementById('celular-feedback');
            const celularPattern = /^[67][0-9]{7}$/;

            if (!celularPattern.test(celular)) {
                feedback.textContent = 'Ingrese un número de celular válido.';
            } else {
                feedback.textContent = '';
            }
        });

        // Validación en tiempo real de la contraseña
        document.getElementById('register-password').addEventListener('blur', function() {
            const password = this.value;
            const feedback = document.getElementById('password-feedback');
            const passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[.-_+!@#$%^&*])[A-Za-z\d.-_+!@#$%^&*]{8,}$/;

            if (!passwordPattern.test(password)) {
                feedback.textContent = 'La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.';
            } else {
                feedback.textContent = '';
            }
        });

        // Validación en tiempo real de la confirmación de la contraseña
        document.getElementById('confirm-password').addEventListener('blur', function() {
            const password = document.getElementById('register-password').value;
            const confirmPassword = this.value;
            const feedback = document.getElementById('confirm-password-feedback');

            if (password !== confirmPassword) {
                feedback.textContent = 'Las contraseñas no coinciden.';
            } else {
                feedback.textContent = '';
            }
        });

        // Validación en el envío del formulario
        document.getElementById('register-form').addEventListener('submit', function(e) {
            const password = document.getElementById('register-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const celular = document.getElementById('celular').value;
            const fechaNac = new Date(document.getElementById('fechaNac').value);
            const celularPattern = /^[67][0-9]{7}$/;
            const today = new Date();
            const age = today.getFullYear() - fechaNac.getFullYear();
            const m = today.getMonth() - fechaNac.getMonth();
            
            if (m < 0 || (m === 0 && today.getDate() < fechaNac.getDate())) {
                age--;
            }

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Las contraseñas no coinciden. Por favor, verifícalas.');
                return;
            }

            if (!celularPattern.test(celular)) {
                e.preventDefault();
                alert('Ingrese un número de celular válido.');
                return;
            }

            if (age < 18) {
                e.preventDefault();
                alert('Debes ser mayor de edad para registrarte.');
                return;
            }
        });
    </script>
</body>
</html>
