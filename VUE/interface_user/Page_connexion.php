<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Navbar -->
       <!-- Navbar -->
    <header class="site-header">
    <div class="log">
      <a href="index.html"><img src="../media/logo.png" alt="" class="logo">NOUROU DARAYNI</a>
    </div> 
    </header>
    <nav class="navbar">
        <ul>
            <li><a href="../../index.html">Accueil</a></li>
        </ul>
    </nav>

    <!-- Formulaire de connexion -->
    <div class="container">
        <h2>Connexion</h2>
        <form action="../../CLASS/control.php" method="POST">
            <?php
                if (!empty($_GET['connexion'])) {
                    $mess = htmlspecialchars($_GET['connexion']);
                    echo($mess);
                    
                }
            ?>

            <label for="username">Nom d'utilisateur :</label>
            <input type="Text" id="username" name="username" required>
            
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            
            <input type="hidden" name="control" value="connexion">
            <button type="submit">Se connecter</button>
        </form>
        <br>
        <p>Je n'ai pas de compte! <br> <a href="Page_inscription.php">M'inscrire</a></p> 
        
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
