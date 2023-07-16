<?php
    require __DIR__ . "/../classes/Database.php";

    $pdo = new Database();
    session_start();

    $content = trim(file_get_contents("php://input"));

    $data = json_decode($content, true);
    $response['success'] = true;
    
    $sql = "SELECT * FROM transaction 
            WHERE id = ?";

    $req = $pdo->bdd->prepare($sql);
    $req->execute( [$data["id"]] );
    $response["transaction"] = $req->fetch(PDO::FETCH_ASSOC);

    echo json_encode($response);
?>