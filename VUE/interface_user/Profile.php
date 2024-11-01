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
    <title>Mon Profil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Navbar -->
    <?php include 'nav_bar.php'; ?>

    <!-- Profil utilisateur -->
    <div class="container">
        <?php
            if (!empty($_GET['connexion'])) {
                $mess = htmlspecialchars($_GET['connexion']);
                echo($mess);     
            }
        ?>
        <h2>Mon Profil</h2>
        <?php
        include '../../CLASS/connexionDB.php'; // Inclure le fichier de connexion

        // Supposons que l'utilisateur connecté 
        $user_id = $_SESSION['user_id']; 

        // Requête pour récupérer les informations de l'utilisateur
        $stmt = $conn->prepare("SELECT nom, email, user, adresse, date_inscription FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo '<p><strong>Nom complet :</strong> ' . htmlspecialchars($user['nom']) . '</p>';
            echo '<p><strong>Nom d\'utilisateur :</strong> ' . htmlspecialchars($user['user']) . '</p>';
            echo '<p><strong>Email :</strong> ' . htmlspecialchars($user['email']) . '</p>';
            echo '<p><strong>Adresse :</strong> ' . htmlspecialchars($user['adresse']) . '</p>';
            echo '<p><strong>Date d\'inscription :</strong> ' . htmlspecialchars($user['date_inscription']) . '</p>';
        } else {
            echo '<p>Aucun utilisateur trouvé.</p>';
        }
        ?>
    </div>

    <div class="container">
        <?php
            if (!empty($_GET['update'])) {
                $mess = htmlspecialchars($_GET['update']);
                echo($mess);     
            }
        ?>
        <h2>Modifier mes informations :</h2>
        <form action="../../CLASS/control.php" method="post">
            <label for="username">Nom D'utilisateur :</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['user']); ?>" required>
            
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            
            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" value="<?php echo htmlspecialchars($user['adresse']); ?>" required>
            
            <input type="hidden" name="control" value="mettre_jour">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <button type="submit">Mettre à jour</button>
        </form>
    </div>
    
    <div class="container">
        <?php
            if (!empty($_GET['pass'])) {
                $mess = htmlspecialchars($_GET['pass']);
                echo($mess);     
            }
        ?>
        <h2>Modifier mon mots de passe :</h2>
        <form action="../../CLASS/control.php" method="post">
            <label for="password">Nouveau mot de passe :</label>
            <input type="password" id="password" name="password1" required>
            
            <label for="password">confirmation du mot de passe :</label>
            <input type="password" id="password" name="password2" required>

            <input type="hidden" name="control" value="motpass">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <button type="submit">Mettre à jour</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
