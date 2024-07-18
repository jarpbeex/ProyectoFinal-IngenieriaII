document.querySelectorAll('button').forEach(button => {
    button.addEventListener('click', function(){

        console.log('Entro al script Pedido') // Para borrar al final.

        // Mostrar el modal de pedido
        const modalPedido = document.getElementById('modal-pedido');
        modalPedido.style.display = 'block';

        // Id del pedido
        const tr = this.closest('tr');
        const idPedido = tr.querySelector('input').value;

        // Informacion sobre el pedido: quiero 
        const datos = new FormData();
        datos.append('id', idPedido);
        console.log(datos);

        fetch ('http://localhost:9090/src/Server/gestionPedido.php', { method: 'POST', body: datos })
                .then( function(res) { return res.json() } )
                .then( function(data) {
                    console.log(data);
                    if (data.exists.includes('1')) {
                        showNotification();
                    } else{
                        showNotificationEmailExists();
                    }
                })
                .catch( error => { console.error('Hubo un error', error) });

        // Mostrar información del artículo en el modal
        const modalContent = modalPedido.querySelector('.modal-content');
        modalContent.innerHTML = `
            <span class="close">&times;</span>
            <h2>Pedido</h2>
            <input id="email" type="email" id="email" placeholder="Correo electrónico" required>
            <select id="metodoPago">
                <option value="Efectivo">Efectivo</option>
                <option value="Yappy" selected>Yappy</option>
            </select>
            <input type="number" id="cantidad" min="1" max="5" step="1" value="1">
            <p><button id="submitPedido">Confirmar Pedido</button></p>
            
        `;

        // Agregar evento para cerrar el modal
        const closeBtn = modalContent.querySelector('.close');
        closeBtn.addEventListener('click', function() {
            modalPedido.style.display = 'none';
        });

    });
});

// modalContent.innerHTML = `
//             <span class="close">&times;</span>
//             <h2>Pedido</h2>
//             <img src="${imagenSrc}" alt="${articulo}" style="width: 100%; height: auto; border-radius: 10px; margin-bottom: 20px;">
//             <p>Artículo seleccionado: ${articulo}</p>
//             <p>Descripcion: ${Descripcion}</p>
//             <p>Precio: ${precio}</p>
//             <input id="email" type="email" id="email" placeholder="Correo electrónico" required>
//             <select id="metodoPago">
//                 <option value="Efectivo">Efectivo</option>
//                 <option value="Yappy" selected>Yappy</option>
//             </select>
//             <input type="number" id="cantidad" min="1" max="5" step="1" value="1">
//             <input type="hidden" value="${idAmig}" id="idAmiguru">
//             <p><button id="submitPedido">Confirmar Pedido</button></p>
            
//         `;