<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../scripts/script.js"></script>
    <script type="module" src="../scripts/theme.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../style/style.css">
    <title>Smart Wallet - Profil</title>
</head>
<body>
    <?php include "../includes/header.php" ?>
    <main>
        <?php if (!empty($_SESSION)) : ?>
            <div class="form-container">
                <h2>Editer profil</h2>
                <?php
                    echo "<input id='email' placeholder='Email' value=" . $_SESSION["email"] . ">";
                    echo "<input id='firstname' placeholder='Prénom' value=" . $_SESSION["firstname"] . ">";
                    echo "<input id='lastname' placeholder='Nom' value=" . $_SESSION["lastname"] . ">";
                ?>
                <input type="password" id='password' placeholder='Nouveau mot de passe'>
                <input type='submit' id='submit' value='Modifier'>
            </div>
        <?php endif ?>
    </main>
    <?php include "../includes/footer.php" ?>
</body>
</html>