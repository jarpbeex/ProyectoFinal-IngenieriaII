<?php
require 'DB_Puerto.php';

$URL = trim($_POST['image-url']);
$Name = trim($_POST['Name']);
$Cost = trim($_POST['Priece']);
$Detalle = trim($_POST['Descripcion']);
$Stock = trim($_POST['Slok']);

function generateProductId($prefix = 'MU', $length = 4) {
    // Generar un número aleatorio dentro del rango adecuado
    $number = rand(0, 9999);
    
    // Formatear el número con ceros a la izquierda
    $formattedNumber = str_pad($number, $length, '0', STR_PAD_LEFT);
    
    // Concatenar el prefijo y el número formateado
    return $prefix . $formattedNumber;
}

// Generar el ID del producto
$productId = generateProductId();

// Escapar datos para evitar inyecciones SQL
$URL = mysqli_real_escape_string($conn, $URL);
$Name = mysqli_real_escape_string($conn, $Name);
$Cost = mysqli_real_escape_string($conn, $Cost);
$Detalle = mysqli_real_escape_string($conn, $Detalle);
$Stock = mysqli_real_escape_string($conn, $Stock);

// Insertar los datos en la base de datos
$Insert = mysqli_query($conn, "INSERT INTO amigurumis (`ID`, `Stock`, `Precio`, `Descripcion`, `Nombre`, `URL`) VALUES ('$productId', '$Stock','$Cost','$Detalle', '$Name', '$URL')");

if ($Insert) {
    // Si la inserción se realizó correctamente, enviar mensaje de éxito
    echo json_encode(array('success' => 'La inserción fue grabada con éxito.'));
} else {
    // Si hubo un error en la inserción, enviar mensaje de error
    echo json_encode(array('error' => 'Error al insertar los datos.'));
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
