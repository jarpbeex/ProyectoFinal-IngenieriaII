<?php
require 'DB_Puerto.php';

$URL = trim($_POST['image-url']);
$Name = trim($_POST['Name']);
$Cost = trim($_POST['Priece']);
$Detalle = trim($_POST['Descripcion']);

$Insert = mysqli_query($conn, "INSERT INTO Mugumis (`transaccion`, `fecha`, `monto`) VALUES ('$TRANSAC', '$FECHA','$MONTO')");
//
if ($Insert) {
    // Si la inserción se realizó correctamente, enviar mensaje de éxito
    echo json_encode(array('success' => 'La inserción fue grabada con éxito.'));
} else {
    // Si hubo un error en la inserción, enviar mensaje de error
    echo json_encode(array('error' => 'Error al insertar los datos.'));
}