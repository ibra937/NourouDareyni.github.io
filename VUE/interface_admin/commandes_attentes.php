<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../interface_user/Page_connexion.php");
        exit();
    }
    $user_id=$_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="../media/logo-tete.png">
    <link rel="stylesheet" href="Style_admin.css">
    <title>Commandes - Nourou Darayni Services</title>
</head>
<body>
    <div class="admin-container">
        <?php include 'sidebar.php'; ?>
        
        <div class="main-content">   
            <h2>Gestion des commandes</h2><hr><br>
            <h3 class="h3">commandes en attentes</h3>
            <button class="btn"><a href="commandes_cours.php">Commandes en cours</a></button>
            <button class="btn"><a href="commandes_livrees.php">Comnnades livrées</a></button>
                <table>
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>produits</th>
                            <th>Quantite</th>
                            <th>destination</th>
                            <th>Date de commandes</th>
                            <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                include '../../CLASS/connexionDB.php'; // Inclure le fichier de connexion
                
                $sql_count = "SELECT COUNT(*) as total_commandes FROM commandes_produits WHERE status='en attente'";
                $count = $conn->prepare($sql_count);
                $count->execute();
                $total_users = $count->fetchAll();
                
                @$page=$_GET['page'];
                if(empty($page)){
                    $page=1;
                }
                $nbr=10;
                $nbr_page=ceil($total_users[0]["total_commandes"]/$nbr);
                $debut=($page-1)*$nbr;
                
                // Requête pour récupérer les commandes
                $sql = "SELECT id, user_id, nom_produit, quantite, destination, date_commande FROM commandes_produits WHERE status='en attente' ORDER BY id DESC limit $debut,$nbr"; // Remplacez 'commandes' par le nom de votre table
                $suivre = $conn->prepare($sql);
                $suivre->execute();
                
                    // Boucle à travers les résultats et affichage
                    while ($row = $suivre->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['nom_produit']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['quantite']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['destination']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['date_commande']) . '</td>';
                        echo '<td>' .
                        '<form action="confirmer_password.php" method="POST">
                        <input type="hidden" name="del" value= '. $row['id'].'>
                        <input type="hidden" name="control" value="delete_admin">
                        <button type="submit" class="tab_btn">delete</button></form>' 
                        .
                        '<form action="../../CLASS/control.php" method="POST">
                        <input type="hidden" name="idC" value= '. $row['id'].'>
                        <input type="hidden" name="idU" value= '. $row['user_id'].'>
                        <input type="hidden" name="control" value="detail">
                        <button type="submit" class="tab_btn">details</button></form>' 
                        . '</td>';
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
    </div>
</body>
</html>