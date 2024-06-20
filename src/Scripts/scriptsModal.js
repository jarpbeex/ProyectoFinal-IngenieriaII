// modalScripts.js

// Abre el modal de registro de correo electrónico
document.getElementById('registerUserLink').onclick = function() {
    document.getElementById('registerEmailModal').style.display = "block";
};

// Cierra los modales cuando se hace clic en el botón de cerrar
Array.from(document.getElementsByClassName('close')).forEach(closeButton => {
    closeButton.onclick = function() {
        closeButton.parentElement.parentElement.style.display = "none";
    };
});

// Cierra los modales cuando se hace clic fuera del contenido del modal
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = "none";
    }
};

// Envía el formulario de registro de correo electrónico y muestra el modal de información adicional si es necesario
document.getElementById('registerEmailForm').onsubmit = function(event) {
    event.preventDefault();
    const email = document.getElementById('email').value;

    // Aquí puedes verificar si el correo existe en tu base de datos
    const emailExists = false; // Cambiar a true si el correo existe en la base de datos

    if (emailExists) {
        // Mostrar notificación de correo existente
        showNotificationEmailExists();
    } else {
        // Mostrar modal de registro de información adicional
        document.getElementById('registerEmailModal').style.display = "none";
        document.getElementById('registerAdditionalInfoModal').style.display = "block";
    }
};

// Envía el formulario de registro de información adicional y muestra la notificación
document.getElementById('registerAdditionalInfoForm').onsubmit = function(event) {
    event.preventDefault();
    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const phoneNumber = document.getElementById('phoneNumber').value;

    // Aquí puedes enviar los datos del formulario a tu backend

    // Simular notificación de registro exitoso
    showNotification();
};

// Envía el formulario de registro de información adicional y muestra la notificación
document.getElementById('registerAdditionalInfoForm').onsubmit = function(event) {
    event.preventDefault();
    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const phoneNumber = document.getElementById('phoneNumber').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    // Verificar que las contraseñas coincidan
    if (password !== confirmPassword) {
        alert("Las contraseñas no coinciden. Por favor, inténtalo de nuevo.");
        return;
    }

    // Aquí puedes enviar los datos del formulario a tu backend

    // Simular notificación de registro exitoso
    showNotification();
};