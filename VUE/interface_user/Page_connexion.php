<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="../media/logo-tete.png">
    <link rel="stylesheet" href="style.css">
    <title>Connexion - Nourou Darayni Service</title>
</head>
<body>

    <a href="../../index.html"><img src="../media/home.png" style="width: 5%; height: 40px; margin-left: 2%; margin-top: 20px;"></a>

    <!-- Formulaire de connexion -->
    <div class="container-form" >
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
        <a href="recup_password.php">
           Mot de passe oublié !
        </a>
        <p align="center">Je n'ai pas de compte! <br> <a href="Page_inscription.php">M'inscrire</a></p> 
        
    </div>
    
</body>
</html>
