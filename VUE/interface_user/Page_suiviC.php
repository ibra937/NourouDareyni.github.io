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
    <link rel="shortcut icon" type="x-icon" href="../media/logo-tete.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css"> <!-- Inclure votre CSS si nécessaire -->
    <title>Gestion des Commandes - Nourou Darayni Services</title>
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
                    <th>Statut</th>
                    <th>ID Commande</th>
                    <th>Produit</th>
                    <th>Date de commande</th>
                    <th>Destination</th>
                    <th>Destinataire</th>
                    <th>Annuler</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../../CLASS/connexionDB.php'; // Inclure le fichier de connexion

                $sql_count = "SELECT COUNT(*) as total_commandes FROM commandes_produits WHERE status='livrée' AND user_id= ?";
                $count = $conn->prepare($sql_count);
                $count->execute([$_SESSION['user_id']]);
                $total_users = $count->fetchAll();
                
                @$page=$_GET['page'];
                if(empty($page)){
                    $page=1;
                }
                $nbr=10;
                $nbr_page=ceil($total_users[0]["total_commandes"]/$nbr);
                $debut=($page-1)*$nbr;

                // Requête pour récupérer les commandes
                $sql = "SELECT id, nom_produit, status, date_commande, destination, proprietaire FROM commandes_produits WHERE user_id = ? ORDER BY id DESC"; // Remplacez 'commandes' par le nom de votre table
                $suivre = $conn->prepare($sql);
                $suivre->execute([$_SESSION['user_id']]);

                // Boucle à travers les résultats et affichage
                while ($row = $suivre->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>';
                    echo '<td style="background-color: #800000; color: #f4f4f4; font-weight: bold;">' . htmlspecialchars($row['status']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['nom_produit']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['date_commande']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['destination']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['proprietaire']) . '</td>';
                    if($row['status']=='en attente'){
                    echo '<td>' . 
                    '<form action="confirmer_password.php" method="POST">
                    <input type="hidden" name="del" value= '. $row['id'].'>
                    <input type="hidden" name="control" value="delete_user">
                    <button type="submit" class="tab_btn"><i class="fa fa-trash"></i></button></form>';
                    } else{
                        echo '<td>' . 
                        '<button type="submit" class="tab_btn"></button></form>';

                    }
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php
            for($i=1;$i<=$nbr_page;$i++){
                if($page!=$i){
                    echo "<a href='?page=$i'>$i</a>";
                }else{
                    echo "<a class='active'>$i</a>";
                }
            }
            ?>
        </div>
        <button><a href="Page_creationC.php"><li>Plus de commandes</li></a></button>
    
    
    <?php include 'footer.php'; ?>
</body>
</html>

