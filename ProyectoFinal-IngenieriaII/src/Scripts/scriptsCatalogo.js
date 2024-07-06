// Obtener todos los botones de "Realizar Pedido"
const buttons = document.querySelectorAll('button');

// Iterar sobre cada botón y agregar un evento clic
buttons.forEach(button => {
    button.addEventListener('click', function() {
        // Obtener información del artículo
        const article = this.closest('article');
        const articulo = article.querySelector('h2').textContent;
        const precio = article.querySelector('h4').textContent;
        const imagenSrc = article.querySelector('img').src;

        // Mostrar el modal de catálogo
        const modalCatalogo = document.getElementById('modal-catalogo');
        modalCatalogo.style.display = 'block';

        // Mostrar información del artículo en el modal
        const modalContent = modalCatalogo.querySelector('.modal-content');
        modalContent.innerHTML = `
            <span class="close">&times;</span>
            <h2>Pedido</h2>
            <img src="${imagenSrc}" alt="${articulo}" style="width: 100%; height: auto; border-radius: 10px; margin-bottom: 20px;">
            <p>Artículo seleccionado: ${articulo}</p>
            <p>Precio: ${precio}</p>
            <input type="email" id="email" placeholder="Correo electrónico" required>
            <p><button id="submitPedido">Confirmar Pedido</button></p>
        `;

        // Agregar evento para cerrar el modal
        const closeBtn = modalContent.querySelector('.close');
        closeBtn.addEventListener('click', function() {
            modalCatalogo.style.display = 'none';
        });

        // Guardar información del artículo en el modal para envío
        const submitBtn = modalContent.querySelector('#submitPedido');
        submitBtn.addEventListener('click', function() {
            const email = modalContent.querySelector('#email').value;

            // Aquí puedes procesar la información del pedido
            // Por ejemplo, enviar los datos por AJAX a tu servidor

            // Cerrar el modal después de enviar el pedido
            modalCatalogo.style.display = 'none';
        });
    });
});
