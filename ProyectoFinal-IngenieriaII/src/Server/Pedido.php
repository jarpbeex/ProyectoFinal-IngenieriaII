<?php
require 'DB_Puerto.php';
$response = [];

// control si se mandaron todos los datos
if ($_POST['correo'] != '' && $_POST['id'] != '' && $_POST['pago'] != '' && $_POST['cantidad'] != '') {

    // Obtener los datos enviados (POST)
    $cliente = trim($_POST['correo']); 
    $idAmig = trim($_POST['id']);
    $metodo_pago = trim($_POST['pago']);
    $cantidad = trim($_POST['cantidad']);

    // Consulta para verificar si existe el cliente
    $sql = "SELECT * FROM Cliente WHERE id_correo = '$cliente'";
    $stmt = $conn->query($sql);

    // Guarda fk_amigurumis
    $fila = $stmt->fetch(PDO::FETCH_ASSOC);
    $fkAmig = $fila['fk_amigurumis'];
    
    // Constrol si existe el cliente y si ya tiene un amigurumi asignado
    if ($stmt->rowCount() > 0 && is_null($fkAmig)) {

        // Try-Catch en caso de errores al realizar la consulta
        try {
            

            // Consulta para actualizar la fk_amigurumis
            $sqlid = "UPDATE Cliente SET fk_amigurumis = '$idAmig' WHERE id_correo = '$cliente'";
            $stmtid = $conn->query($sqlid);

            // Valor por defecto en metodo_pago
            $estado = 'Pendiente';

            // Preparar la consulta SQL con parámetros
            $sql = "INSERT INTO Pedido (estado, fecha, metodo_pago, cantidad, fk_cliente) 
                    VALUES (:estado, CURDATE(), :metodo_pago, :cantidad, :fk_cliente)";
            $stmt = $conn->prepare($sql);
    
            // Vincular los parámetros a los valores
            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
            $stmt->bindParam(':metodo_pago', $metodo_pago, PDO::PARAM_STR);
            $stmt->bindParam(':fk_cliente', $cliente, PDO::PARAM_STR);
            $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
    
            // Ejecutar la consulta
            $stmt->execute();
            $response['msg'] = 'Pedido en proceso.';
            echo json_encode ($response);

        } catch (PDOException $e) {
            // Si falla el try
            $response['msg'] = "Error al registrar el pedido: " . $e->getMessage();
            echo json_encode($response);
        }

    } else { // Si ya existe el cliente o si ya tiene un valor en fk_amigurumis
        $response['msg'] = 'El cliente no existe o ya tiene un pedido.';
        echo json_encode ($response);   
    }

} else { // Si se enviaron los datos incompletos.
    $response['msg'] = 'No se envio nada.';
    echo json_encode ($response);
}