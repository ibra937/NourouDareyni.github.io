<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../interface_user/Page_connexion.php");
        exit();
    }
    $user_id=$_SESSION['user_id'];
    @$id=$_GET['id'];
    @$user_inf=$_GET['user_id'];
    include '../../CLASS/connexionDB.php'; // Inclure le fichier de connexion
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
            <h2>Details des commandes</h2>
            <?php
                try {
                    // Première requête pour récupérer gp_id
                    $sql = "SELECT gp_id FROM commandes_produits WHERE id = ?"; 
                    $gp_id_stmt = $conn->prepare($sql);
                    $gp_id_stmt->execute([$id]);
                
                    if ($gp_id_stmt->rowCount() > 0) {
                        $g = $gp_id_stmt->fetch(PDO::FETCH_ASSOC);
                    
                        // Deuxième requête pour récupérer nom et id de l'utilisateur
                        $sql = "SELECT nom, id FROM users WHERE id = ?"; 
                        $gp_stmt = $conn->prepare($sql);
                        $gp_stmt->execute([$g['gp_id']]); // Correction ici : $g['gp_id'] doit être utilisé
                    
                        if ($gp_stmt->rowCount() > 0) {
                            $p = $gp_stmt->fetch(PDO::FETCH_ASSOC);
                            $gp_choisi = htmlspecialchars($p['id']) . ")  " . htmlspecialchars($p['nom']);
                        } else {
                            $gp_choisi = "GP Disponibles";
                        }
                    } else {
                        $gp_choisi = "GP Disponibles";
                    }
                } catch (PDOException $e) {
                    // Gérer les exceptions PDO pour éviter les fuites d'informations sensibles
                    $gp_choisi = "Erreur : " . htmlspecialchars($e->getMessage());
                }
            ?>

            <div class="container">
                <h2>Affectation des commandes :</h2><br>
                <form action="../../CLASS/control.php" method="POST">
                    <select id="gp" name="gp" required>
                        <option disabled selected><?php echo($gp_choisi);?></option>
                        <?php
                            $sql = "SELECT nom, id FROM users WHERE role='gp'"; // Remplacez 'commandes' par le nom de votre table
                            $suivre = $conn->prepare($sql);
                            $suivre->execute();

                            // Boucle à travers les résultats et affichage
                            while ($row = $suivre->fetch(PDO::FETCH_ASSOC)) {
                               
                                echo '<option value="'. htmlspecialchars($row['id']).'">'  .htmlspecialchars($row['id']).")  ". htmlspecialchars($row['nom']) . '</option>';
                            }
                        ?>
                    </select>
                    <input type="hidden" name="com_id" value="<?php echo($id); ?>">
                    <input type="hidden" name="control" value="gp id">
                    <button type="submit">Affecter</button>
                </form>
            </div>
            
            <div class="container">
                <h2>Informations expediteur</h2><br>
                <?php
                 // Requête pour récupérer les informations de l'utilisateur
                 $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
                 $stmt->execute([$user_inf]);
                 $user = $stmt->fetch(PDO::FETCH_ASSOC);
                 
                 if ($user) {
                     echo '<h3><strong>Nom complet :</strong> ' . htmlspecialchars($user['nom']) . '</h3><br>';
                     echo '<h3><strong>Nom d\'utilisateur :</strong> ' . htmlspecialchars($user['user']) . '</h3><br>';
                     echo '<h3><strong>Email :</strong> ' . htmlspecialchars($user['email']) . '</h3><br>';
                     echo '<h3><strong>Adresse :</strong> ' . htmlspecialchars($user['adresse']) . '</h3><br>';
                     echo '<h3><strong>Date d\'inscription :</strong> ' . htmlspecialchars($user['date_inscription']) . '</h3><br>';
                    } else {
                        echo '<h3>Aucun utilisateur trouvé.</h3>';
                    }
                    ?>
        </div>
        <div class="container">
        <h2>Status des commandes :</h2><br>
        <p>Status de la commandes</p>
        <div class="pagination" align="center"><br>
            <?php
                $sql="SELECT status FROM commandes_produits WHERE id=?";
                $role=$conn->prepare($sql);
                $role->execute([$id]);
                $result=$role->fetch(PDO::FETCH_ASSOC);
                if($result){
                    if($result['status']=="en attente"){
                        echo "<a class='active'>".$result['status']."</a>";
                    }elseif($result['status']=="en cours"){
                        echo "<a class='active'>en cours</a>";
                    }elseif($result['status']=="livrée"){
                        echo "<a class='active'>livrée</a>";
                    }
                }
            ?>
        </div><br>
        <p>nouvelle status</p><br>
        <div class="pagination" align="center">
            <?php
                echo('<form action="../../CLASS/control.php" method="POST">
                    <input type="hidden" name="status" value= '. $id.'>
                    <input type="hidden" name="control" value="en attente">
                <button type="submit" class="role_btn">en attente</button></form>');

                echo('<form action="../../CLASS/control.php" method="POST">
                    <input type="hidden" name="status" value= '. $id.'>
                    <input type="hidden" name="control" value="en cours">
                <button type="submit" class="role_btn">en cours</button></form>');
                
                echo('<form action="../../CLASS/control.php" method="POST">
                    <input type="hidden" name="status" value= '. $id.'>
                    <input type="hidden" name="control" value="livrée">
                <button type="submit" class="role_btn">livrée</button></form>');
            ?>
        </div>
        </div>
        <div class="container">
            <h2>modifier données</h2><br>
            <?php
                 // Requête pour récupérer les informations de l'utilisateur
                $stmt = $conn->prepare("SELECT * FROM commandes_produits WHERE id = ?");
                $stmt->execute([$id]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <form action="../../CLASS/control.php" method="POST">

            <label for="product">Produit :</label>
            <input type="text" id="product" name="product" placeholder="Nom du produit" value="<?php echo htmlspecialchars($user['nom_produit']); ?>" required>

            <label for="quantity">Quantité :</label>
            <input type="number" id="quantity" name="quantity" min="1" placeholder="Nombre d'unités" value="<?php echo htmlspecialchars($user['quantite']); ?>" required>

            <label for="origine">Origine :</label>
            <input type="text" id="origine" name="origine" placeholder="Ville ou pays de d'origine" value="<?php echo htmlspecialchars($user['origine']); ?>" required>

            <label for="destination">Destination :</label>
            <input type="text" id="destination" name="destination" placeholder="Ville ou pays de destination" value="<?php echo htmlspecialchars($user['destination']); ?>" required>

            <label for="proprietaire_name">Nom du proprietaire :</label>
            <input type="text" id="proprietaire_name" name="proprietaire_name" value="<?php echo htmlspecialchars($user['proprietaire']); ?>" required>

            <label for="proprietaire_phone">Numero du proprietaire :</label>
            <input type="text" id="proprietaire_phone" name="proprietaire_phone" value="<?php echo htmlspecialchars($user['tel_propietaire']); ?>" required>

            <label for="notes">Instructions supplémentaires :</label>
            <textarea id="notes" name="notes" placeholder="<?php echo htmlspecialchars($user['description']); ?>"></textarea>

            <input type="hidden" name="control" value="creer_commande">
            <button type="submit">Créer la commande</button>

            </form>
        </div>
        </div>
    </div>
</body>
</html>