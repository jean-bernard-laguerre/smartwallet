<?php
    require __DIR__ . "/../classes/Database.php";
    include "tools.php";
    
    $pdo = new Database();
    session_start();

    $response["success"] = false;

    if (isset($_SESSION["id"])) {
        $response["Credit"] = getCreditOverview($pdo->bdd, $_SESSION["id"]);
        $response["Debit"] = getDebitOverview($pdo->bdd, $_SESSION["id"]);
        $response["AllCredit"] = getCreditTransactions($pdo->bdd, $_SESSION["id"]);
        $response["AllDebit"] = getDebitTransactions($pdo->bdd, $_SESSION["id"]);
        $response['success'] = true;
    }
    
    echo json_encode($response);
?>