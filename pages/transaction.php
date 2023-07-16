<?php
    require __DIR__ . "/../classes/Database.php";
    require __DIR__ . "/../classes/Transaction.php";
    include "../functions/tools.php";

    session_start();

    if(!isset($_SESSION["id"])){
        header("location: login.php");
    }

    $pdo = new Database();

    if (!empty($_POST)) {

        $type = $_POST["transaction-type"];
        $amount = $_POST["transaction-amount"];
        $category = $_POST["transaction-category"];
        $description = htmlspecialchars($_POST["transaction-description"]);
        
        $newTransaction = new Transaction($_SESSION["id"], $description, $category, $type, $amount);

        $newTransaction->add();

    }

    $categories = getCategories($pdo->bdd);
    $transactions = getTransactions($pdo->bdd, $_SESSION["id"]);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="../scripts/transaction.js"></script>
    <script type="module" src="../scripts/theme.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../style/style.css">
    <title>Smart Wallet - Transactions</title>
</head>
<body>
    <?php include "../includes/header.php" ?>
    <main>
        <?php if(!empty($_SESSION)) : ?>

            <div class=" top-container flex align">
                <div class="form-container">
                    <form action="" method="POST">
                        <h5>Ajouter une transaction</h5>
                        <select id="cat" name="transaction-type" placeholder="Category" required>
                            <option value="1">Débit</option>
                            <option value="2">Crédit</option>
                        </select>
                        <select id="cat" name="transaction-category" placeholder="Category" required>
                            <?php
                                foreach($categories as $category){
                                    echo "<option value=" . $category["id"] . ">" . $category["name"] ."</option>";
                                }
                            ?>
                        </select>
                        <input type="text" name="transaction-description" placeholder="Description" required>
                        <input type="number" step="any" min="0" name="transaction-amount" placeholder="Montant" required>
                        <input type="submit" name="register" value="Créer">
                    </form>
                </div>
                
                <div class="balance-container">
                    <h6>Solde: </h6>
                    <p id="Balance"></p>
                </div>
            </div>

            <div id="edit" class="form-container hidden">
                <button id="close-button">
                    <img class="icon" src="../style/images/icons8-effacer-50.png" alt="add icon">
                </button>
                <div>
                    <p>Montant: <span id="Detail-amount"></span>€</p>
                    <p>Date: <span id="Detail-date"></span></p>
                    <p>Description: <span id="Detail-description"></span></p>
                </div>
            </div>

        <?php endif ?>
        <div class="list-container">
            <table>
                <caption>
                    <h5>Liste des transactions</h5>
                </caption>
                <thead>
                    <td>Type</td>
                    <td>Montant</td>
                    <td>Categorie</td>
                    <td>Description</td>
                </thead>
                <tbody>
                    <?php
                        foreach($transactions as $transaction){
                            echo "<tr class=". $transaction["type"] .">";
                            echo "<td>" . $transaction["type"] . "</td>";
                            echo "<td>" . $transaction["amount"] . "€</td>";
                            echo "<td>" . $transaction["category_name"] . "</td>";
                            echo "<td>" . $transaction["description"] . "</td>";
                            echo "<td>";

                            if ($_SESSION["id"] == 1 || $_SESSION["id"] == $transaction["author_id"]) {
                                
                                echo "<div class='control'>";
                                echo "<button type='button' class='remove' id=" . $transaction["id"] .">";
                                echo "<img class='icon' src='../style/images/icons8-supprimer-48.png' alt='delete icon'>";
                                echo "</button>";
                                echo "<button type='button' class='edit' id=" . $transaction["id"] .">";
                                echo "<img class='icon' src='../style/images/icons8-modifier-50.png' alt='edit icon'>";
                                echo "</button>";
                                echo "</div>";
                                
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php include "../includes/footer.php" ?>
</body>
</html>