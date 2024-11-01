
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <li><a href="Page_creationC.php">Creer une Commandes</a></li>
            <li><a href="Page_suiviC.php">Suivi des Commandes</a></li>
            <li><a href="profile.php">Profil</a></li>
            <li class="user-id"><?php echo($_SESSION['user_name']); ?></li>
        </ul>
</nav>

</body>
</html>