<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Navbar -->
       <!-- Navbar -->
    <header class="site-header">
    <div class="log">
      <a href="../index.html"><img src="../media/logo.png" alt="" class="logo">NOUROU DARAYNI</a>
    </div> 
    </header>
    <nav class="navbar">
        <ul>
            <li><a href="../../index.html">Accueil</a></li>
        </ul>
    </nav>

    <!-- Formulaire d'inscription -->
    <div class="container">
        <h2>Inscription</h2>
        <form action="../../CLASS/control.php" method="POST">
            <label for="name">Nom complet :</label>
            <input type="text" id="name" name="name" pattern="[A-Za-z\s]+" title="Veuillez n'utiliser que des lettres." required>

            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
            
            <label for="phone">Téléphone :</label>
            <select id="indicatif" name="indicatif" required class="indicatif">
                <option value="Senegal(+221)">Senegal(+221)</option>
                <option value="Usa(+1)">Usa(+1)</option>
            </select>
            <input type="phone" id="phone" name="phone" pattern="\d+" title="Veuillez entrer uniquement des chiffres." required class="phone">

            <label for="adress">Localisation :</label>
            <select id="adress" name="adress" required>
                <option value="">--Sélectionnez--</option>
                <option value="Dakar">Dakar</option>
                <option value="Banlieue">Banlieue</option>
                <option value="Thies">Thies</option>
                <option value="Touba">Touba</option>
                <option value="Louga">Louga</option>
                <option value="Usa">Usa</option>
            </select>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            
            <input type="hidden" name="control" value="inscription">
            <button type="submit">S'inscrire</button>
        </form>
        <br>
        <p>J'ai déja un compte! <br> <a href="Page_connexion.php">Me connecter</a></p> 
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
