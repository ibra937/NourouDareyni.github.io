<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: Page_connexion.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Commande</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Navbar -->
    <?php include 'nav_bar.php'; ?>
    <!-- Formulaire de création de commande -->
    <div class="container">
        <h2>Créer une nouvelle commande</h2>
        <form action="../../CLASS/control.php" method="POST">

            <label for="product">Produit :</label>
            <input type="text" id="product" name="product" placeholder="Nom du produit" required>
            
            <label for="quantity">Quantité :</label>
            <input type="number" id="quantity" name="quantity" min="1" placeholder="Nombre d'unités" required>
            
            <label for="origine">Origine :</label>
            <input type="text" id="origine" name="origine" placeholder="Ville ou pays de d'origine" required>
   
            <label for="destination">Destination :</label>
            <input type="text" id="destination" name="destination" placeholder="Ville ou pays de destination" required>
   
            <label for="proprietaire_name">Nom du proprietaire :</label>
            <input type="text" id="proprietaire_name" name="proprietaire_name" required>

            <label for="proprietaire_phone">Numero du proprietaire :</label>
            <input type="text" id="proprietaire_phone" name="proprietaire_phone" required>

            <label for="notes">Instructions supplémentaires :</label>
            <textarea id="notes" name="notes" placeholder="Ajouter des instructions spéciales ici..."></textarea>

            <input type="hidden" name="control" value="creer_commande">
            <button type="submit">Créer la commande</button>

        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
