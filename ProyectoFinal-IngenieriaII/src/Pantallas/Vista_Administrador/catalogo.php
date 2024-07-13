<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mugumis Store</title>
    <link rel="icon" href="../Assets/Mugumis.ico" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/src/Estilos/stylesIndex.css">
    <link rel="stylesheet" href="/src/Estilos/stylesCatalogo.css">
    <style>
        /* Estilos adicionales para la barra de navegación fija */
        nav {
            position: fixed; /* Fija la barra de navegación */
            top: 0; /* La barra se fija en la parte superior de la ventana */
            z-index: 1000; /* Asegura que la barra de navegación esté por encima de otros elementos */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Añade una sombra para mayor claridad */
        }

        body {
            padding-top: 60px; /* Añade un padding para evitar que el contenido quede oculto detrás de la barra */
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
            <li><a href="catalogo.php">Catalogo</a></li>
            <li><a href="p_Product.html">Añadir Producto</a></li>
            <li><a href="#contacto">Contacto</a></li>
        </ul>
    </nav>


    <!-- Catálogo de productos -->
    <main>
        <h1>Mugumis Disponibles</h1>
        <section>
        <?php
            // Incluir el archivo de conexión
            require '/var/www/html/src/Server/DB_Puerto.php';
            try {
                // Consulta para obtener los productos
                $sql = "SELECT * FROM inventario_de_amigurumis";
                $stmt = $conn->query($sql);

                if ($stmt->rowCount() > 0) {
                    // Salida de cada fila
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<article>';
                        echo '<img src="' . htmlspecialchars($row["direccion_url"]) . '" alt="' . htmlspecialchars($row["nombre"]) . '">';
                        echo '<input type="hidden" class="id-amigurumis" value="' . htmlspecialchars($row["id_amigurumis"]) . '">';
                        echo '<h2 class="nombre">' . htmlspecialchars($row["nombre"]) . '</h2>';
                        echo '<p class="descripcion">' . htmlspecialchars($row["descripcion"]) . '</p>';
                        echo '<h4 class="precio">' . htmlspecialchars($row["precio"]) . ' USD</h4>';
                        echo '<p class="cantidad-disponible">' . htmlspecialchars($row["cantidad_disponible"]) . ' Disponibles</p>';
                        echo '<button class="editar">' . 'Editar</button>';
                        echo '</article>';
                    }                    
                } else {
                    echo 'No hay productos disponibles.';
                }
            } catch (PDOException $e) {
                echo "Error de consulta: " . $e->getMessage();
            }
        ?>
        </section>
    </main>

    <!-- Modal de realizar pedido -->
    <div id="modal-catalogo" class="modal-catalogo">
        <div class="modal-content">
            <!-- Aquí se inserta contenido para confirmar pedido -->
        </div>
    </div>

    <!-- Pie de página -->
    <footer id="contacto" class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <h3>Sobre Nosotros</h3>
                <p>La empresa opera como un negocio independiente, ofreciendo productos de calidad artesanal 
                    tanto a través de pedidos personalizados como de diseños básicos que son expuestos y vendidos.</p>
            </div>
            <div class="footer-column">
                <h3>Navegación</h3>
                <ul>
                    <li><a href="index.html">Inicio</a></li>
                    <li><a href="#catalogo">Catálogo</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Contacto</h3>
                <p>Email: mugumis.store@gmail.com</p>
                <p>Teléfono: +507 253-0000</p>
                <p>Celular: +507 6559-0000</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Desarrollo de Software. Todos los derechos reservados.</p>
            <p><i>Lohanys</i>, <i>Johny</i>, <i>Raúl</i>, <i>Josué</i>, <i>Chirag</i></p>
        </div>
    </footer>

    <script src="/src/Scripts/scriptsIndex.js"></script>
    <script src="/src/Scripts/scriptsCatalogoEdit.js"></script>
</body>
</html>