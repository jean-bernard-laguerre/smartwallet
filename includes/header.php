<header>
    <nav>
        <div>
            <a href="index.php">Accueil</a>
            <?php if( !empty($_SESSION) ) : ?>

                <a href="transaction.php">Transactions</a>
                <a href="category.php">Categories</a>
            
            <?php endif ?>
        </div>
        <div>
            <?php if( empty($_SESSION) ) : ?>
                <a href="login.php">Connexion</a>
            
            <?php else : ?>
                <a href="profile.php">Profil</a>
                <a href="logout.php">Déconnexion</a>
            <?php endif ?>
        </div>
    </nav>
</header>