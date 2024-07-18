<?php
require 'DB_Puerto.php';
$response = [];
if ($_POST['id']!='') {
    $idPedido = $_POST['id'];
    $sql = "SELECT * FROM Pedido";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $sqlurl = " SELECT 
                    pe.id_pedido,
                    cl.id_correo,
                    inv.direccion_url
                FROM 
                    Pedido pe
                JOIN 
                    (SELECT id_correo, fk_amigurumis FROM Cliente) cl ON pe.fk_cliente = cl.id_correo
                JOIN 
                    (SELECT id_amigurumis, direccion_url FROM Inventario_de_amigurumis) inv ON cl.fk_amigurumis = inv.id_amigurumis
                WHERE 
                    pe.id_pedido = '$idPedido';";
    $stmtUrl = $conn->prepare($sqlurl);
    $stmtUrl->execute();

    $registro = $stmt->fetch(PDO::FETCH_ASSOC);
    $registro2 = $stmtUrl->fetch(PDO::FETCH_ASSOC);

    $response['id']=$registro['id_pedido'];
    $response['estado']=$registro['estado'];
    $response['fecha']=$registro['fecha'];
    $response['metodo_pago']=$registro['metodo_pago'];
    $response['cantidad']=$registro['cantidad'];
    $response['fk_empleado']=$registro['fk_empleado'];
    $response['fk_cliente']=$registro['fk_cliente'];
    $response['direccion_url']=$registro2['direccion_url'];

    echo json_encode($response);
}

