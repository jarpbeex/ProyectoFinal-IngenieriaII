<?php
// Configuración de la base de datos
$servername = "baseDatos";
$username = "root";
$password = "root";
$database = "Mugumis";

try {
    // Crear conexión usando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Establecer el modo de error de PDO a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit(); // Detener la ejecución si hay un error de conexión
}
?>
