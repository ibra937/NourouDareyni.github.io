
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_gp.css">
    <title>Document</title>
</head>
<body>
    <header class="site-header">
    <div class="log">
      <a href="Accueil.php"><img src="../media/logo.png" alt="" class="logo">NOUROU DARAYNI</a>
    </div>    
    <li><a href="../../CLASS/logout.php" class="logout-btn">Déconnexion</a></li>
    </header>
    <nav class="navbar">
        <ul>
            <li><a href="Accueilgp.php">Accueil</a></li>
            <li><a href="gestion_commandes.php">Commandes pour moi</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li class="user-id"> GP: <?php echo($_SESSION['user_name']); ?></li>
        </ul>
</nav>

</body>
</html>