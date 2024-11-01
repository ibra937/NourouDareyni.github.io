<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../interface_user/Page_connexion.php");
        exit();
    }
    $user_id=$_SESSION['user_id'];
    @$id=$_GET['id'];
    include '../../CLASS/connexionDB.php'; // Inclure le fichier de connexion
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_admin.css">
    <title>Document</title>
</head>
<body>
    <div class="admin-container">
        <?php include 'sidebar.php'; ?>
    
        <div class="main-content">
            <h2>Données utilisateurs</h2>

           <div class="container">
            <h2>Modifier les roles :</h2><br>
            <p>Role actuel</p>
            <div class="pagination" align="center"><br>
                <?php
                    $sql="SELECT role FROM users WHERE id=?";
                    $role=$conn->prepare($sql);
                    $role->execute([$id]);
                    $result=$role->fetch(PDO::FETCH_ASSOC);
                    if($result){
                        if($result['role']=="gp"){
                            $result=$result['role'];
                            echo "<a class='active'>".$result."</a>";
                        }elseif($result['role']=="admin"){
                            echo "<a class='active'>admin</a>";
                        }elseif($result['role']){
                            echo "<a class='active'>utilisateur</a>";
                        }
                    }
                ?>
            </div><br>
            <p>Nouveau role</p><br>
            <div class="pagination" align="center">
                <?php
                    echo('<form action="../../CLASS/control.php" method="POST">
                        <input type="hidden" name="role" value= '. $id.'>
                        <input type="hidden" name="control" value="admin">
                    <button type="submit" class="role_btn">Admin</button></form>');

                    echo('<form action="../../CLASS/control.php" method="POST">
                        <input type="hidden" name="role" value= '. $id.'>
                        <input type="hidden" name="control" value="gp">
                    <button type="submit" class="role_btn">gp</button></form>');
                    
                    echo('<form action="../../CLASS/control.php" method="POST">
                        <input type="hidden" name="role" value= '. $id.'>
                        <input type="hidden" name="control" value="utilisateur">
                    <button type="submit" class="role_btn">utilisateur</button></form>');
                ?>
            </div>
            </div>

            <div class="container">
            <h2>Modifier mes informations :</h2>
            <?php
                 // Requête pour récupérer les informations de l'utilisateur
                $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
                $stmt->execute([$id]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <form action="../../CLASS/control.php" method="post">
            <label for="name">Nom complet :</label>
            <input type="text" id="name" name="name" pattern="[A-Za-z\s]+" title="Veuillez n'utiliser que des lettres." value="<?php echo htmlspecialchars($user['nom']); ?>" required>

            <label for="username">Nom D'utilisateur :</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['user']); ?>" required>
            
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"  required>

            <label for="phone">Téléphone :</label>
            <input type="phone" id="phone" name="phone" pattern="\d+" title="Veuillez entrer uniquement des chiffres." value="<?php echo htmlspecialchars($user['telephone']); ?>" required>
            
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
        </div>
    </div>
</body>
</html>