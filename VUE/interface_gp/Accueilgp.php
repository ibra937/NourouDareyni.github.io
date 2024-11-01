<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        $mess="Nom d'utilisateur ou mot de passe incorrect.";
        header("Location: Page_connexion.php?connexion=$mess");
        exit();
    }
    $username = $_SESSION['name'];

    include '../../CLASS/connexionDB.php';

    $sql_count = "SELECT COUNT(*) as total_commandes FROM commandes_produits";
    $count = $conn->prepare($sql_count);
    $count->execute();
    $total_commandes = $count->fetchAll();
    
    $sql_count = "SELECT COUNT(*) as commandes_attentes FROM commandes_produits WHERE status='en attente'";
    $count = $conn->prepare($sql_count);
    $count->execute();
    $commandes_attentes = $count->fetchAll();
    
    $sql_count = "SELECT COUNT(*) as commandes_cours FROM commandes_produits WHERE status='en cours'";
    $count = $conn->prepare($sql_count);
    $count->execute();
    $commandes_cours = $count->fetchAll();
    
    $sql_count = "SELECT COUNT(*) as commandes_livrees FROM commandes_produits WHERE status='livrée'";
    $count = $conn->prepare($sql_count);
    $count->execute();
    $commandes_livrees = $count->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_gp.css">
    <title>Accueil - Service de Transport</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
  <?php include 'navbar.php'; ?>
  <h2>BIENVENUE <br> <?php echo($username); ?></h2>
  <!-- Tableau de bord -->
  <section class="dashboard">
      
          <div class="dashboard-buttons">
              <button><a href="gestion_commandes.php"><li>MES COMMANDES</li></a></button>
              <button><a href="Page_suiviC.php"><li>MON PROFIL</li></a></button>
            </div>
        
    </section>

    <hr><br><h2>Statistiques commandes</h2>
            <section class="content">
                <div class="widget">
                    <h3>Total des commandes</h3>
                    <p><?php echo ($total_commandes[0]["total_commandes"]); ?></p>
                </div>
                <div class="widget">
                    <h3>Commandes en attentes</h3>
                    <p><?php echo ($commandes_attentes[0]["commandes_attentes"]); ?></p>
                </div>
                <div class="widget">
                    <h3>Commandes en cours</h3>
                    <p><?php echo ($commandes_cours[0]["commandes_cours"]); ?></p>
                </div>
                <div class="widget">
                    <h3>Commandes en livrées</h3>
                    <p><?php echo ($commandes_livrees[0]["commandes_livrees"]); ?></p>
                </div>
            </section>

    <!-- Statistiques dynamiques -->
    <section id="stats">
        <div class="container">
            <h2>Statistiques</h2>
            <div class="stats-box">
                <div class="stat-item">
                    <h3>150+</h3>
                    <p>GP Disponibles</p>
                </div>
                <div class="stat-item">
                    <h3>1200+</h3>
                    <p>Commandes Traitées</p>
                </div>
            </div>
            
        </div>
    </section>
    <?php include 'footer.php'; ?>
</body>
</html>
