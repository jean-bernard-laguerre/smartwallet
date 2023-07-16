<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script type="module" src="../scripts/index.js"></script>
    <script type="module" src="../scripts/theme.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../style/style.css">
    <title>Smart Wallet - Accueil</title>
</head>
<body>
    <?php include "../includes/header.php" ?>
    <main>
        <?php if(!empty($_SESSION)) : ?>
            <div class="container">
                <h2>
                    <?php {echo "Bienvenue " . $_SESSION["firstname"] . ".";}?>
                    <h6>Solde: </h6>
                    <p id="Balance"></p>
                </h2>

                <div class="canvas-container flex">
                    <canvas id="TransactionOverview" ></canvas>
                </div>
            </div>
        <?php endif ?>
    </main>
    <?php include "../includes/footer.php" ?>
</body>
</html>