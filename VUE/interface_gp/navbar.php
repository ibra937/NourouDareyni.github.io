
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
      <a href="Accueilgp.php"><img src="../media/logo.png" alt="" class="logo">NOUROU DARAYNI</a>
    </div>    
    <li><a href="../../CLASS/logout.php" class="logout-btn">Déconnexion</a></li>
    </header>
    <nav class="navbar">
        <ul class="nave">
            <li><a href="Accueilgp.php">Accueil</a></li>
            <li><a href="gestion_commandes.php">Commandes pour moi</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li class="user-id"> GP: <?php echo($_SESSION['user_name']); ?></li>
        </ul>
        <div class="cache">
            <li class="user-id">GP: <?php echo($_SESSION['user_name']); ?></li>
    <details>
        <summary>
            <img src="../media/menu1.png" class="menu">
        </summary>
        <div class="menuV">
            <ul class="ulmenu">
                <li><a href="Accueilgp.php">Accueil</a></li>
                <li><a href="gestion_commandes.php">Commandes pour moi</a></li>
                <li><a href="Profil.php">Profil</a></li>
                <button onclick="window.location.href='../../CLASS/logout.php';" align="center">Déconnexion</button>
            </ul>
        </div>
    </details>
    </div>
</nav>

</body>
<script>
    document.addEventListener("DOMContentLoaded", () => {
    const menuIcon = document.querySelector(".menu");
    const navLinks = document.querySelector(".menuV");

    if (menuIcon && navLinks) {
        menuIcon.addEventListener("click", () => {
            navLinks.classList.toggle("active");
        });
    }
    });
</script>
</html>