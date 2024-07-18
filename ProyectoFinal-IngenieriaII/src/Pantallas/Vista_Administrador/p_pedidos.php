<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mugumis Store</title>
    <link rel="icon" href="/src/Assets/Mugumis.ico" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/src/Estilos/stylesIndex.css">
    <link rel="stylesheet" href="/src/Estilos/stylesCatalogo.css">

    <!-- BOOSTRAP -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->

    <style>
        /* Estilos adicionales para la barra de navegación fija */
        nav {
            position: fixed;
            /* Fija la barra de navegación */
            top: 0;
            /* La barra se fija en la parte superior de la ventana */
            z-index: 1000;
            /* Asegura que la barra de navegación esté por encima de otros elementos */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Añade una sombra para mayor claridad */
        }

        body {
            padding-top: 60px;
            /* Añade un padding para evitar que el contenido quede oculto detrás de la barra */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left; /* Justificación a la izquierda */
        }
        th {
            background-color: #a2e3ff;
        }
    </style>
    <script>
        localStorage.removeItem('editAmigurumi');
    </script>
</head>

<body>
    <!-- Barra de navegación -->
    <nav>
        <div class="logo">
            <img src="/src/Assets/logoMugumis.png" alt="Logo">
        </div>
        <ul>
            <li><a href="p_Gestioncatalogo.php">Catalogo</a></li>
            <li><a href="P_Product.html">Añadir Producto</a></li>
            <li><a href="p_pedidos.php">Pedidos</a></li>
        </ul>
    </nav>


    <!-- Catálogo de productos -->
    <main>
        <h1>Gestion de pedidos</h1>
        <section>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Correo del Cliente</th>
                        <th>Revision</th>
                        <!-- Agrega más encabezados según tus columnas -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Incluir el archivo de conexión
                        require '/var/www/html/src/Server/DB_Puerto.php';
                        // Consulta SQL para obtener todos los registros de la tabla Pedidos
                        $sql = "SELECT * FROM Pedido";
                        $stmt2 = $conn->query($sql);

                        // Verificar si la consulta fue exitosa
                        if ($stmt2) {
                            // Obtener todos los registros como un array asociativo
                            $pedidos = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                        } else {
                            echo "Error en la consulta.";
                            exit;
                        }
                    ?>

                    <?php if (!empty($pedidos)) : ?>
                        <?php foreach ($pedidos as $pedido) : ?>
                            <tr><?php
                                $idPedido = htmlspecialchars($pedido['id_pedido']);
                                $fkCliente = htmlspecialchars($pedido['fk_cliente']);
                                $estado = htmlspecialchars($pedido['estado']);
                                $fecha = htmlspecialchars($pedido['fecha']);
                                echo '<input id="inIdPedido" type="hidden" value="'. $idPedido .'">';
                                echo '<td>' . $idPedido  . '</td>';
                                echo '<td>' . $estado    . '</td>';
                                echo '<td>' . $fecha     . '</td>';
                                echo '<td>' . $fkCliente . '</td>';
                                echo '<td><button>ver</button></td>';
                                ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4">No se encontraron pedidos.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>


    </main>

    <!-- Modal de realizar pedido -->
    <div id="modal-pedido" class="modal-pedido">
        <div class="modal-content">
            <!-- Aquí se inserta contenido para confirmar pedido -->
        </div>
    </div>

    <!-- Pie de página -->
    <footer id="contacto" class="footer">
    </footer>

    <script src="/src/Scripts/scriptsIndex.js"></script>
    <script src="/src/Scripts/scriptsCatalogoEdit.js"></script>
    <script src="/src/Scripts/scriptPedido.js"></script>
</body>

</html>