
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
        <ul class="nave">
            <li><a href="Page_creationC.php">Creer une Commandes</a></li>
            <li><a href="Page_suiviC.php">Suivi des Commandes</a></li>
            <li><a href="Profile.php">Profil</a></li>
            <li class="user-id"><?php echo($_SESSION['user_name']); ?></li>
        </ul>

        <div class="cache">
            <li class="user-id"><?php echo($_SESSION['user_name']); ?></li>
    <details>
        <summary>
            <img src="../media/menu1.png" class="menu">
        </summary>
        <div class="menuV">
            <ul class="ulmenu">
                <li><a href="Accueil.php">Accueil</a></li>
                <li><a href="Page_creationC.php">Creer une Commandes</a></li>
                <li><a href="Page_suiviC.php">Suivi des Commandes</a></li>
                <li><a href="Profile.php">Profil</a></li>
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