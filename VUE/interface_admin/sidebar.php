<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav class="sidebar">   
        <h2>Admin Dashboard</h2><br><br>
        <ul>
            <hr><br><li><a href="Admin.php">Voir les Statistiques</a></li><hr><br>
            <li><a href="page_users.php">Gestion des utilisateurs</a></li><hr><br>
            <li><a href="commandes_attentes.php">Gestion des commandes</a></li><hr><br>
            <li><a href="#">Inventaire</a></li><hr><br>
            <li><a href="../../CLASS/logout.php" class="logout-btn">Déconnexion</a></li>
            <li class="user-id"><?php echo($_SESSION['user_name']); ?></li>
        </ul>
    </nav>
</body>
</html>