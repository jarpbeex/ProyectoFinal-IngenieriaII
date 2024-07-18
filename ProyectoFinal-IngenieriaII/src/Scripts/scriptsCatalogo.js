// Obtener todos los botones de "Realizar Pedido"
const buttons = document.querySelectorAll('button');
// Iterar sobre cada botón y agregar un evento clic
buttons.forEach(button => {
    button.addEventListener('click', function() {
        // Obtener información del artículo
        console.log("Entrado en scrip");

        // Se definen todos los datos para la ventana emergente.
        const article = this.closest('article');
        const articulo = article.querySelector('h2').textContent;
        const Descripcion = article.querySelector('p').textContent;
        const precio = article.querySelector('h4').textContent;
        const imagenSrc = article.querySelector('img').src;
        const idAmig = article.querySelector('input').value;

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
            <p>Descripcion: ${Descripcion}</p>
            <p>Precio: ${precio}</p>
            <input id="email" type="email" id="email" placeholder="Correo electrónico" required>
            <select id="metodoPago">
                <option value="Efectivo">Efectivo</option>
                <option value="Yappy" selected>Yappy</option>
            </select>
            <input type="number" id="cantidad" min="1" max="5" step="1" value="1">
            <input type="hidden" value="${idAmig}" id="idAmiguru">
            <p><button id="submitPedido">Solicitar Pedido</button></p>
            
        `;
        // Agregar evento para cerrar el modal
        const closeBtn = modalContent.querySelector('.close');
        closeBtn.addEventListener('click', function() {
            modalCatalogo.style.display = 'none';
        });

        const submitBtn = modalContent.querySelector('#submitPedido');

        submitBtn.addEventListener('click', function() {
            console.log('El click funciona');
            
            // Guardar información del artículo en el modal para envío
            const inputCorreo = modalContent.querySelector('#email').value; // <--- no funciona :(
            const metodoPago = modalContent.querySelector('#metodoPago').value;
            const inCantidad = modalContent.querySelector('#cantidad').value;
            const id = modalContent.querySelector('#idAmiguru').value;

            console.log(inputCorreo);
            console.log(metodoPago);
            console.log(inCantidad);
            console.log(idAmig);

            const datos = new FormData();
            datos.append('correo', inputCorreo);
            datos.append('id', idAmig) // id amigurumi
            datos.append('pago', metodoPago);
            datos.append('cantidad', inCantidad);

            // prueba........
            console.log(datos);

            fetch ('http://localhost:9090/src/Server/Pedido.php', { method: 'POST', body: datos })
                    .then( function(res) { return res.json() } )
                    .then( function(data) {
                        console.log(data);
                        if (data.msg.includes('Pedido en proceso.')) {
                            showNotification();
                        } else{
                            showNotificationEmailExists();
                        }
                    })
                    .catch( error => { console.error('Hubo un error', error) });





            // const email = modalContent.querySelector('#email').value;

            // Aquí puedes procesar la información del pedido
            // Por ejemplo, enviar los datos por AJAX a tu servidor

            // Cerrar el modal después de enviar el pedido
            // modalCatalogo.style.display = 'none';
        });
    });
});
