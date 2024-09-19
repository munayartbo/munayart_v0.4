const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const passwordInput = form.querySelector('input[name="password"]');

    form.addEventListener('submit', function(event) {
        const password = passwordInput.value;

        // Expresión regular para validar la contraseña
        const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

        if (!passwordRegex.test(password)) {
            event.preventDefault(); // Evitar el envío del formulario
            alert("La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.");
        }
    });
});

