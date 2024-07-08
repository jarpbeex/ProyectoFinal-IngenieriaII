<?php
require 'DB_Puerto.php';

$usuario = trim($_POST['email']); 
$sql = "SELECT * FROM Cliente WHERE id_correo = '$usuario'";
$stmt = $conn->query($sql);

$response = array();

if ($stmt->rowCount() > 0) {
    $response['exists'] = true;
} else {
    $response['exists'] = false;

    // Insertar el correo en la base de datos
    $sqlInsert = "INSERT INTO Cliente (id_correo) VALUES ('$usuario')";
    $conn->query($sqlInsert);
}

// Verificar si se ha enviado información adicional
if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['phoneNumber'])) {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $phoneNumber = trim($_POST['phoneNumber']);

    // Actualizar el registro con la información adicional
    $sqlUpdate = "UPDATE Cliente SET nombre = '$firstName', apellido = '$lastName', telefono = '$phoneNumber' WHERE id_correo = '$usuario'";
    if ($conn->query($sqlUpdate)) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
