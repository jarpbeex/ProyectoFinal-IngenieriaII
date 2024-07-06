<?php
require 'DB_Puerto.php';

$URL = trim($_POST['image-url']);
$Name = trim($_POST['Name']);
$Cost = trim($_POST['Priece']);
$Detalle = trim($_POST['Descripcion']);
$Stock = trim($_POST['Slok']);

function generateProductId($prefix = 'MU', $length = 4) {
    $number = rand(0, 9999);
    $formattedNumber = str_pad($number, $length, '0', STR_PAD_LEFT);
    return $prefix . $formattedNumber;
}

$productId = generateProductId();

try {
    // Preparar la consulta SQL
    $sql = "INSERT INTO Inventario_de_amigurumis (`id_amigurumis`, `cantidad_disponible`, `precio`, `descripcion`, `Nombre`, `URL`) 
            VALUES (:id_amigurumis, :cantidad_disponible, :precio, :descripcion, :Nombre, :URL)";

    // Preparar la sentencia
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros
    $stmt->bindParam(':id_amigurumis', $productId);
    $stmt->bindParam(':cantidad_disponible', $Stock);
    $stmt->bindParam(':precio', $Cost);
    $stmt->bindParam(':descripcion', $Detalle);
    $stmt->bindParam(':Nombre', $Name);
    $stmt->bindParam(':URL', $URL);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode(array('success' => 'La inserción fue grabada con éxito.'));
    } else {
        echo json_encode(array('error' => 'Error al insertar los datos.'));
    }
} catch (PDOException $e) {
    echo json_encode(array('error' => 'Error al insertar los datos: ' . $e->getMessage()));
}
?>