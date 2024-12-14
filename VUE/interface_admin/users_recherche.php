<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../interface_user/Page_connexion.php");
        exit();
    }
    $user_id=$_SESSION['user_id'];
    @$recherche=$_GET['recherche'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style_admin.css">
    <title>Utilisateurs - Nourou Darayni Services</title>
</head>
<body>
<div class="admin-container">
    <?php include 'sidebar.php'; ?>
        <div class="main-content">   
            <h2>Recherche</h2>
            <div class="tete">
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Nom d'utilisateur</th>
                            <th>Nom complet</th>
                            <th>Numéro de téléphone</th>
                            <th>Adresse</th>
                            <th>role</th>
                            <th>Date de creation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                include '../../CLASS/connexionDB.php'; // Inclure le fichier de connexion
                
                $sql_count = "SELECT COUNT(*) as total_users FROM users WHERE role='utilisateur'";
                $count = $conn->prepare($sql_count);
                $count->execute();
                $total_users = $count->fetchAll();
                
                @$page=$_GET['page'];
                if(empty($page)){
                    $page=1;
                }
                $nbr=5;
                $nbr_page=ceil($total_users[0]["total_users"]/$nbr);
                $debut=($page-1)*$nbr;
                
                // Requête pour récupérer les commandes
                $sql = "SELECT id, user, nom, telephone, adresse, role, date_inscription FROM users WHERE user = :recherche or nom = :recherche limit $debut,$nbr"; // Remplacez 'commandes' par le nom de votre table
                $suivre = $conn->prepare($sql);
                $suivre -> bindParam(':recherche', $recherche);
                $suivre->execute();
                
                /*if(count($row)==0){
                    header("locatiion:./");
                    }*/
                    // Boucle à travers les résultats et affichage
                    while ($row = $suivre->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['user']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['nom']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['telephone']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['adresse']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['role']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['date_inscription']) . '</td>';
                        echo '<td>' .
                        '<form action="../../CLASS/control.php" method="POST">
                        <input type="hidden" name="del" value= '. $row['id'].'>
                        <input type="hidden" name="control" value="delete">
                        <button type="submit" class="tab_btn">delete</button></form>' 
                        .
                        '<form action="../../CLASS/control.php" method="POST">
                        <input type="hidden" name="up" value= '. $row['id'].'>
                        <input type="hidden" name="control" value="update">
                        <button type="submit" class="tab_btn">update</button></form>' 
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
        <?php include 'barre_recherche.php'; ?><br>
    </div>
</body>
</html>