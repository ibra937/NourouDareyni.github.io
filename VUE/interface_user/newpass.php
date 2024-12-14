<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="container-form">
        <?php
            if (!empty($_GET['pass'])) {
                $mail=htmlspecialchars($_GET['mail']);
                $mess = htmlspecialchars($_GET['pass']);
                echo($mess); 
                echo($mail); 

            }
        ?>
        <h2>Modifier mon mots de passe :</h2>
        <form action="../../CLASS/control.php" method="post">
            <label for="password">Nouveau mot de passe :</label>
            <input type="password" id="password" name="password1" required>
            
            <label for="password">confirmation du mot de passe :</label>
            <input type="password" id="password" name="password2" required>

            <input type="hidden" name="control" value="newpass">
            <input type="hidden" name="mail" value="<?php echo($mail); ?>">
            <button type="submit">Changer</button>
        </form>
    </div>
</body>
</html>