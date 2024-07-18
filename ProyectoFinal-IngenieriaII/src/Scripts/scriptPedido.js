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
                    const correos = data.fk_cliente;
                    const url = data.direccion_url;
                    const fecha = data.fecha;
                    const cantidad = data.cantidad;
                    const metodoPago = data.metodo_pago;
                    const idPed = data.id;
                    // Mostrar información del artículo en el modal
                    const modalContent = modalPedido.querySelector('.modal-content');
                    modalContent.innerHTML = `
                        <span class="close">&times;</span>
                        <h2>Pedido</h2>
                        <img src="${url}" alt="" style="width: 100%; height: auto; border-radius: 10px; margin-bottom: 20px;">
                        <p>Correo de cliente: ${correos}</p>
                        <p>Fecha: ${fecha}</p>
                        <p>Cantidad a comprar: ${cantidad}</p>
                        <select id="estadoAct">
                            <option value="Pagado">Pagado</option>
                            <option value="Entregado">Entregado</option>
                        </select>
                        <p>Metodo de pago: ${metodoPago}</p>
                        <button id="submitActPedido">Confirmar Pedido</button>
                    `;
                    // Agregar evento para cerrar el modal
                    const closeBtn = modalContent.querySelector('.close');
                    closeBtn.addEventListener('click', function() {
                        modalPedido.style.display = 'none';
                    });

                    const submitBtn = modalContent.querySelector('#submitActPedido');
                    submitBtn.addEventListener('click', function() {
                        console.log('funciona el boton submit');
                        const datos2 = new FormData();
                        const estado = modalContent.querySelector('#estadoAct').value;
                        datos2.append('id', idPed)
                        datos2.append('estado', estado)
                        console.log(datos2)
                        fetch ('http://localhost:9090/src/Server/actualizarPedido.php', { method: 'POST' , body:datos2 })
                                .then( function(res) { return res.json() } )
                                .then( function(data) {
                                    console.log(data);
                                    if (data.msg.includes('Pedido en proceso.')) {
                                        showNotification();
                                    }
                                })
                                .catch( error => { console.error('Hubo un error: ', error )});
                    })
                })
                .catch( error => { console.error('Hubo un error', error) });
        


                
    });
});