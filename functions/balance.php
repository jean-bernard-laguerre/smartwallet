<?php
    require __DIR__ . "/../classes/Database.php";
    include "tools.php";
    
    $pdo = new Database();
    session_start();

    $response["success"] = false;

    if (isset($_SESSION["id"])) {
        $response["balance"] = getBalance($pdo->bdd);
        $response['success'] = true;
    }
    
    echo json_encode($response);
?>