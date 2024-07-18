<?php
require 'DB_Puerto.php';
$response = [];

try {
    // Control si se mandaron todos los datos
    if (!empty($_POST['correo']) && !empty($_POST['id']) && !empty($_POST['pago']) && !empty($_POST['cantidad'])) {

        // Obtener los datos enviados (POST)
        $cliente = trim($_POST['correo']);
        $idAmig = trim($_POST['id']);
        $metodo_pago = trim($_POST['pago']);
        $cantidad = trim($_POST['cantidad']);

        // Consulta para verificar si existe el cliente
        $sql = "SELECT * FROM Cliente WHERE id_correo = :correo";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':correo', $cliente);
        $stmt->execute();

        // Guarda fk_amigurumis
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        $fkAmig = $fila['fk_amigurumis'] ?? null;

        // Control si existe el cliente
        if ($stmt->rowCount() > 0) {

            // Try-Catch en caso de errores al realizar la consulta
            try {
                // Si el cliente no tiene amigurumi asignado, se le asigna
                if (is_null($fkAmig)) {
                    // Consulta para actualizar la fk_amigurumis
                    $sqlid = "UPDATE Cliente SET fk_amigurumis = :idAmig WHERE id_correo = :correo";
                    $stmtid = $conn->prepare($sqlid);
                    $stmtid->bindParam(':idAmig', $idAmig);
                    $stmtid->bindParam(':correo', $cliente);
                    $stmtid->execute();
                }

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
                echo json_encode($response);

            } catch (PDOException $e) {
                // Si falla el try
                $response['msg'] = "Error al registrar el pedido: " . $e->getMessage();
                echo json_encode($response);
            }

        } else { // Si no existe el cliente
            $response['msg'] = 'El correo electronico no esta registrado, Registrese antes de poder hacer un pedido.';
            echo json_encode($response);
        }

    } else { // Si se enviaron los datos incompletos
        $response['msg'] = 'Complete todos los campos.';
        echo json_encode($response);
    }
} catch (Exception $e) {
    // Manejo de errores generales
    $response['msg'] = 'Error inesperado: ' . $e->getMessage();
    echo json_encode($response);
}
?>
