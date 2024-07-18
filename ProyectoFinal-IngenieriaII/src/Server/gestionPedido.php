<?php
require 'DB_Puerto.php';
$response = [];
if ($_POST['id']!='') {
    $sql = "SELECT * FROM Pedido";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $registro = $stmt->fetch(PDL::FETCH_ASSOC);

    $response['']='';
    $response['']='';
    $response['']='';
    $response['']='';
    $response['']='';
    js
}

