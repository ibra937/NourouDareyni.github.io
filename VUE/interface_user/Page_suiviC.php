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
    <title>Gestion des Commandes</title>
    <link rel="stylesheet" href="style.css"> <!-- Inclure votre CSS si nécessaire -->
</head>
<body>

    <!-- Navbar -->
    <?php include 'nav_bar.php'; ?>
    
    <!-- Tableau de gestion des commandes -->
        <?php
            if (!empty($_GET['connexion'])) {
                $mess = htmlspecialchars($_GET['connexion']);
                echo($mess);
            }
        ?>
        <h2>Gestion des Commandes</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Commande</th>
                    <th>Produit</th>
                    <th>Statut</th>
                    <th>Date de commande</th>
                    <th>Destination</th>
                    <th>proprietaire</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../../CLASS/connexionDB.php'; // Inclure le fichier de connexion

                // Requête pour récupérer les commandes
                $sql = "SELECT id, nom_produit, status, date_commande, destination, proprietaire FROM commandes_produits WHERE user_id = ?"; // Remplacez 'commandes' par le nom de votre table
                $suivre = $conn->prepare($sql);
                $suivre->execute([$_SESSION['user_id']]);

                // Boucle à travers les résultats et affichage
                while ($row = $suivre->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['nom_produit']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['status']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['date_commande']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['destination']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['proprietaire']) . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <button><a href="Page_creationC.php"><li>Plus de commandes</li></a></button>
    
    
    <?php include 'footer.php'; ?>
</body>
</html>

