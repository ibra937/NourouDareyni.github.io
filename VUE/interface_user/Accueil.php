<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        $mess="Nom d'utilisateur ou mot de passe incorrect.";
        header("Location: Page_connexion.php?connexion=$mess");
        exit();
    }
    $username = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Service de Transport</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
  <?php include 'nav_bar.php'; ?>
  <h2>BIENVENUE <br> <?php echo($username); ?></h2>
  <!-- Tableau de bord -->
  <section class="dashboard">
      
          <div class="dashboard-buttons">
              <button><a href="Page_creationC.php"><li>Nouvelle Commande</li></a></button>
              <button><a href="Page_suiviC.php"><li>Suivre Mes Commandes</li></a></button>
            </div>
        
    </section>
    <?php include 'Actu.php'; ?>

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
