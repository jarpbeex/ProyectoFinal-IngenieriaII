<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mugumis Store</title>
    <link rel="icon" href="../Assets/Mugumis.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Estilos/stylesIndex.css">
    <link rel="stylesheet" href="../Estilos/stylesModal.css">
    <link rel="stylesheet" href="../Estilos/stylesNotificacion.css">
    <link rel="stylesheet" href="../Estilos/stylesCatalogo.css">
</head>
<body>
    <!-- Barra de navegación -->
    <nav>
        <div class="logo">
            <img src="../Assets/logoMugumis.png" alt="Logo">
        </div>
        <ul>
            <li><a href="index.html">Inicio</a></li>
            <li><a href="catalogo.html">Catálogo</a></li>
            <li><a href="#contacto">Contacto</a></li>
        </ul>
        <div class="user-reg">
            <a href="#" id="registerUserLink"><i class="fa-regular fa-user"></i> Registro de Usuario</a>
        </div>
    </nav>

    <!-- Modal de registro de correo electrónico -->
    <div id="registerEmailModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Registro de Correo Electrónico</h2>
            <form id="registerEmailForm">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>
                <button type="submit">Registrar</button>
            </form>
        </div>
    </div>

    <!-- Modal de registro de información adicional -->
<div id="registerAdditionalInfoModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Registro de Información Adicional</h2>
        <form id="registerAdditionalInfoForm">
            <!-- Agregar campos adicionales según necesidad -->
            <label for="firstName">Nombre:</label>
            <input type="text" id="firstName" name="firstName" required>
            <label for="lastName">Apellido:</label>
            <input type="text" id="lastName" name="lastName" required>
            <label for="phoneNumber">Número de Teléfono:</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <label for="confirmPassword">Confirmar Contraseña:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
            <button type="submit">Registrar</button>
        </form>
    </div>
</div>

    <!-- Notificación de registro exitoso -->
    <div id="notification" class="notification">
        <div class="notification-content">
            <i class="fa fa-check-circle"></i>
            <p>Datos registrados exitosamente</p>
        </div>
    </div>

    <!-- Catálogo de productos -->
    <main>
        <h1>Mugumis Disponibles</h1>
        <section>
        <?php
            require 'C:\Users\arcia\OneDrive\Escritorio\Proyecto ING\ProyectoFinal-IngenieriaII\ProyectoFinal-IngenieriaII\src\Server\DB_Puerto.php';
            // Consulta para obtener los productos
            $sql = "SELECT * FROM amigurumis";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Salida de cada fila
                while($row = $result->fetch_assoc()) {
                    echo '<article>';
                    echo '<img src="' . htmlspecialchars($row["URL"]) . '" alt="' . htmlspecialchars($row["Nombre"]) . '">';
                    echo '<h2>' . htmlspecialchars($row["Nombre"]) . '</h2>';
                    echo '<p>' . htmlspecialchars($row["Descripcion"]) . '</p>';
                    echo '<button>' . htmlspecialchars($row["Precio"]) .' USD'. '</button>';
                    echo '<p>' . htmlspecialchars($row["Stock"]) .' Disponibles'. '</p>';
                    echo '</article>';
                }
            } else {
                echo 'No hay productos disponibles.';
            }
            ?>
        </section>
    </main>
    

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

    <script src="../Scripts/scriptsIndex.js"></script>
    <script src="../Scripts/scriptsModal.js"></script>
    <script src="../Scripts/scriptsNotificacion.js"></script>
</body>
</html>