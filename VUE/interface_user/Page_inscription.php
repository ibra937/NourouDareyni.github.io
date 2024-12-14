<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="../media/logo-tete.png">
    <link rel="stylesheet" href="style.css">
    <title>Inscription - Nourou Darayni Services</title>
</head>
<body>
<a href="../../index.html"><img src="../media/home.png" style="width: 5%; height: 40px; margin-left: 2%; margin-top: 20px;"></a>

    <!-- Formulaire d'inscription -->
    <div class="container-form">
        <h2>Inscription</h2>
        <?php
            echo(@$_GET['inscription']);
        ?>
        <form action="../../CLASS/control.php" method="POST">
            <label for="name">Prenom :</label>
            <input type="text" id="name" name="prenom" pattern="[A-Za-z\s]+" title="Veuillez n'utiliser que des lettres." required>

            <label for="name">Nom :</label>
            <input type="text" id="name" name="nom" pattern="[A-Za-z\s]+" title="Veuillez n'utiliser que des lettres." required>

            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
            
            <label for="phone">Téléphone :</label>
            <select id="indicatif" name="indicatif" required class="indicatif">
                <option value="+221">Senegal(+221)</option>
                <option value="+1">Usa(+1)</option>
            </select>
            <input type="phone" id="phone" name="phone" pattern="\d+" title="Veuillez entrer uniquement des chiffres." required class="num">

            <label for="adress">Localisation :</label>
            <select id="adress" name="adress" placeholder="--selectionnez--" required>
                <option value="Dakar">Dakar</option>
                <option value="Banlieue">Banlieue</option>
                <option value="Thies">Thies</option>
                <option value="Touba">Touba</option>
                <option value="Louga">Louga</option>
                <option value="Usa">Usa</option>
            </select>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password0" minlength="8" title="Au moins 8 caractères." required>
            
            <label for="password">Confirmer votre mot de passe :</label>
            <input type="password" id="password" name="password1" minlength="8" title="Au moins 8 caractères." required>
            
            <input type="hidden" name="control" value="inscription">
            <button type="submit">S'inscrire</button>
        </form>
        <p>J'ai déja un compte! <br> <a href="Page_connexion.php">Me connecter</a></p> 
    </div>
</body>
</html>
