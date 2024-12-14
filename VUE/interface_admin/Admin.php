<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        $mess="Nom d'utilisateur ou mot de passe incorrect.";
        header("Location: ../interface_user/Page_connexion.php?connexion=$mess");
        exit();
    }
    $username = $_SESSION['name'];

    include '../../CLASS/connexionDB.php';
    $sql_count = "SELECT COUNT(*) as total_users FROM users";
    $count = $conn->prepare($sql_count);
    $count->execute();
    $total_users = $count->fetchAll();

    $sql_count = "SELECT COUNT(*) as total_utilisateurs FROM users WHERE role='utilisateur'";
    $count = $conn->prepare($sql_count);
    $count->execute();
    $total_utilisateurs = $count->fetchAll();

    $sql_count = "SELECT COUNT(*) as total_gp FROM users WHERE role='gp'";
    $count = $conn->prepare($sql_count);
    $count->execute();
    $total_gp = $count->fetchAll();
    
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="VUE/media/logo-tete.png">
    <link rel="stylesheet" href="Style_admin.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="admin-container">
        <?php include 'sidebar.php'; ?>

        <div class="main-content">
            <header>
                <h1>Bienvenue, <?php echo($username); ?></h1>
                <p>Consultez vos données rapidement et efficacement.</p>
            </header>

            <br><h2>Statistiques utilisateurs</h2>
            <section class="content">
                <div class="widget">
                    <h3>Total users</h3>
                    <p><?php echo ($total_users[0]["total_users"]); ?></p>
                </div>
                <div class="widget">
                    <h3>Nombre d'utilisateurs</h3>
                    <p><?php echo ($total_utilisateurs[0]["total_utilisateurs"]); ?></p>
                </div>
                <div class="widget">
                    <h3>Nombres de GP</h3>
                    <p><?php echo ($total_gp[0]["total_gp"]); ?></p>
                </div>
            </section><br><br>

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
        </div>
    </div>
</body>
</html>
